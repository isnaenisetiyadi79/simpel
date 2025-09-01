<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pickup;
use App\Models\Toko;
use Illuminate\Http\Request;

class PickupController extends Controller
{

    public function index()
    {
        return view('pickup');
    }

    public function print($id)
    {
        // query pickup
        $pickup = Pickup::withSum('payment as paid_sum', 'amount')->find($id);
        $total_order = \DB::table('order_details')
            ->join('pickup_details', 'pickup_details.order_detail_id', '=', 'order_details.id')
            ->where('pickup_details.pickup_id', $id)
            ->sum(\DB::raw('order_details.qty_final * order_details.price'));

        // query order
        $order_id = $pickup->pickupdetail->first()->orderdetail->order_id;
        $order = Order::withSum('payment as paid_sum', 'amount')->find($order_id);
        // dd($order->paid_sum);
        // dd($pickup->paid_sum);
        $paid_sum = (float) $pickup->paid_sum + $order->paid_sum;
        $outstanding = 0;
        $kembali = 0;
        if ($total_order >= $paid_sum) {
            $outstanding = abs($total_order - ($pickup->paid_sum + $order->paid_sum));
        } else {
            $kembali = abs($total_order - ($pickup->paid_sum + $order->paid_sum));
        }
        // dd($total_order);
        // dd($outstanding);
        // query toko
        $toko = Toko::first();

        // render
        return view('printpickup', compact('pickup', 'toko', 'total_order', 'paid_sum', 'outstanding', 'kembali'));
    }
}
