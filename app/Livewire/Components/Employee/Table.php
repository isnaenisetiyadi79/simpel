<?php

namespace App\Livewire\Components\Employee;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\On;
class Table extends Component
{

    use WithPagination, WithoutUrlPagination;

    public $search;


     public function openModal()
    {
        $this->dispatch('open-modal');
    }

    #[On('success')]
    public function messageSuccess($message)
    {
        $this->resetPage();
        session()->flash('success', $message);
    }

    public function edit($id)
    {
        $this->dispatch('edit-modal', $id);
    }

    public function getItems()
    {
        return Employee::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
    public function render()
    {
        return view('livewire.components.employee.table', ['employees' => $this->getItems()]);
    }
}
