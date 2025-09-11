<?php

namespace App\Livewire\Components\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\on;
use Illuminate\Support\Facades\DB;

class Modalbayardepe extends Component
{

    public $modalFormBayarDepe = false;

    public $order;
    public $order_id;
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


    protected $listeners = ['open-modal-bayar-depe' => 'openModalBayarDepe'];

    // #[On('open-modal-bayar-depe')]
    public function openModalBayarDepe($id)
    {
        $this->order_id = $id;
        $this->order = Order::find($id);
        $this->status = $this->order->status;
        $this->total_amount = number_format($this->order->total_amount, 0, ',', '.');
        $this->spending = number_format(($this->amount - $this->order->total_amount), 0, ',', '.');
        $order = Order::withSum('payment as paid_sum', 'amount')->find($this->order_id);
        $this->order_total = (float)($order->total_amount ?? 0);
        $this->paid_total = (float)($order->paid_sum ?? 0);
        $this->outstanding = max(0, $this->order_total - $this->paid_total);
        $this->modalFormBayarDepe = true;
    }

    public function closeModal()
    {
        $this->modalFormBayarDepe = false;
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


            // foreach ($this->selectedRows as $row) {
            // $od = OrderDetail::find($row['order_detail']['id']);

            // $pd = PickupDetail::create([
            //     'pickup_id' => $pickup->id,
            //     'order_detail_id' => $od->id,
            //     'qty' => $od->qty_final, // jika nanti mau partial, ganti sesuai input
            // ]);

            // Simpan pivot pekerjaan per baris
            // if (!empty($row['works'])) {
            //     $pivotRows = [];
            //     foreach ($row['works'] as $w) {
            //         $pivotRows[] = [
            //             'pickup_detail_id' => $pd->id,
            //             'work_id' => $w['work']['id'],
            //             'employee_id' => $w['employee_id'] ?? null,
            //             'pay_default' => (float)($w['fee'] ?? 0),
            //             'created_at' => now(),
            //             'updated_at' => now(),
            //         ];
            //     }
            //     if (!empty($pivotRows)) {
            //         DB::table('pickup_detail_employee_works')->insert($pivotRows);
            //     }
            // }

            // 3) Update status order_detail → completed
            // $od->update([
            //     'pickup_status' => 'completed',
            // ]);

            // 4) Pembayaran (kalau ada)
            $payAmount = (float)($this->pay_now ?? 0);
            // 5) Cek pembayaran dulu, untuk melihat lebih apa tidak
            $order   = Order::withSum('payment as paid_sum', 'amount')->find($this->order_id);
            $paid    = (float)($order->paid_sum ?? 0) + $payAmount;
            // dd($pickups->paid_sum);
            // dd($paid);
            $total   = (float)($order->total_amount ?? 0);
            if ($payAmount > 0) {
                $this->order->payment()->create([
                    'order_id'       => $this->order_id, // tetap kaitkan ke order
                    // 'pickup_id'      => $pickup->id, // tetap kaitkan ke pickup
                    'amount'         => $payAmount > $total ? $this->outstanding : $payAmount,
                    'paid_amount'   => $payAmount,
                    'payment_method' => $this->payment_method,
                ]);
            }

            // 6) Update status order (unpaid/partially_paid/paid)
            $order   = Order::withSum('payment as paid_sum', 'amount')->find($this->order_id);
            $paid    = (float)($order->paid_sum ?? 0) + $payAmount;
            // dd($pickups->paid_sum);
            // dd($paid);
            $total   = (float)($order->total_amount ?? 0);
            $status  = match (true) {
                $paid <= 0        => 'unpaid',
                $paid < $total    => 'partially',
                default           => 'paid',
            };

            $order->update(['payment_status' => $status]);

            DB::commit();
            $this->dispatch('success', message: 'Pembayaran DEPE sudah ditambahkan');
            $this->redirectRoute('order.print', $order->id);
            $this->closeModal();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.components.order.modalbayardepe');
    }
}
