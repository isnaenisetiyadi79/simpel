<?php

namespace App\Livewire\Components\Pickup;

use App\Models\Payment;
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
    public $pickup_payment_cash;
    public $pickup_payment_transfer;
    public $order_payment_cash;
    public $order_payment_transfer;
    public $order_payment_notpickup_cash;
    public $order_payment_notpickup_transfer;

    public $order_payment_notpickup;
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
        // order payment cash
        $this->order_payment_cash = DB::table('payments')
            ->join('order_details', 'order_details.order_id', '=', 'payments.order_id')
            ->join('pickup_details', 'pickup_details.order_detail_id', '=', 'order_details.id')
            ->whereBetween('pickup_details.created_at', [
                Carbon::parse($start),
                Carbon::parse($end),
            ])
            ->where('payments.payment_method', 'cash')
            ->sum('payments.amount');

        // order payment transfer (selain cash)
        $this->order_payment_transfer = DB::table('payments')
            ->join('order_details', 'order_details.order_id', '=', 'payments.order_id')
            ->join('pickup_details', 'pickup_details.order_detail_id', '=', 'order_details.id')
            ->whereBetween('pickup_details.created_at', [
                Carbon::parse($start),
                Carbon::parse($end),
            ])
            ->where('payments.payment_method', '<>', 'cash')
            ->sum('payments.amount');

        // pickup payment cash
        $this->pickup_payment_cash = DB::table('payments')
            ->join('pickups', 'pickups.id', '=', 'payments.pickup_id')
            ->whereBetween('pickups.created_at', [
                Carbon::parse($start),
                Carbon::parse($end),
            ])
            ->where('payments.payment_method', 'cash')
            ->sum('payments.amount');



        // pickup payment transfer (selain cash)
        $this->pickup_payment_transfer = DB::table('payments')
            ->join('pickups', 'pickups.id', '=', 'payments.pickup_id')
            ->whereBetween('pickups.created_at', [
                Carbon::parse($start),
                Carbon::parse($end),
            ])
            ->where('payments.payment_method', '<>', 'cash')
            ->sum('payments.amount');

        // total payment berdasar order.order_date (cash)
        $this->order_payment_notpickup_cash = Payment::join('orders', 'orders.id', '=', 'payments.order_id')
            ->whereBetween('orders.order_date', [$start, $end])
            // ->where('orderdetails.process', $this->processStatus)
            ->where('payments.payment_method', 'cash')
            ->selectRaw('COALESCE(SUM(payments.amount), 0) as total_payment')
            ->value('total_payment');

        // total payment berdasar order.order_date (selain cash)
        $this->order_payment_notpickup_transfer = Payment::join('orders', 'orders.id', '=', 'payments.order_id')
            ->whereBetween('orders.order_date', [$start, $end])
            // ->where('orderdetails.process', $this->processStatus)
            ->where('payments.payment_method', '<>', 'cash')
            ->selectRaw('COALESCE(SUM(payments.amount), 0) as total_payment')
            ->value('total_payment');

        $this->order_payment_notpickup = $this->order_payment_notpickup_cash + $this->order_payment_notpickup_transfer;
        $this->order_payment = $this->order_payment_cash + $this->order_payment_transfer;
        $this->pickup_payment = $this->pickup_payment_cash + $this->pickup_payment_transfer;
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
