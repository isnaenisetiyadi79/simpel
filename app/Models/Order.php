<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function detail() {
        return $this->hasMany(OrderDetail::class);
        // return $this->hasOne(OrderDetail::class);
    }
    public function payment()
    {
        // return $this->hasOne(Payment::class);
        return $this->hasMany(Payment::class);
        // return $this->belongsTo(Payment::class);
    }
    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
