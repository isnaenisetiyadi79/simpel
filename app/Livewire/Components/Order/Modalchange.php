<?php

namespace App\Livewire\Components\Order;

use App\Models\Order;
use App\Models\Payment;
use Livewire\Component;
use Livewire\Attributes\on;
use Illuminate\Support\Facades\DB;
use PHPUnit\Event\Code\Throwable;
use Throwable as GlobalThrowable;

class Modalchange extends Component
{
    public $modalFormChange = false;

    public $id;
    public $change_status = false;
    public $status;
    public $total_amount;
    public $amount = 0;
    public $spending = 0;
    public $payment_method = 'cash';
    public function mount() {}

    #[On('open-modal-change')]
    public function openModal($id)
    {
        $this->id = $id;
        $order = Order::find($id);
        $this->status = $order->status;
        $this->total_amount = number_format($order->total_amount, 0, ',', '.');
        $this->spending = number_format(($this->amount - $order->total_amount), 0, ',', '.');
        $this->modalFormChange = true;
    }

    public function save()
    {


        $this->validate([
            'status' => 'required',

        ]);

        DB::beginTransaction();
        try {
            $order = Order::find($this->id);
            $order->status = $this->status;
            $order->save();

            if ($this->status == 'completed') {

                $data = $this->validate([
                    'status' => 'required',
                    'amount' => 'required|numeric',
                    'total_amount' => 'required|numeric'
                ]);

                if ($data['amount'] < $data['total_amount']) {
                    $this->addError('amount', 'Pembayaran harus lebih besar atau sama dengan Total pembayaran.'); // atau field lain sesuai konteks
                    return;
                }
                Payment::create([
                    'order_id' => $this->id,
                    'amount' => $this->total_amount,
                    'payment_method' => $this->payment_method == 'qris' ? 'transfer' : 'cash',
                ]);
            }
            DB::commit();
        } catch (GlobalThrowable $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
        }

        $this->modalFormChange = false;

        $this->reset();
        $this->dispatch('success', message: 'Order updated status successfully');
    }

    public function closeModal()
    {
        $this->modalFormChange = false;
        $this->reset();
    }



    public function render()
    {
        if ($this->payment_method == 'qris') {
            $this->total_amount = str_replace('.', '', $this->total_amount);
            $this->amount = number_format($this->total_amount, 0, ',', '.');
            $this->total_amount = number_format($this->total_amount, 0, ',', '.');
            $this->spending = 0;
        } else {
            if ($this->amount > 0) {
                $this->total_amount = str_replace('.', '', $this->total_amount);
                $this->amount = str_replace('.', '', $this->amount);
                $this->spending = str_replace('.', '', ($this->amount - $this->total_amount));

                // diformat lagi setelah perhitungan
                $this->total_amount = number_format($this->total_amount, 0, ',', '.');
                $this->amount = number_format($this->amount, 0, ',', '.');
                $this->spending = number_format($this->spending, 0, ',', '.');
            } else {
                $this->spending = '-' . $this->total_amount;
            }
        }
        return view('livewire.components.order.modalchange');
    }
}
