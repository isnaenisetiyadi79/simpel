<?php

namespace App\Livewire\Components\Receivable;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Pickup;
use App\Models\PickupDetail;
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

    public function mount()
    {
        $this->loadWidgetData();
    }

    #[On('success')]
    public function messageSuccess($message)
    {
        $this->resetPage();
        session()->flash('success', $message);
    }

    public function openModalBayarHutang($id)
    {
        $this->dispatch('open-modal-bayar-hutang', $id);
    }

    public function pickupQuery()
    {
        return Pickup::with([
            'pickupdetail.orderdetail.service',
            'pickupdetail.orderdetail.order',
            'payment',
            'customer'
        ])
            ->withSum('payment as paid_total', 'amount')
            ->when(
                $this->search,
                fn($q) =>
                $q->whereHas(
                    'customer',
                    fn($q2) =>
                    $q2->where('name', 'ilike', "%{$this->search}%")
                )
                    ->orWhereHas(
                        'pickupdetail.orderdetail',
                        fn($q3) =>
                        $q3->where('description', 'ilike', "%{$this->search}%")
                    )
                    ->orWhere('note', 'ilike', "%{$this->search}%")
            )
            ->when($this->dateFrom, fn($q) => $q->where('pickup_date', '>=', $this->dateFrom))
            ->when($this->dateTo,   fn($q) => $q->where('pickup_date', '<=', $this->dateTo))
            // ->whereHas('pickupdetail.orderdetail.order', fn($q) => $q->where('payment_status','!=','paid'))
            ->whereRelation('pickupdetail.orderdetail.order', 'payment_status', '!=', 'paid')
            ->latest('pickup_date');
    }
    public function getPickupQuery()
    {

        return $this->pickupQuery()->paginate(10);
    }

    public function loadWidgetData()
    {
        $this->dispatch(
            'pickups-loaded',
            search: $this->search,
            start: $this->dateFrom,
            end: $this->dateTo
        );
    }

    // public function updated($name, $value)
    // {
    //     if (in_array($name, ['search', 'dateFrom', 'dateTo'])) {
    //         $this->loadWidgetData();
    //     }
    // }

    public function print($id)
    {
        $this->redirectRoute('pickup.print', $id);
        // $this->redirectRoute('cetakstruk', $id);
    }

    public function render()
    {
        $pickups = [];
        $this->loadWidgetData();

        return view('livewire.components.receivable.table', [
            // 'orders' => $this->getOrderQuery()->paginate(10),
            'pickups' => $this->getPickupQuery()
        ]);
    }
}
