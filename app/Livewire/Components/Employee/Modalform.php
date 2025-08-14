<?php

namespace App\Livewire\Components\Employee;

use App\Models\Employee;
use Livewire\Component;
use Livewire\Attributes\On;

class Modalform extends Component
{
    public $modalFormData = false;
    public $id;
    public $update_data = false;

    public $name;
    public $phone;
    public $email;
    public $address;

    #[On('open-modal')]
    public function openModal()
    {
        $this->modalFormData = true;
    }
    public function closeModal()
    {
        $this->modalFormData = false;
        $this->reset();
    }

    #[On('edit-modal')]
    public function editModal($id)
    {
        $this->modalFormData = true;
        $this->update_data = true;
        $this->id = $id;

        $employee = Employee::find($id);
        $this->name = $employee->name;
        $this->phone = $employee->phone;
        $this->email = $employee->email;
        $this->address = $employee->address;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
        ]);

        if ($this->update_data) {
            $work = Employee::find($this->id);
            $work->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'address' => $this->address,

            ]);
            $this->dispatch('success', 'Employee updated successfully');
            $this->reset();
        } else {
            Employee::create([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'address' => $this->address,
            ]);
            $this->dispatch('success', 'Emloyee created successfully');
            $this->reset();
        }
        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.components.employee.modalform');
    }
}
