<?php

namespace App\Livewire\Components\Order;

use Livewire\Component;

class Modalchange extends Component
{
    public $modalFormData = false;

    public $id;
    public $update_data = false;


    public function render()
    {
        return view('livewire.components.order.modalchange');
    }
}
