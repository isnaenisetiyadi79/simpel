<?php

namespace App\Livewire\Components\Payment;

use App\Models\Payment;
use Livewire\Component;

class Widget extends Component
{
    // public $totalAmount;
    // public $pageAmount;

    public $dateFrom;
    public $dateTo;

     protected $listeners = ['dateFilterUpdated' => 'updateDate'];

    public function updateDate($start, $end)
    {
        $this->dateFrom = $start;
        $this->dateTo   = $end;
    }

     public function getItems()
    {
        return Payment::query()
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->get();
        // ->latest();
        // dd($this->payments);
        // $this->totalAmount = $allPayments->sum('amount');
        // $this->payments = $allPayments->paginate(10);
    }
    public function mount()
    {
        // default nilai tanggal
        $this->dateFrom = now()->startOfMonth()->toDateString();
        $this->dateTo   = now()->endOfMonth()->toDateString();
    }

    public function render()
    {
        return view('livewire.components.payment.widget', [
            'payments' => $this->getItems(),
        ]);
    }
}
