<?php

namespace App\Livewire\Components\Work;

use App\Models\Work;
use Livewire\Component;
use Livewire\Attributes\On;

class Modalform extends Component
{
    public $modalFormData = false;
    public $id;
    public $update_data = false;

    public $name;
    public $default_pay;
    public $description;
    public $one_time = false;


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

        $work = Work::find($id);
        $this->name = $work->name;
        $this->default_pay = $work->default_pay;
        $this->description = $work->description;
        $this->one_time = $work->one_time;
    }

    public function save()
    {
        $this->validate([

            'name' => 'required',
            'default_pay' => 'required|numeric',
        ]);

        if ($this->update_data) {
            $work = Work::find($this->id);
            $work->update([
                'name' => $this->name,
                'default_pay' => $this->default_pay,
                'description' => $this->description,
                'one_time' => $this->one_time,

            ]);
            $this->dispatch('success', 'Job updated successfully');
            $this->reset();
        } else {
            Work::create([
                'name' => $this->name,
                'default_pay' => $this->default_pay,
                'description' => $this->description,
                'one_time' => $this->one_time,
            ]);
            $this->dispatch('success', 'Job created successfully');
            $this->reset();
        }
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.components.work.modalform');
    }
}
