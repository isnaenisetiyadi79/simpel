<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pickup extends Model
{
    protected $guarded = [];

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

    public function payments() {
        return $this->belongsTo(Payment::class);
    }

}
