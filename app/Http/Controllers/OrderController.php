<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Toko;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        return view('order');
    }

    public function print($id)
    {
        $order = Order::withSum('payment as paid_sum', 'amount')
            ->find($id);
        // dd($order);
        // Hitung total order (sum qty_final * price)
        $total_order = DB::table('order_details')
            ->where('order_id', $order->id)
            ->select(DB::raw('COALESCE(SUM(qty_final * price), 0) as total'))
            ->value('total');

        // Outstanding = total order - total payment
        $kembali =0;
        $outstanding =0;
        if($total_order >= $order->paid_sum) {
            $outstanding = abs($total_order - $order->paid_sum);
        }else {
            $kembali = abs($total_order - $order->paid_sum);
        }

        // Ambil data toko (kalau diperlukan untuk invoice)
        $toko = Toko::first();

        return view('printorder', compact('order', 'toko', 'total_order', 'outstanding','kembali'));
    }
}
