<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $guarded = [];

   public function serviceEmployeeWork()
    {
        return $this->hasMany(ServiceEmployeeWork::class);
    }

    public function service()
    {
        return $this->belongsToMany(Service::class, 'service_employee_work')
            ->withPivot('work_id')
            ->withTimestamps();
    }

    public function work()
    {
        return $this->belongsToMany(Work::class, 'service_employee_work')
            ->withPivot('service_id')
            ->withTimestamps();
    }
}
