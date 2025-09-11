<?php

namespace App\Livewire\Components\Receivable;

use App\Models\Order;
use App\Models\Pickup;
use Livewire\Component;
use Livewire\Attributes\on;
use Illuminate\Support\Facades\DB;

class Modalbayarhutang extends Component
{
    public $modalFormBayarHutang = false;

    public $order;
    public $order_id;
    public $pickup;
    public $pickup_id;
    public $status;
    public $amount = 0;
    public $total_amount = 0;
    public $spending = 0;

    // Payment section
    public $order_total = 0;
    public $paid_total = 0; // total payment recorded (order-level)
    public $outstanding = 0; //order_total - paid_total
    public $pay_now = 0;
    public $change = 0;
    public $payment_method = 'cash';

    // Register listener manual


    protected $listeners = ['open-modal-bayar-hutang' => 'openModalBayarHutang'];
    // #[On('open-modal-bayar-hutang')]
    public function openModalBayarHutang($id)
    {
        $this->pickup = Pickup::find($id);
        $this->pickup_id = $id;
        $this->order_id = $this->pickup->pickupdetail->first()->orderdetail->order_id;
        $this->order = Order::find($this->order_id);
        $this->status = $this->order->status;
        // $this->total_amount = number_format($this->order->total_amount, 0, ',', '.');

        foreach ($this->pickup->pickupdetail as $pd) {
            if ($pd->orderdetail->width != 0) {
                // dd('disini');
                $this->total_amount = $this->total_amount +
                    ($pd->qty * $pd->orderdetail->width * $pd->orderdetail->length * $pd->orderdetail->price);
            } else {
                $this->total_amount = $this->total_amount +
                    ($pd->qty * $pd->orderdetail->price);
            }
        }
        // $this->total_amount = number_format($this->pickup->pickupdetail()->sum('qty'), 0, ',', '.');
        // dd($this->total_amount);
        $this->spending = number_format(($this->amount - $this->order->total_amount), 0, ',', '.');
        $order = Order::withSum('payment as paid_sum', 'amount')->find($this->order_id);
        $pickup = Pickup::withSum('payment as paid_sum', 'amount')->find($id);
        // $this->order_total = (float)($order->total_amount ?? 0);
        $this->order_total = (float)($this->total_amount ?? 0);
        $this->paid_total = (float)($order->paid_sum ?? 0) + (float) ($pickup->paid_sum ?? 0);
        $this->outstanding = max(0, $this->order_total - $this->paid_total);
        $this->modalFormBayarHutang = true;
    }


    public function closeModal()
    {
        $this->modalFormBayarHutang = false;
        $this->reset();
    }

    public function updatedPayNow()
    {
        $max = max(0, $this->outstanding);
        // if ($this->pay_now > $max) {
        //     $this->pay_now = $max;
        // }
        if ($this->pay_now < 0) {
            $this->pay_now = 0;
        }
        $this->change = (float) $this->pay_now - $this->outstanding;
    }
    public function save()
    {
        $this->validate([
            'order_id' => 'required|exists:orders,id',
            'pay_now' => 'nullable|numeric|min:1',
        ]);

        DB::beginTransaction();

        try {



            // Pembayaran (kalau ada)
            $payAmount = (float)($this->pay_now ?? 0);
            // 5) Lihat pembayaran dulu, lebih atau tidak
            $order   = Order::withSum('payment as paid_sum', 'amount')->find($this->order_id);
            $pickup = Pickup::withSum('payment as paid_sum', 'amount')->find($this->pickup_id);
            $paid    = (float)($order->paid_sum ?? 0) + (float) ($pickup->paid_sum ?? 0);
            // dd($pickup->paid_sum);
            // dd($paid);
            $total   = (float) (($order->total_amount ?? 0) - (($order->paid_sum ?? 0) + ($pickup->paid_sum ?? 0)));
            if ($payAmount > 0) {
                $this->pickup->payment()->create([
                    // 'order_id'       => $this->order_id, // tetap kaitkan ke order
                    'pickup_id'      => $this->pickup->id, // tetap kaitkan ke pickup
                    'amount'         => $payAmount > $total ? $this->outstanding : $payAmount,
                    'paid_amount'   => $payAmount,
                    'payment_method' => $this->payment_method,
                ]);
            }

            // 6) Update status order (unpaid/partially_paid/paid)
            $order   = Order::withSum('payment as paid_sum', 'amount')->find($this->order_id);
            $pickup = Pickup::withSum('payment as paid_sum', 'amount')->find($this->pickup_id);
            $paid    = (float)($order->paid_sum ?? 0) + (float) ($pickup->paid_sum ?? 0);
            // dd($pickup->paid_sum);
            // dd($paid);
            $total   = (float)($order->total_amount ?? 0);
            $status  = match (true) {
                $paid <= 0        => 'unpaid',
                $paid < $total    => 'partially',
                default           => 'paid',
            };

            $order->update(['payment_status' => $status]);

            DB::commit();
            $this->dispatch('success', message: 'Pembayaran Hutang sudah ditambahkan');
            $this->redirectRoute('pickup.print', $this->pickup_id);
            $this->closeModal();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.components.receivable.modalbayarhutang');
    }
}
