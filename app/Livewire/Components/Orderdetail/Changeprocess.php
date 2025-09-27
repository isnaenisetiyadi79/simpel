<?php

namespace App\Livewire\Components\Orderdetail;

use App\Models\OrderDetail;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Changeprocess extends Component
{

    public $modalFormChange = false;
    public $id;
    public $process_status;

    #[On('open-modal-change')]
    public function openModal($id)
    {
        $this->id = $id;
        $orderdetail = OrderDetail::find($id);
        $this->process_status =  $orderdetail->process_status;
        $this->modalFormChange = true;
    }

    public function closeModal()
    {
        $this->modalFormChange = false;
        $this->reset();
    }

    public function setProcessStatus($status)
    {
        $this->process_status = $status;
    }

    public function save()
    {
         $this->validate([
            'process_status' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $orderdetail = OrderDetail::find($this->id);
            $orderdetail->process_status = $this->process_status;
            $orderdetail->save();
        }catch(\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
        }
        DB::commit();
        $this->dispatch('success', message: 'Status order sudah dirubah menjadi ' . $this->process_status);
        // dd($this->process_status);
        if ($this->process_status == 'done') {
            $this->redirectRoute('orderdetail.printStatus', $this->id);
        }
        $this->closeModal();
    }

    public function printStatusPesanan($id){
       return redirect()->route('orderdetail.printStatus', $id);
    }
    public function render()
    {
        return view('livewire.components.orderdetail.changeprocess');
    }
}
