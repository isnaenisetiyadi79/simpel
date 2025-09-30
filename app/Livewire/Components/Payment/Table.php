<?php

namespace App\Livewire\Components\Payment;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Table extends Component
{

    use WithPagination, WithoutUrlPagination;
    public $dateFrom;
    public $dateTo;
    // public $paymentQuery;
    // public $totalAmount;

    public function mount()
    {
        $this->dateFrom = now()->startOfMonth()->toDateString();
        $this->dateTo   = now()->endOfMonth()->toDateString();
        $this->getItems();
    }
    public function updated($field)
    {
        if (in_array($field, ['dateFrom', 'dateTo'])) {
            // kirim ke komponen lain (WidgetSalary)
            $this->dispatch(
                'dateFilterUpdated',
                start: $this->dateFrom,
                end: $this->dateTo
            );
        }
    }

    public function getItems()
    {
        return Payment::query()
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo));
        // ->latest();
        // dd($this->payments);
        // $this->totalAmount = $allPayments->sum('amount');
        // $this->payments = $allPayments->paginate(10);
    }
    public function render()
    {

        return view('livewire.components.payment.table', [
            'payments' => $this->getItems()->latest()->paginate(10),
            // 'totalAmount' => $this->getItems()->sum('amount'),
        ]);
    }
}
