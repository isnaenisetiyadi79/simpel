<?php

namespace App\Livewire\Components\Orderdetail;

use App\Models\OrderDetail;
use App\Models\Payment;
use Carbon\Carbon;
use DB;
use Livewire\Component;
use Livewire\Attributes\On;

class Widget extends Component
{

    public $orderdetail = [];

    public $order_payment;
    public $start_date;
    public $end_date;
    public $orderdetail_notpickup;
    public $processStatus;
    public $pendingStatus;

    protected $listeners = ['dateFilterUpdated' => 'updateDate'];
    public function updateDate($start, $end)
    {
        $this->start_date = $start;
        $this->end_date   = $end;
    }
    public function mount()
    {
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->end_date   = now()->endOfMonth()->toDateString();
    }

    public function setPendingStatus($status)
    {
        if ($this->pendingStatus == 'pending') {
            $this->pendingStatus = null;
            // dd('null');
        } else {
            $this->pendingStatus = $status;
            // dd('gass');
        }
        $this->dispatch(
            'pendingFilterUpdated',
            pendingStatus: $this->pendingStatus
        );
    }
    public function setProcessStatus($status)
    {
        if ($this->processStatus == 'process') {
            $this->processStatus = null;
            // dd('null');
        } else {
            $this->processStatus = $status;
            // dd('gass');
        }
        $this->dispatch(
            'processFilterUpdated',
            processStatus: $this->processStatus
        );
    }


    public function loadData()
    {
        $start = $this->start_date
            ? Carbon::parse($this->start_date)->startOfDay()
            : now()->startOfMonth();

        $end = $this->end_date
            ? Carbon::parse($this->end_date)->endOfDay()
            : now()->endOfMonth();


        // ambil orderdetail berdasar order.order_date
        $this->orderdetail = OrderDetail::whereHas('order', function ($q) use ($start, $end) {
            $q->whereBetween('order_date', [$start, $end]);
        })
            // ->where('process', $this->processStatus)
            ->get();

        // orderdetail yang belum pickup, tapi tetap filter berdasarkan order_date
        $this->orderdetail_notpickup = OrderDetail::with('order')
            ->where('pickup_status', '!=', 'completed')
            ->whereHas('order', function ($q) use ($start, $end) {
                $q->whereNotBetween('order_date', [$start, $end]);
            })
            ->get();


        // total payment berdasar order.order_date
        $this->order_payment = Payment::join('orders', 'orders.id', '=', 'payments.order_id')
            ->whereBetween('orders.order_date', [$start, $end])
            // ->where('orderdetails.process', $this->processStatus)
            ->selectRaw('COALESCE(SUM(payments.amount), 0) as total_payment')
            ->value('total_payment');
    }

    #[On('success')]
    public function messageSuccess($message)
    {
        $this->orderdetail = OrderDetail::all();
    }
    public function render()
    {
        $this->loadData();
        return view('livewire.components.orderdetail.widget');
    }
}
