<?php

namespace App\Livewire\Components\Payment;

use Livewire\Component;

class Widget extends Component
{
    public $totalAmount;
    public $pageAmount;
    public function render()
    {
        return view('livewire.components.payment.widget');
    }
}
