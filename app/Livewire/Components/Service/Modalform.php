<?php

namespace App\Livewire\Components\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\On;

class Modalform extends Component
{

    public $modalFormData = false;
    public $id;
    public $update_data = false;

    public $price;
    public $name;
    public $description;
    public $is_package;
    public $unit;
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

        $service = Service::find($id);
        $this->name = $service->name;
        $this->price = $service->price;
        $this->description = $service->description;
        $this->unit = $service->unit;
        $this->is_package = $service->is_package;
    }

    public function save()
    {
        $this->validate([

            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'unit' => 'required',
        ]);

        if ($this->update_data) {
            $service = Service::find($this->id);
            $service->update([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'unit' => $this->unit,
                'is_package' => $this->is_package ?? false,
            ]);
            $this->dispatch('success', 'Service updated successfully');
            $this->reset();
        } else {
            Service::create([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'unit' => $this->unit,
                'is_package' => $this->is_package ?? false,
            ]);
            $this->dispatch('success', 'Service created successfully');
            $this->reset();
        }
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.components.service.modalform');
    }
}
