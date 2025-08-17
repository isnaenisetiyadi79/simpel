<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceEmployeeWork extends Model
{
    //

    protected $table = 'service_employee_work';
    protected $guarded = [];

    public function service()
    {
        return $this->belongsTo(Service::class);
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
