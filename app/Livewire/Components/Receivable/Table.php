<?php

namespace App\Livewire\Components\Receivable;

use App\Models\Order;
use App\Models\Pickup;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search;
    public $dateFrom = null;
    public $dateTo = null;



    #[On('success')]
    public function messageSuccess($message)
    {
        $this->resetPage();
        session()->flash('success', $message);
    }

    // return PickupDetail::query()
    //     ->with(['pickup.customer', 'orderdetail.service'])
    //     ->when($this->search, function ($q) {
    //         $q->whereHas('pickup.customer', fn($q2) => $q2->where('name', 'ilike', '%' . $this->search . '%'))
    //             ->orWhereHas('orderdetail', fn($q3) =>
    //             $q3->where('description', 'ilike', '%' . $this->search . '%'));
    //     })
    //     ->when($this->dateFrom, fn($q) => $q->whereHas('pickup', fn($q2) => $q2->whereDate('pickup_date', '>=', $this->dateFrom)))
    //     ->when($this->dateTo, fn($q) => $q->whereHas('pickup', fn($q2) => $q2->whereDate('pickup_date', '<=', $this->dateTo)))
    //     ->latest();
    public function getOrderQuery()
    {
        return Order::query()
            ->with(['detail', 'detail.pickupdetail', 'payment', 'detail.pickupdetail.pickup', 'customer'])
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->whereHas(
                        'customer',
                        fn($q2) =>
                        $q2->where('name', 'ilike', '%' . $this->search . '%')
                    )
                        ->orWhereHas(
                            'detail',
                            fn($q3) =>
                            $q3->where('description', 'ilike', '%' . $this->search . '%')
                        )
                        ->orWhere('note', 'ilike', '%' . $this->search . '%');
                });
            })
            ->when(
                $this->dateFrom,
                fn($q) =>
                $q->whereHas(
                    'detail.pickupdetail.pickup',
                    fn($q2) =>
                    $q2->whereDate('pickup_date', '>=', $this->dateFrom)
                )
            )
            ->when(
                $this->dateTo,
                fn($q) =>
                $q->whereHas(
                    'detail.pickupdetail.pickup',
                    fn($q2) =>
                    $q2->whereDate('pickup_date', '<=', $this->dateTo)
                )
            )
            // filter payment_status ≠ paid
            ->where('payment_status', '!=', 'paid')
            // filter pickup_status ≠ paid
            ->whereHas('detail.pickupdetail.pickup', fn($q) => $q->where('pickup_status', '!=', 'paid'))
            ->latest();
    }
    public function getPickupQuery()
    {
        return Pickup::query()
            ->with(['pickupdetail', 'pickupdetail.orderdetail.order', 'payment', 'customer'])
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->whereHas(
                        'customer',
                        fn($q2) =>
                        $q2->where('name', 'ilike', '%' . $this->search . '%')
                    )
                        ->orWhereHas(
                            'pickupdetail.orderdetail',
                            fn($q3) =>
                            $q3->where('description', 'ilike', '%' . $this->search . '%')
                        )
                        ->orWhere('note', 'ilike', '%' . $this->search . '%');
                });
            })
            ->when(
                $this->dateFrom,
                fn($q) =>
                $q->where(
                    'pickup_date',
                    '>=',
                    $this->dateFrom
                )
            )
            ->when(
                $this->dateTo,
                fn($q) =>
                $q->where('pickup_date', '<=', $this->dateTo)

            )
            // filter payment_status ≠ paid
            ->whereHas('pickupdetail.orderdetail.order', fn($q) => $q->where('payment_status', '!=', 'paid'))
            // filter pickup_status ≠ paid
            ->whereHas('pickupdetail.orderdetail', fn($q) => $q->where('pickup_status', '!=', 'completed'))
            ->latest();
    }


    public function render()
    {
        return view('livewire.components.receivable.table', [
            // 'orders' => $this->getOrderQuery()->paginate(10),
            'pickups' => $this->getPickupQuery()->paginate(10)
        ]);
    }
}
