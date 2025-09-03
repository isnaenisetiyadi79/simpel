<?php

namespace App\Livewire\Components\Salary;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Widget extends Component
{
    public $start_date;
    public $end_date;
    public $gajiKaryawan = [];

    protected $listeners = ['dateFilterUpdated' => 'updateDate'];

    public function updateDate($start, $end)
    {
        $this->start_date = $start;
        $this->end_date   = $end;
    }
    public function mount()
    {
        // default nilai tanggal
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->end_date   = now()->endOfMonth()->toDateString();
    }

    public function loadData()
    {
        $start = $this->start_date
            ? Carbon::parse($this->start_date)->startOfDay()
            : now()->startOfMonth();

        $end = $this->end_date
            ? Carbon::parse($this->end_date)->endOfDay()
            : now()->endOfMonth();
        $this->gajiKaryawan = DB::table('pickup_detail_employee_works as pdew')
            ->join('pickup_details as pd', 'pd.id', '=', 'pdew.pickup_detail_id')
            ->join('order_details as od', 'od.id', '=', 'pd.order_detail_id')
            ->join('works as w', 'w.id', '=', 'pdew.work_id')
            ->join('employees as e', 'e.id', '=', 'pdew.employee_id')
            ->join('pickups as p', 'p.id', '=', 'pd.pickup_id')
            ->whereBetween('p.created_at', [$start, $end])
            ->select(
                'e.id as employee_id',
                'e.name as employee_name',
                DB::raw('
                SUM(
                    COALESCE(pdew.pay_default)
                ) as total_salary
            ')
            )
            ->groupBy('e.id', 'e.name')
            ->get();
        // dd($this->gajiKaryawan);
    }

    public function render()
    {
        $this->loadData();

        return view('livewire.components.salary.widget', [
            'gajiKaryawan' => $this->gajiKaryawan,
        ]);
    }
}
