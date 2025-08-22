<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $guarded = [];

    public function serviceEmployeeWork()
    {
        return $this->hasMany(ServiceEmployeeWork::class);
    }

    public function work()
    {
        return $this->belongsToMany(Work::class, 'service_employee_work')
            ->withPivot('employee_id')
            ->withTimestamps();
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'service_employee_work')
            ->withPivot('work_id')
            ->withTimestamps();
    }
    public function orderdetail() {
        return $this->hasMany(OrderDetail::class);
    }
}
