<?php

namespace App\Livewire\Components\Receivable;

use App\Models\Pickup;
use Livewire\Attributes\On;
use Livewire\Component;

class Widget extends Component
{
    public $pickups = [];
    public $total = 0;
    public $paid = 0;
    public $due = 0;
    public $search;
    public $dateFrom;
    public $dateTo;

    protected $listeners = ['pickups-loaded' => 'updateDate'];
    // #[On('pickups-loaded')]

    public function updateDate($search, $start, $end)
    {
        $this->search = $search;
        $this->dateFrom = $start;
        $this->dateTo = $end;
    }
    public function loadData()
    {
        $search = $this->search;
        $dateFrom = $this->dateFrom;
        $dateTo = $this->dateTo;
        $query = Pickup::with(['pickupdetail.orderdetail.service', 'pickupdetail.orderdetail.order', 'payment', 'customer'])
            ->withSum('payment as paid_total', 'amount')
            ->when(
                $search,
                fn($q) =>
                $q->whereHas(
                    'customer',
                    fn($q2) =>
                    $q2->where('name', 'ilike', "%{$search}%")
                )
                    ->orWhereHas(
                        'pickupdetail.orderdetail',
                        fn($q3) =>
                        $q3->where('description', 'ilike', "%{$search}%")
                    )
                    ->orWhere('note', 'ilike', "%{$search}%")
            )
            ->when($dateFrom, fn($q) => $q->where('pickup_date', '>=', $dateFrom))
            ->when($dateTo,   fn($q) => $q->where('pickup_date', '<=', $dateTo))
            ->whereRelation('pickupdetail.orderdetail.order', 'payment_status', '!=', 'paid');

        $pickups = $query->get();

        // total tagihan
        $this->total = $pickups->sum(function ($pickup) {
            return $pickup->pickupdetail->sum(function ($detail) {
                $od = $detail->orderdetail;
                return $od->service->is_package
                    ? $detail->qty * $od->price
                    : $detail->qty * $od->width * $od->length * $od->price;
            });
        });

        // total bayar (pakai withSum)
        $this->paid = $pickups->sum('paid_total');

        // sisa hutang
        $this->due = max(0, $this->total - $this->paid);
    }

    public function updated($field)
    {
        $this->loadData($this->search, $this->dateFrom, $this->dateTo);
    }
    public function render()
    {
        $this->loadData();
        return view('livewire.components.receivable.widget');
    }
}
