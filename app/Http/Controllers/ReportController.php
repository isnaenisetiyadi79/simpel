<?php

namespace App\Http\Controllers;

use App\Livewire\Components\Salary\Table;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function salary() {
        return view('reports.salary');
    }

    public function printsalary(Request $request, Table $table)
    {

        // dd('sampaisini');
        // panggil ulang query dari komponen
        $table->start_date = $request->start_date;
        $table->end_date   = $request->end_date;

        return view('printsalary', [
            'rows' => $table->getRowsProperty(),
            'employees'  => $table->employees,
            'start_date' => $table->start_date,
            'end_date'   => $table->end_date,
        ]);
    }

    public function print()
    {
        return view('report.print');
    }
}
