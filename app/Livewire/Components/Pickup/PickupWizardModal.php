<?php

namespace App\Livewire\Components\Pickup;

use App\Models\Customer;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Pickup;
use App\Models\PickupDetail;
use App\Models\Service;
use App\Models\Employee;
use App\Models\Work;

class PickupWizardModal extends Component
{
    public $showWizard = false;

    // Step controll
    public $step = 1;

    // Step 1 filters/selection
    public $customer_id;
    public $order_id;
    public $availableOrders = [];
    public $availableOrderDetails = [];
    public $selectedDetailIds = [];
    public $selectAll = false;

    // Step 2 filters(final)
    public $selectedRows = [];
    public $pickup_date;
    public $note;

    // Data pendukung
    public $customers;

    // Payment section (Step 2)
    public $order_total = 0;
    public $paid_total = 0; // total payments recorded (order-level)
    public $outstanding = 0; //order_total - paid_total
    public $pay_now = 0;
    public $change = 0;
    public $payment_method = 'cash';


    #[On('open-wizard')]
    public function openWizard()
    {
        $this->resetWizard();
        $this->showWizard = true;
    }
    public function closeWizard()
    {
        $this->resetWizard();
        $this->showWizard = false;
    }

    public function mount()
    {
        $this->customers = Customer::all();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            // centang semua
            $this->selectedDetailIds = collect($this->availableOrderDetails)->pluck('id')->toArray();
        } else {
            // kosongkan
            $this->selectedDetailIds = [];
        }
    }

    public function updatedSelectedDetailIds()
    {
        // kalau semua dicentang manual, selectAll juga otomatis aktif
        $this->selectAll = count($this->selectedDetailIds) === count($this->availableOrderDetails);
    }
    public function resetWizard()
    {
        $this->step = 1;
        $this->customer_id = null;
        $this->order_id = null;
        $this->availableOrders = [];
        $this->availableOrderDetails = [];
        $this->selectedDetailIds = [];
        $this->selectedRows = [];
        $this->selectAll = false;
        $this->pickup_date = now()->format('Y-m-d\TH:i');
        $this->note = null;

        $this->order_total = 0;
        $this->paid_total = 0;
        $this->outstanding = 0;
        $this->pay_now = 0;
        $this->change = 0;
        $this->payment_method = 'cash';
    }

    public function updatedCustomerId()
    {
        $this->order_id = null;
        $this->availableOrders = Order::query()
            ->where('customer_id', $this->customer_id)
            ->orderByDesc('id')
            ->get(['id', 'total_amount', 'payment_status'])
            ->toArray();

        $this->availableOrderDetails = [];
        $this->selectedDetailIds = [];
    }

    public function updatedOrderId()
    {
        // Ambil order details yang boleh di-pickup
        $ods = OrderDetail::query()
            ->with(['service:id,name'])
            ->where('order_id', $this->order_id)
            ->where('process_status', 'done')
            ->whereIn('pickup_status', ['pending', 'partially'])
            ->get();

        $this->availableOrderDetails = $ods->map(function ($od) {
            return [
                'id' => $od->id,
                'service_name' => optional($od->service)->name,
                'qty' => (float)$od->qty_final,
                'price' => (float)$od->price,
                'subtotal' => (float)$od->subtotal,
                'description' => $od->description,
            ];
        })->toArray();

        // Hitung total & pembayaran existing
        $order = Order::withSum('payment as paid_sum', 'amount')->find($this->order_id);
        $this->order_total = (float)($order->total_amount ?? 0);
        $this->paid_total = (float)($order->paid_sum ?? 0);
        $this->outstanding = max(0, $this->order_total - $this->paid_total);
        // $this->change = (float) $this->outstanding - $this->pay_now;
        $this->selectedDetailIds = [];
    }

    public function nextFromStep1()
    {
        // Validasi ada pilihan
        if (empty($this->selectedDetailIds)) {
            $this->addError('selectedDetailIds', 'Pilih minimal 1 item.');
            return;
        }

        // Bangun rows final (Step 2)
        $details = OrderDetail::with(['service.work', 'service.employees']) // relasi bantuan (lihat catatan di bawah)
            ->whereIn('id', $this->selectedDetailIds)->get();


        $this->selectedRows = $details->map(function ($od) {
            return [
                'order_detail' => $od,
                'service'      => $od->service,
                'works'        => $od->service->work->map(function ($w) {
                    return [
                        'work'        => $w,
                        'employee_id' => $w->pivot->employee_id ?? null,
                        'fee'         => (float) optional(optional($w->pivot)->service)->default_pay ?? 0,
                    ];
                }) ?? collect(),
                'employees' => Employee::orderBy('name')->get(), // kalau semua karyawan
                'note'      => $od->description,
            ];
        });
        // dd($this->selectedRows);
        $this->step = 2;
        // dd($this->selectedRows);
    }

    public function backToStep1()
    {
        $this->step = 1;
    }

    public function updatedPayNow()
    {
        $max = max(0, $this->outstanding);
        // if ($this->pay_now > $max) {
        //     $this->pay_now = $max;
        // }
        if ($this->pay_now < 0) {
            $this->pay_now = 0;
        }
            $this->change = (float) $this->pay_now - $this->outstanding;
    }

    // public function updated()
    // {
    //     // dd('disini');
    //     $this->validate([
    //         'outstanding' => 'required|numeric',
    //         'pay_now' => 'required|numeric',
    //     ]);
    //     $this->change = (float) $this->outstanding - $this->pay_now;
    // }
    public function render()
    {
        if ($this->payment_method == 'transfer') {
            $this->pay_now = $this->outstanding;
        }

        return view('livewire.components.pickup.pickup-wizard-modal');
    }
}
