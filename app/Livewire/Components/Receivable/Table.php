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
    // public function getPickupQuery()
    // {
    //     return Pickup::query()
    //         ->with(['pickupdetail', 'pickupdetail.orderdetail', 'pickupdetail.orderdetail.order', 'payment', 'customer'])
    //         ->when($this->search, function ($q) {
    //             $q->where(function ($sub) {
    //                 $sub->whereHas(
    //                     'customer',
    //                     fn($q2) =>
    //                     $q2->where('name', 'ilike', '%' . $this->search . '%')
    //                 )
    //                     ->orWhereHas(
    //                         'pickupdetail.orderdetail',
    //                         fn($q3) =>
    //                         $q3->where('description', 'ilike', '%' . $this->search . '%')
    //                     )
    //                     ->orWhere('note', 'ilike', '%' . $this->search . '%');
    //             });
    //         })
    //         ->when(
    //             $this->dateFrom,
    //             fn($q) =>
    //             $q->where(
    //                 'pickup_date',
    //                 '>=',
    //                 $this->dateFrom
    //             )
    //         )
    //         ->when(
    //             $this->dateTo,
    //             fn($q) =>
    //             $q->where('pickup_date', '<=', $this->dateTo)

    //         )
    //         // subtotal pakai subquery
    //         // ->addSelect([
    //         //     'subtotal' => PickupDetail::selectRaw('SUM(pickup_details.qty * order_details.price)')
    //         //         ->join('order_details', 'order_details.id', '=', 'pickup_details.order_detail_id')
    //         //         ->whereColumn('pickup_details.pickup_id', 'pickups.id')
    //         // ])
    //         // // filter payment_status ≠ paid
    //         // ->whereHas('pickupdetail.orderdetail.order', fn($q) => $q->where('payment_status', '!=', 'paid'))
    //         // // filter pickup_status ≠ paid
    //         // ->whereHas('pickupdetail.orderdetail', fn($q) => $q->where('pickup_status', '!=', 'pending'))
    //         // ->latest();
    //         ->addSelect([
    //             'subtotal' => PickupDetail::selectRaw("
    //     COALESCE(SUM(
    //         CASE
    //             WHEN services.is_package = true
    //             THEN pickup_details.qty * order_details.width * order_details.length * order_details.price
    //             ELSE pickup_details.qty * order_details.price
    //         END
    //     ), 0)
    // ")
    //                 ->join('order_details', 'order_details.id', '=', 'pickup_details.order_detail_id')
    //                 ->join('services', 'services.id', '=', 'order_details.service_id')
    //                 ->whereColumn('pickup_details.pickup_id', 'pickups.id')
    //                 ->groupBy('pickup_details.pickup_id'),  // ⬅️ tambahkan groupBy di sini

    //             'paid_total' => Payment::selectRaw('COALESCE(SUM(payments.amount), 0)')
    //                 ->whereColumn('payments.pickup_id', 'pickups.id')
    //                 ->groupBy('payments.pickup_id'),  // ⬅️ supaya tidak duplikat
    //         ])
    //         ->latest();
    // }
    // public function getPickupQuery()
    // {
    //     return Pickup::query()
    //         // eager load yang berguna (jangan over-eager)
    //         ->with(['pickupdetail.orderdetail.service', 'payment', 'customer'])
    //         // search & date filters seperti sebelumnya
    //         ->when($this->search, function ($q) {
    //             $q->where(function ($sub) {
    //                 $sub->whereHas('customer', fn($q2) => $q2->where('name', 'ilike', '%' . $this->search . '%'))
    //                     ->orWhereHas('pickupdetail.orderdetail', fn($q3) => $q3->where('description', 'ilike', '%' . $this->search . '%'))
    //                     ->orWhere('note', 'ilike', '%' . $this->search . '%');
    //             });
    //         })
    //         ->when($this->dateFrom, fn($q) => $q->where('pickup_date', '>=', $this->dateFrom))
    //         ->when($this->dateTo,   fn($q) => $q->where('pickup_date', '<=', $this->dateTo))

    //         // paid_total: gunakan withSum (lebih andal)
    //         ->withSum('payment as paid_total', 'amount')

    //         // subtotal: total nilai semua pickup_details untuk pickup ini
    //         ->addSelect([
    //             'subtotal' => \App\Models\PickupDetail::selectRaw("
    //             COALESCE(SUM(
    //                 CASE
    //                     WHEN services.is_package THEN
    //                         pickup_details.qty * COALESCE(order_details.width, 1) * COALESCE(order_details.length, 1) * order_details.price
    //                     ELSE
    //                         pickup_details.qty * order_details.price
    //                 END
    //             ), 0)
    //         ")
    //                 ->join('order_details', 'order_details.id', '=', 'pickup_details.order_detail_id')
    //                 ->join('services', 'services.id', '=', 'order_details.service_id')
    //                 ->whereColumn('pickup_details.pickup_id', 'pickups.id')
    //             // <-- NO groupBy here
    //         ])

    //         // optional filters you had before (jaga konsistensi)
    //         ->whereHas('pickupdetail.orderdetail.order', fn($q) => $q->where('payment_status', '!=', 'paid'))
    //         ->whereHas('pickupdetail.orderdetail', fn($q) => $q->where('pickup_status', '!=', 'pending'))

    //         // ordering: pakai pickup_date atau created_at sesuai kebutuhan
    //         ->latest('pickup_date');
    // }
    public function getPickupQuery()
    {
        return Pickup::with([
            'pickupdetail.orderdetail.service',
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
            ->latest('pickup_date')
            ->paginate(10);
    }



    public function print($id)
    {
        $this->redirectRoute('pickup.print', $id);
        // $this->redirectRoute('cetakstruk', $id);
    }

    public function render()
    {
        $pickups = [];

        return view('livewire.components.receivable.table', [
            // 'orders' => $this->getOrderQuery()->paginate(10),
            'pickups' => $this->getPickupQuery()
        ]);
    }
}
