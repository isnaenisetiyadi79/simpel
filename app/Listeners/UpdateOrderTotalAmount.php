<?php

namespace App\Listeners;

use App\Events\OrderDetailUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateOrderTotalAmount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderDetailUpdated $event): void
    {
        $orderDetail = $event->orderDetail;
        $order = $orderDetail->order;

        if ($order) {
            $newTotalAmount = $order->orderDetail()->sum('subtotal');
            $order->total_amount = $newTotalAmount;

            // Logika tambahan untuk menangani kelebihan bayar
            $paidAmount = $order->payment()->sum('paid_amount');
            if ($paidAmount >= $newTotalAmount) {
                // Atur status menjadi 'paid' meskipun ada kelebihan bayar
                $order->payment_status = 'paid';
                // Kamu bisa menambahkan logika notifikasi atau pengembalian dana di sini
            } elseif ($paidAmount > 0) {
                $order->payment_status = 'partially';
            } else {
                $order->payment_status = 'unpaid';
            }

            $order->save();
        }
    }
}
