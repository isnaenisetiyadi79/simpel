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

    public function setProcessStatus($status)
    {
        if ($this->processStatus == 'pending') {
            $this->processStatus = null;
            // dd('null');
        } else {
            $this->processStatus = $status;
            // dd('gass');
        }

    }

    public function loadData()
    {
        $start = $this->start_date
            ? Carbon::parse($this->start_date)->startOfDay()
            : now()->startOfMonth();

        $end = $this->end_date
            ? Carbon::parse($this->end_date)->endOfDay()
            : now()->endOfMonth();
        // $this->orderdetail = OrderDetail::all();
        $this->orderdetail = OrderDetail::whereBetween('created_at', [
            Carbon::parse($start),
            Carbon::parse($end)
        ])->get();

        $this->orderdetail_notpickup = OrderDetail::where('pickup_status', '!=','completed')->get();

        $this->order_payment = Payment::join('order_details', 'order_details.order_id', '=', 'payments.order_id')
            ->whereBetween('order_details.created_at', [
                Carbon::parse($start),
                Carbon::parse($end),
            ])
            ->selectRaw('COALESCE(SUM(payments.amount), 0) as total_payment')
            ->value('total_payment');

        // ->join('pickups', 'pickups.id', '=', 'payments.pickup_id')
        // ->join('pickup_details', 'pickup_details.order_detail_id', '=', 'order_details.id')
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
