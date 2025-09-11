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
    // protected $listeners = ['orderCreated' => '$refresh'];

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
    // public function edit($id)
    // {
    //     $this->dispatch('edit-modal', $id);
    //     $order = Order::find($id);
    //     $this->dispatch('value', [
    //         'customer' => $order->customer_id,
    //         'service' => $order->detail->service_id,
    //     ]);
    // }

    public function changeStatus($id)
    {

        $this->dispatch('open-modal-change', $id);
    }
    public function getItems()
    {
        $query = OrderDetail::with(['order.customer', 'service'])
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->whereRelation('order.customer', 'name', 'ilike', "%{$this->search}%")
                        ->orWhereRelation('service', 'name', 'ilike', "%{$this->search}%");
                });
            })
            ->when(
                $this->dateFrom,
                fn($q) =>
                $q->whereDate('created_at', '>=', Carbon::parse($this->dateFrom))
            )
            ->when(
                $this->dateTo,
                fn($q) =>
                $q->whereDate('created_at', '<=', Carbon::parse($this->dateTo))
            )
            ->latest();

        // return view('livewire.components.order.table', [
        //     'details' => $query->paginate(10)
        // ]);
        return $query->paginate(10);
    }

    public function print($id)
    {
        $this->redirectRoute('order.print', $id);
    }

    public function render()
    {
        return view('livewire.components.order.table', ['details' => $this->getItems()]);
    }
}
