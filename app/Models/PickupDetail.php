<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupDetail extends Model
{
    //
    protected $guarded = [];

    public function pickup()
    {
        return $this->belongsTo(Pickup::class);
    }
    public function orderdetail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }
    public function service()
    {
        return $this->orderDetail->service ?? null;
    }
}
