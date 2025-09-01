<?php

namespace App\Livewire\Components\Pickup;

use App\Models\PickupDetail;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Widget extends Component
{

    public $pickupdetail = [];
    public $total;
    public $total_payment;

    public function mount()
    {
        // dd(
        //     DB::table('pickup_details')->count(),
        //     DB::table('order_details')->count(),
        //     DB::table('pickup_details')
        //         ->join('order_details', 'order_details.id', '=', 'pickup_details.order_detail_id')
        //         ->count()
        // );
        $this->pickupdetail = PickupDetail::all();
        $this->total = DB::table('pickup_details')
            ->join('order_details', 'order_details.id', '=', 'pickup_details.order_detail_id') // filter pickup tertentu
            ->select(DB::raw('COALESCE(SUM(order_details.qty * order_details.price), 0) as total'))
            ->value('total');
        $this->total_payment = DB::table('payments')
            ->join('order_details', 'order_details.order_id', '=', 'payments.order_id')
            ->join('pickup_details', 'pickup_details.order_detail_id', '=', 'order_details.id')
            ->select(DB::raw('COALESCE(SUM(payments.amount), 0) as total_payment'))
            ->value('total_payment');
    }

    #[On('success')]
    public function messageSuccess($message)
    {
        $this->mount();
    }

    public function render()
    {
        return view('livewire.components.pickup.widget');
    }
}
