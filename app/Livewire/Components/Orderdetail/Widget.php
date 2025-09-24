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

    // public $order_payment;
    public $start_date;
    public $end_date;
    public $orderdetail_notpickup;
    public $orderdetail_notpickup_date;
    public $processStatus;
    public $pendingStatus;
    public $doneStatus;

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
    public function setDoneStatus($status)
    {
        if ($this->doneStatus == 'done') {
            $this->doneStatus = null;
            // dd('null');
        } else {
            $this->doneStatus = $status;
            // dd('gass');
        }
        $this->dispatch(
            'doneFilterUpdated',
            doneStatus: $this->doneStatus
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
        $this->orderdetail_notpickup_date = OrderDetail::with('order')
            ->where('pickup_status', '!=', 'completed')
            // ->whereHas('order', function ($q) use ($start, $end) {
            //     $q->whereBetween('order_date', [$start, $end]);
            // })
            ->get();



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
