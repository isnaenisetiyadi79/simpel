<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupDetailEmployeeWork extends Model
{
    //
    protected $guarded = [];

    public function pickupdetail()
    {
        return $this->hasOne(PickupDetail::class);
    }

    public function work()
    {
        return $this->belongsTo(Work::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
