<?php

namespace App\Livewire\Components\Pickup;

use App\Models\PickupDetail;
use Carbon\Carbon;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Widget extends Component
{

    public $pickupdetail = [];
    public $total;
    public $total_payment;
    public $order_payment;
    public $pickup_payment;
    public $dateFrom = null;
    public $dateTo = null;

    protected $listeners = ['dateFilterUpdated' => 'updateDate'];

    public function updateDate($start, $end)
    {
        $this->dateFrom = $start;
        $this->dateTo   = $end;
    }
    public function mount()
    {
        $this->dateFrom = now()->startOfMonth()->toDateString();
        $this->dateTo   = now()->endOfMonth()->toDateString();
    }

    public function loadData()
    {
        $start = $this->dateFrom
            ? Carbon::parse($this->dateFrom)->startOfDay()
            : now()->startOfMonth();

        $end = $this->dateTo
            ? Carbon::parse($this->dateTo)->endOfDay()
            : now()->endOfMonth();
        $this->pickupdetail = PickupDetail::whereBetween('created_at', [
            Carbon::parse($start),
            Carbon::parse($end)
        ])->get();
        // $this->total = DB::table('pickup_details')
        //     ->join('order_details', 'order_details.id', '=', 'pickup_details.order_detail_id') // filter pickup tertentu
        //     ->select(DB::raw('COALESCE(SUM(pickup_details.qty * order_details.price), 0) as total'))
        //     ->value('total');
        $this->total = DB::table('pickup_details')
            ->join('order_details', 'order_details.id', '=', 'pickup_details.order_detail_id')
            ->join('services', 'services.id', '=', 'order_details.service_id')
            ->whereBetween('pickup_details.created_at', [
                Carbon::parse($start),
                Carbon::parse($end),
            ])
            ->select(DB::raw("
        COALESCE(
            SUM(
                CASE
                    WHEN services.is_package = true
                        THEN pickup_details.qty * order_details.price
                    ELSE pickup_details.qty * order_details.width * order_details.length * order_details.price
                END
            ), 0
        ) as total
    "))
            ->value('total');
        $this->order_payment = DB::table('payments')
            // ->join('pickups', 'pickups.id', '=', 'payments.pickup_id')
            ->join('order_details', 'order_details.order_id', '=', 'payments.order_id')
            ->join('pickup_details', 'pickup_details.order_detail_id', '=', 'order_details.id')
            ->whereBetween('pickup_details.created_at', [
                Carbon::parse($start),
                Carbon::parse($end),
            ])
            ->select(DB::raw('COALESCE(SUM(payments.amount), 0) as total_payment'))
            ->value('order_payment');
        $this->pickup_payment = DB::table('payments')
            ->join('pickups', 'pickups.id', '=', 'payments.pickup_id')
            ->whereBetween('pickups.created_at', [
                Carbon::parse($start),
                Carbon::parse($end),
            ])
            ->select(DB::raw('COALESCE(SUM(payments.amount), 0) as total_payment'))
            ->value('pickup_payment');
        $this->total_payment = $this->order_payment + $this->pickup_payment;
    }
    #[On('success')]
    public function messageSuccess($message)
    {
        $this->loadData();
    }

    public function render()
    {
        $this->loadData();
        return view('livewire.components.pickup.widget');
    }
}
