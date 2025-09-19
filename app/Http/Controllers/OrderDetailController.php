<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function printStatus($id) {
        $orderdetail = OrderDetail::find($id);
        $order = Order::find($orderdetail->order_id);
        $toko = Toko::first();
        return view('printstatusorderdetail', compact('orderdetail', 'order', 'toko'));
    }
}
