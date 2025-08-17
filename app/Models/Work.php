<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Livewire\Volt\Exceptions\ReturnNewClassExecutionEndingException;

class Work extends Model
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
            ->withPivot('employee_id')
            ->withTimestamps();
    }

    public function employee()
    {
        return $this->belongsToMany(Employee::class, 'service_employee_work')
            ->withPivot('service_id')
            ->withTimestamps();
    }
}
