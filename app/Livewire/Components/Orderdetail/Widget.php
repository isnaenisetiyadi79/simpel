<?php

namespace App\Livewire\Components\Orderdetail;

use App\Models\OrderDetail;
use DB;
use Livewire\Component;
use Livewire\Attributes\On;

class Widget extends Component
{

    public $orderdetail = [];

    public $order_payment;

     public function mount()
    {
        $this->orderdetail = OrderDetail::all();


         $this->order_payment = DB::table('payments')
            // ->join('pickups', 'pickups.id', '=', 'payments.pickup_id')
            ->join('order_details', 'order_details.order_id', '=', 'payments.order_id')
            // ->join('pickup_details', 'pickup_details.order_detail_id', '=', 'order_details.id')
            ->select(DB::raw('COALESCE(SUM(payments.amount), 0) as total_payment'))
            ->value('order_payment');
    }

     #[On('success')]
    public function messageSuccess($message)
    {
        $this->orderdetail = OrderDetail::all();
    }
    public function render()
    {
        return view('livewire.components.orderdetail.widget');
    }
}
