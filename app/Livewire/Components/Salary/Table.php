<?php

namespace App\Livewire\Components\Salary;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $start_date;
    public $end_date;
    public $employees = [];

    public function mount()
    {
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->end_date   = now()->endOfMonth()->toDateString();
    }

    public function updated($field)
    {
        if (in_array($field, ['start_date', 'end_date'])) {
            // kirim ke komponen lain (WidgetSalary)
            $this->dispatch(
                'dateFilterUpdated',
                start: $this->start_date,
                end: $this->end_date
            );
        }
    }

    // public function getRowsProperty()
    // {
    //     $start = Carbon::parse($this->start_date)->startOfDay();
    //     $end   = Carbon::parse($this->end_date)->endOfDay();

    //     // Ambil data mentah
    //     $raw = DB::table('pickup_detail_employee_works as pdew')
    //         ->join('pickup_details as pd', 'pd.id', '=', 'pdew.pickup_detail_id')
    //         ->join('pickups as p', 'p.id', '=', 'pd.pickup_id')
    //         ->join('order_details as od', 'od.id', '=', 'pd.order_detail_id')
    //         ->join('orders as o', 'o.id', '=', 'od.order_id')
    //         ->join('customers as c', 'c.id', '=', 'o.customer_id')
    //         ->leftJoin('employees as e', 'e.id', '=', 'pdew.employee_id')
    //         ->whereBetween('p.pickup_date', [$start, $end])
    //         ->select(
    //             'p.pickup_date',
    //             'c.name as customer',
    //             'od.width',
    //             'od.length',
    //             'pd.qty',
    //             'od.qty_final',
    //             DB::raw('(od.price * pd.qty) as subtotal'),
    //             'e.name as employee_name',
    //             'pdew.pay_default'
    //         )
    //         ->orderBy('p.pickup_date')
    //         ->get();

    //     // Ambil semua nama karyawan unik (untuk header kolom dinamis)
    //     $this->employees = $raw->pluck('employee_name')->filter()->unique()->values();
    //     $employees = $this->employees;

    //     // Bentuk baris per pickup_detail (grouping by semua field non-employee)
    //     $grouped = $raw->groupBy(function ($row) {
    //         return implode('|', [
    //             $row->pickup_date,
    //             $row->customer,
    //             $row->width,
    //             $row->length,
    //             $row->qty,
    //             $row->qty_final,
    //             $row->subtotal,
    //         ]);
    //     });

    //     // Transform ke stdClass dengan kolom karyawan dinamis
    //     $rows = $grouped->map(function ($items, $key) use ($employees) {
    //         $first = $items->first();

    //         // base data
    //         $row = [
    //             'pickup_date' => $first->pickup_date,
    //             'customer'    => $first->customer,
    //             'width'       => $first->width,
    //             'length'      => $first->length,
    //             'qty'         => $first->qty,
    //             'qty_final'   => $first->qty_final,
    //             'subtotal'    => $first->subtotal,
    //         ];

    //         // kolom dinamis gaji per karyawan
    //         foreach ($employees as $emp) {
    //             $pay = $items->where('employee_name', $emp)->sum('pay_default');
    //             $row[$emp] = $pay;
    //         }

    //         return (object) $row; // cast ke stdClass biar bisa -> di Blade
    //     })->values();

    //     // paginate manual
    //     $perPage = 10;
    //     $page = request()->get('page', 1);
    //     $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
    //         $rows->forPage($page, $perPage),
    //         $rows->count(),
    //         $perPage,
    //         $page,
    //         ['path' => request()->url(), 'query' => request()->query()]
    //     );

    //     // return $paginator;
    //     return $rows->paginate(10);
    // }
    public function getRowsProperty()
    {
        $start = Carbon::parse($this->start_date)->startOfDay();
        $end   = Carbon::parse($this->end_date)->endOfDay();

        // Ambil data mentah
        $raw = DB::table('pickup_detail_employee_works as pdew')
            ->join('pickup_details as pd', 'pd.id', '=', 'pdew.pickup_detail_id')
            ->join('pickups as p', 'p.id', '=', 'pd.pickup_id')
            ->join('order_details as od', 'od.id', '=', 'pd.order_detail_id')
            ->join('orders as o', 'o.id', '=', 'od.order_id')
            ->join('customers as c', 'c.id', '=', 'o.customer_id')
            ->join('services as s', 's.id', '=', 'od.service_id')
            ->leftJoin('employees as e', 'e.id', '=', 'pdew.employee_id')
            ->whereBetween('p.pickup_date', [$start, $end])
            ->select(
                'p.pickup_date',
                'c.name as customer',
                'od.width',
                'od.length',
                'pd.qty',
                'od.qty_final',
                'od.description',
                's.name as service_name',
                DB::raw("
            CASE
                WHEN s.is_package = true
                    THEN pd.qty * od.price
                ELSE pd.qty * od.width * od.length * od.price
            END as subtotal
        "),
                'e.name as employee_name',
                'pdew.pay_default'
            )
            ->orderBy('p.pickup_date')
            ->get();

        // Ambil semua nama karyawan unik (untuk header kolom dinamis)
        $this->employees = $raw->pluck('employee_name')->filter()->unique()->values();
        $employees = $this->employees;

        // Bentuk baris per pickup_detail (grouping by semua field non-employee)
        $grouped = $raw->groupBy(function ($row) {
            return implode('|', [
                $row->pickup_date,
                $row->customer,
                $row->width,
                $row->length,
                $row->qty,
                $row->qty_final,
                $row->subtotal,
                $row->description,
                $row->service_name,
            ]);
        });

        // Transform ke stdClass dengan kolom karyawan dinamis
        $rows = $grouped->map(function ($items, $key) use ($employees) {
            $first = $items->first();

            // base data
            $row = [
                'pickup_date' => $first->pickup_date,
                'customer'    => $first->customer,
                'width'       => $first->width,
                'length'      => $first->length,
                'qty'         => $first->qty,
                'qty_final'   => $first->qty_final,
                'subtotal'    => $first->subtotal,
                'description'   => $first->description,
                'service_name' => $first->service_name,
            ];

            // kolom dinamis gaji per karyawan
            foreach ($employees as $emp) {
                $pay = $items->where('employee_name', $emp)->sum('pay_default');
                $row[$emp] = $pay;
            }

            return (object) $row; // cast ke stdClass biar bisa -> di Blade
        })->values();

        // paginate manual
        $perPage = 10;
        $page = request()->get('page', 1);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $rows->forPage($page, $perPage),
            $rows->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // return $paginator; // ✅ ini yang dipakai
        return $rows; // ✅ ini yang dipakai
    }

    public function print()
    {
        // dd('sampai sini');
        return redirect()->route('printsalary', [
            'start_date' => $this->start_date,
            'end_date'   => $this->end_date,
        ]);
    }
    public function render()
    {

        return view('livewire.components.salary.table', [
            'rows' => $this->getRowsProperty(),
            'employees' => $this->employees,
        ]);
    }
}
