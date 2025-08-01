<?php

namespace App\Livewire\Components\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\on;

class Modalchange extends Component
{
    public $modalFormChange = false;

    public $id;
    public $change_status = false;
    public $status;
    public $total_amount;
    public $amount=0;
    public $spending=0;
    public $cash = true;
    public $qris = false;
    public function mount() {}

    #[On('open-modal-change')]
    public function openModal($id)
    {
        $this->id = $id;
        $order = Order::find($id);
        $this->total_amount = number_format($order->total_amount, 0, ',', '.');
        $this->spending = number_format(($this->amount - $order->total_amount), 0, ',', '.');
        $this->modalFormChange = true;
    }

    public function save()
    {
        $this->validate([
            'status' => 'required',
        ]);

        $order = Order::find($this->id);
        $order->status = $this->status;
        $order->save();

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
        return view('livewire.components.order.modalchange');
    }
}
