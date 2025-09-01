<?php

namespace App\Livewire\Components\Pickup;

use App\Models\Payment;
use App\Models\Pickup;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\PickupDetail;
use Livewire\Attributes\On;

class Table extends Component
{

    use WithPagination, WithoutUrlPagination;

    public $search;
    public $dateFrom = null;
    public $dateTo = null;


    // protected $listeners = [
    //     'pickupSaved' => '$refresh',
    // ];

    public function openWizard()
    {
        $this->dispatch('open-wizard');
    }



    #[On('success')]
    public function messageSuccess($message)
    {
        $this->resetPage();
        session()->flash('success', $message);
    }

    public function getPickupDetailsQuery()
    {
        return PickupDetail::query()
            ->with(['pickup.customer', 'orderdetail.service', 'pickup.payment'])
            ->when($this->search, function ($q) {
                $q->whereHas('pickup.customer', fn($q2) => $q2->where('name', 'ilike', '%' . $this->search . '%'))
                    ->orWhereHas('orderdetail', fn($q3) =>
                    $q3->where('description', 'ilike', '%' . $this->search . '%'));
            })
            ->addSelect([
                'dp' => Payment::selectRaw('COALESCE(SUM(payments.amount),0)')
                    ->join('order_details', 'order_details.order_id', '=', 'payments.order_id')
                    ->whereColumn('order_details.id', 'pickup_details.order_detail_id')
            ])
            ->addSelect([
                'bayarpickup' => Payment::selectRaw('COALESCE(SUM(amount),0)')
                    ->whereColumn('payments.pickup_id', 'pickup_details.pickup_id')
            ])
            ->when($this->dateFrom, fn($q) => $q->whereHas('pickup', fn($q2) => $q2->whereDate('pickup_date', '>=', $this->dateFrom)))
            ->when($this->dateTo, fn($q) => $q->whereHas('pickup', fn($q2) => $q2->whereDate('pickup_date', '<=', $this->dateTo)))
            ->latest();
    }

    public function print($id)
    {
        $this->redirectRoute('pickup.print', $id);
        // $this->redirectRoute('cetakstruk', $id);
    }

    public function render()
    {
        return view('livewire.components.pickup.table', [
            'pickups' => $this->getPickupDetailsQuery()->paginate(10)
        ]);
    }
}
