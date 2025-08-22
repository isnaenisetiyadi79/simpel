<?php

namespace App\Livewire\Components\Pickup;

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
        // $this->dispatch('openWizardFromIndex')->to(PickupWizardModal::class);
        // $this->dispatchBrowserEvent('open-pickup-wizard');
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

        // return Pickup::query()
        //     ->with(['customer', 'pickupdetail.orderdetail.service'])
        //     ->when($this->search, function ($q) {
        //         $q->whereHas('customer', function ($q2) {
        //             $q2->where('name', 'like', '%' . $this->search . '%');
        //         })->orWhere('id', 'like', '%' . $this->search . '%');
        //     })
        //     ->when($this->dateFrom, fn($q) => $q->whereDate('pickup_date', '>=', $this->dateFrom))
        //     ->when($this->dateTo, fn($q) => $q->whereDate('pickup_date', '<=', $this->dateTo))
        //     ->latest();
        return PickupDetail::query()
            ->with(['pickup.customer', 'orderdetail.service'])
            ->when($this->search, function ($q) {
                $q->whereHas('pickup.customer', fn($q2) => $q2->where('name', 'ilike', '%' . $this->search . '%'))
                    ->orWhereHas('orderdetail', fn($q3) =>
                    $q3->where('description', 'ilike', '%' . $this->search . '%'));
            })
            ->when($this->dateFrom, fn($q) => $q->whereHas('pickup', fn($q2) => $q2->whereDate('pickup_date', '>=', $this->dateFrom)))
            ->when($this->dateTo, fn($q) => $q->whereHas('pickup', fn($q2) => $q2->whereDate('pickup_date', '<=', $this->dateTo)))
            ->latest();
        // return PickupDetail::query()
        //     ->with(['pickup.customer', 'orderdetail.service'])
        //     ->when($this->search, function ($q) {
        //         $q->whereHas(
        //             'pickup.customer',
        //             fn($q2) =>
        //             $q2->where('name', 'like', '%' . $this->search . '%')
        //         );
        //     })
        //     ->when(
        //         $this->dateFrom,
        //         fn($q) =>
        //         $q->whereHas(
        //             'pickup',
        //             fn($q2) =>
        //             $q2->whereDate('pickup_date', '>=', $this->dateFrom)
        //         )
        //     )
        //     ->when(
        //         $this->dateTo,
        //         fn($q) =>
        //         $q->whereHas(
        //             'pickup',
        //             fn($q2) =>
        //             $q2->whereDate('pickup_date', '<=', $this->dateTo)
        //         )
        //     )
        //     ->latest();
    }

    public function render()
    {
        return view('livewire.components.pickup.table', [
            'pickups' => $this->getPickupDetailsQuery()->paginate(10)
        ]);
    }
}
