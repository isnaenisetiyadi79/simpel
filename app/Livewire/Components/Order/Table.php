<?php

namespace App\Livewire\Components\Order;

use App\Models\OrderDetail;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\on;

class Table extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search;
    public $dateFrom = null;
    public $dateTo = null;

    public $pendingStatus;
    public $processStatus;
    // protected $listeners = ['orderCreated' => '$refresh'];
    // public $dateFrom;
    // public $end_date;

    protected $listeners = [
        'pendingFilterUpdated' => 'updatePendingStatus',
        'processFilterUpdated' => 'updateProcessStatus',
    ];

    public function updatePendingStatus($pendingStatus)
    {
        // dd('sampai disini');
        $this->pendingStatus = $pendingStatus;
        $this->getItems();
    }
    public function updateProcessStatus($processStatus)
    {
        // dd('sampai disini');
        $this->processStatus = $processStatus;
        $this->getItems();
    }
    public function mount()
    {
        $this->dateFrom = now()->startOfMonth()->toDateString();
        $this->dateTo   = now()->endOfMonth()->toDateString();
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
    function openModal()
    {
        $this->dispatch('open-modal');
    }


    #[On('success')]
    public function messageSuccess($message)
    {
        $this->resetPage();
        session()->flash('success', $message);
    }

    public function openModalBayarDepe($id)
    {
        $this->dispatch('open-modal-bayar-depe', $id);
    }

    public function openModalEdit($id)
    {
        $this->dispatch('open-modal-edit', $id);
    }

    public function changeStatus($id)
    {

        $this->dispatch('open-modal-change', $id);
    }
    public function getItems()
    {
        $query = OrderDetail::with(['order.customer', 'service', 'order.orderdetail'])
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->whereRelation('order.customer', 'name', 'ilike', "%{$this->search}%")
                        ->orWhereRelation('service', 'name', 'ilike', "%{$this->search}%")
                        ->orWhereRelation('order.orderdetail', 'description', 'ilike', "%{$this->search}%");
                });
            })
            ->where(function ($q) {
                $q->where('pickup_status', '!=', 'completed')
                    ->orWhere(function ($sub) {
                        $sub->where('pickup_status', 'completed');

                        if ($this->dateFrom) {
                            $sub->whereDate('created_at', '>=', Carbon::parse($this->dateFrom));
                        }
                        if ($this->dateTo) {
                            $sub->whereDate('created_at', '<=', Carbon::parse($this->dateTo));
                        }
                    });
            })
            ->when($this->pendingStatus && $this->processStatus, function ($q) {
                $q->whereIn('process_status', [$this->pendingStatus, $this->processStatus]);
            })
            ->when($this->pendingStatus && !$this->processStatus, function ($q) {
                $q->where('process_status', $this->pendingStatus);
            })
            ->when(!$this->pendingStatus && $this->processStatus, function ($q) {
                $q->where('process_status', $this->processStatus);
            })
            ->latest();

        return $query->paginate(10);
    }

    public function print($id)
    {
        $this->redirectRoute('order.print', $id);
    }
    public function printStatus($id)
    {
        $this->redirectRoute('orderdetail.printStatus', $id);
    }

    public function render()
    {
        return view('livewire.components.order.table', ['details' => $this->getItems()]);
    }
}
