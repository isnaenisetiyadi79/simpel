<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Pail\ValueObjects\Origin\Console;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // get data order last 7 days
        $orders = Order::whereDate('created_at', '>=', now()->subDays(10))->get();

        // dd($orders);
        // get list date lat 7 days
        $today = now();
        $dates = collect();
        $startDate = $today->copy()->subDays(10);
        $endDate = $today;

        for ($i = 9; $i >= 0; $i--) {
            $dates->push($today->copy()->subDays($i)->format('d F Y'));
            // $dates->push(\Illuminate\Support\Carbon::parse($today->copy()->subDays($i))->locale('id')->translatedFormat('d F Y'));
        }

        $categories = $dates->map(fn ($date) => \Illuminate\Support\Carbon::parse($date)->locale('id')->translatedFormat('d F Y'))->toArray();
        // dd($categories);
        $sales = [];
        foreach ($dates as $date) {
            $sales[] = Order::whereDate('created_at', $date)
            ->where('status', 'completed')
            ->sum('total_amount');
        }
        // dd($sales);
        return view('dashboard', compact('orders', 'categories', 'sales'));
    }
}
