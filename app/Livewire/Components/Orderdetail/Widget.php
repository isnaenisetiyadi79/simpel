<?php

namespace App\Livewire\Components\Orderdetail;

use App\Models\OrderDetail;
use Livewire\Component;
use Livewire\Attributes\On;

class Widget extends Component
{

    public $orderdetail = [];

     public function mount()
    {
        $this->orderdetail = OrderDetail::all();
    }

     #[On('success')]
    public function messageSuccess($message)
    {
        $this->orderdetail = OrderDetail::all();
    }
    public function render()
    {
        return view('livewire.components.orderdetail.widget');
    }
}
