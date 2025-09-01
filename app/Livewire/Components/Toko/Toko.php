<?php

namespace App\Livewire\Components\Toko;

use Livewire\Component;
use App\Models\Toko as TokoModel;
class Toko extends Component
{
    public $toko;
    public $name;
    public $slogan;
    public $phone_number;
    public $address;
    public $note;
    public $printer_width;


    public function mount()
    {
        $this->toko = TokoModel::first();
        $this->name = $this->toko->name;
        $this->slogan = $this->toko->slogan;
        $this->phone_number = $this->toko->phone_number;
        $this->address = $this->toko->address;
        $this->note = $this->toko->note;
        $this->printer_width = $this->toko->printer_width;
    }

    public function save()
    {

        $this->toko->update([
            'name' => $this->name,
            'slogan' => $this->slogan,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'note' => $this->note,
            'printer_width' => $this->printer_width,
        ]);
        session()->flash('success', 'Data toko telah diupdate');
    }
    public function render()
    {
        return view('livewire.components.toko.toko');
    }
}
