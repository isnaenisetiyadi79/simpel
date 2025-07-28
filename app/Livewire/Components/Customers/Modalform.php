<?php

namespace App\Livewire\Components\Customers;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Customer;
use GuzzleHttp\Psr7\Message;

class Modalform extends Component
{

    public $modalFormData = false;

    public $name;
    public $email;
    public $phone_number;
    public $address;

    #[On('open-modal')]
    public function openModal()
    {
        $this->modalFormData = true;
    }
    public function render()
    {
        return view('livewire.components.customers.modalform');
    }

    public function closeModal()
    {
        $this->modalFormData = false;
    }

    public function save() 
    {

         $this->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'phone_number' => 'required|numeric',
            'address' => 'required|string'
        ]);
        
        $customer = Customer::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address
        ]);

        $this->closeModal();
        // session()->flash('succcess', 'Customer created succesfully');
        $this->dispatch('success', message: "Customer created successfully");
        
    }
}
