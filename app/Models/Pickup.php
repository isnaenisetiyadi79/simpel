<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pickup extends Model
{
    protected $guarded = [];
    protected $casts = [
        'pickup_date' => 'date', // atau 'datetime' kalau di DB bertipe DATETIME
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function pickupdetail()
    {
        return $this->hasMany(PickupDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    // Hitung subtotal per pickup
    public function getSubtotalAttribute()
    {
        $this->loadMissing('pickupdetail.orderdetail.service');
        return $this->pickupdetail->sum(function ($pd) {
            $qty = $pd->qty;
            $od = $pd->orderdetail;
            $price = $od->price;
            $width = $od->width ?? 1;
            $length = $od->length ?? 1;
            $qty_asli = $od->qty_asli ?? 1;
            $qty_final = $od->qty_final ?? 1;

            $isPackage = $od->service->is_package ?? false;

            $subtotal = 0.00;
            if($isPackage) {
                if((float)$qty_asli === (float)$qty_final)
                {
                    $subtotal = $qty * $price;
                }else {
                    $subtotal = $qty_final * $price;
                }
            }else {
                if((float)$qty_asli === (float)$qty_final)
                {
                    $subtotal = $qty * $width * $length * $price;
                }else {
                    $subtotal = $qty_final * $price;
                }
            }

            return $subtotal;
        });
    }

    // Hitung total pembayaran per pickup
    // pembayaran yang nyambung langsung ke pickup_id
    public function directPayments()
    {
        return $this->hasMany(Payment::class, 'pickup_id');
    }

    // pembayaran yang nyambung via order
    public function getOrderPaymentsAttribute()
    {
        return $this->pickupdetail
            ->flatMap(fn($pd) => $pd->orderdetail?->order?->payment ?? collect());
    }

    public function getPaidTotalAttribute()
    {
        $totalDirect = $this->directPayments->sum('amount');
        $totalOrder  = $this->order_payments->sum('amount');

        return $totalDirect + $totalOrder;
    }

    // Hitung sisa outstanding per pickup
    public function getOutstandingAttribute()
    {
        return max(0, $this->subtotal - $this->paid_total);
    }
}
