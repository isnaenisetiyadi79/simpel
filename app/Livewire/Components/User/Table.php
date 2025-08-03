<?php

namespace App\Livewire\Components\User;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Table extends Component
{

    use WithPagination, WithoutUrlPagination;

    public $search;
    public function render()
    {
        return view('livewire.components.user.table');
    }
}
