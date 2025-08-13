<?php

namespace App\Livewire\Components\Order;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use PhpParser\Node\Stmt\TryCatch;

class Ordercreatemodal extends Component
{

    public $showModal = false;

    public $customer_id;
    public $order_note;
    public $order_date;

    public $details = [];

    public $customers;
    public $services;

    // protected $listeners = ['openOrderModal' => 'openModal'];

    public function mount()
    {
        $this->customers = Customer::all();
        $this->services = Service::all();
        $this->resetForm();
    }

    #[On('open-modal')]
    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
        // $this->dispatch('open-modal');
    }
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        // $this->dispatch('open-modal');
    }

    #[On('setCustomer')]
    public function setCustomer($id)
    {
        $this->customer_id = $id;
    }

    public function resetForm()
    {
        $this->customer_id = null;
        $this->order_date = now()->toDateString();
        $this->order_note = '';
        $this->details = [
            // default one empty row
            [
                'service_id' => null,
                'length' => 0,
                'width' => 0,
                'qty' => 0,
                'qty_asli' => 0,
                'use_rounding' => false,
                'qty_final' => 0,
                'price' => 0,
                'subtotal' => 0,
                'description' => '',
            ]
        ];
    }

    public function addRow()
    {
        $this->details[] = [
            'service_id' => null,
            'length' => 0,
            'width' => 0,
            'qty' => 0,
            'qty_asli' => 0,
            'use_rounding' => false,
            'qty_final' => 0,
            'price' => 0,
            'subtotal' => 0,
            'description' => '',
        ];
    }

    public function removeRow($index)
    {
        unset($this->details[$index]);
        $this->details = array_values($this->details);
    }



    public function updated($name, $value)
    {
        // logger("updated called with name: $name and value: $value");

        if (str_starts_with($name, 'details.')) {
            $parts = explode('.', $name);

            if (count($parts) === 3) {
                [, $index, $field] = $parts;
                $index = (int) $index;

                if (!isset($this->details[$index])) return;

                $serviceId = $this->details[$index]['service_id'] ?? null;
                $service = $serviceId ? Service::find($serviceId) : null;

                // Jika field service_id diubah, set price default
                if ($field === 'service_id' && $service) {
                    $this->details[$index]['price'] = (float) $service->price;
                    $this->details[$index]['is_package'] = $service->is_package;
                }

                // Hitung qty_asli untuk area based
                if ($service) {
                    if ($service->is_package) {
                        $this->details[$index]['qty_asli'] = (float) ($this->details[$index]['qty'] ?? 0);
                    } else {

                        $length = (float) ($this->details[$index]['length'] ?? 0);
                        $width  = (float) ($this->details[$index]['width'] ?? 0);
                        $qty  = (float) ($this->details[$index]['qty'] ?? 0);
                        $this->details[$index]['qty_asli'] = $length * $width * $qty;
                    }
                } else {
                    $this->details[$index]['qty_asli'] = (float) ($this->details[$index]['qty_asli'] ?? 0);
                }

                // Logika rounding qty_final
                $useRounding = (bool) ($this->details[$index]['use_rounding'] ?? false);
                if ($service && $useRounding) {
                    // $threshold = (float) ($service->rounding_threshold ?? 1);
                    // $threshold = (float) 1;
                    $qtyAsli = $this->details[$index]['qty_asli'];
                    // $this->details[$index]['qty_final'] = ($qtyAsli < $threshold) ? $threshold : $qtyAsli;
                    $this->details[$index]['qty_final'] = ceil($qtyAsli);
                } else {
                    $this->details[$index]['qty_final'] = $this->details[$index]['qty_asli'];
                }

                // Hitung subtotal
                $price = (float) ($this->details[$index]['price'] ?? 0);
                $qtyFinal = (float) ($this->details[$index]['qty_final'] ?? 0);
                $this->details[$index]['subtotal'] = round($price * $qtyFinal, 2);
            }
        }
    }
    public function save()
    {
        // dd('di sini');
        $this->validate([
            'customer_id' => 'required',
            // 'details' => 'required|array|min:1',
            'details.*.service_id' => 'required|exists:services,id',
            'details.*.qty_final' => 'required|numeric|min:0.0001'
        ]);
        // dd('di sini');

        DB::beginTransaction();
        try {

            $order = Order::create([
                'customer_id' => $this->customer_id,
                'order_date' => $this->order_date,
                'total_amount' => array_sum(array_column($this->details, 'subtotal')),
                'note' => $this->order_note,
            ]);

            foreach ($this->details as $d) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'service_id' => $d['service_id'],
                    'length' => $d['length'],
                    'width' => $d['width'],
                    'qty_asli' => $d['qty_asli'],
                    'qty_final' => $d['qty_final'],
                    'price' => $d['price'],
                    'subtotal' => $d['subtotal'],
                    'description' => $d['description'],
                ]);
            }
            DB::commit();
            $this->dispatch('success', message: 'Orders added succesfully');
            $this->closeModal();
        } catch (\Throwable $th) {
            DB::rollBack();
            // $this->dispatch('error', message : 'Error' . $th->getMessage());
            session()->flash('error', $th->getMessage());
            // $this->closeModal();
        }


        // $this->showModal = false;
        // $this->emit('orderCreated');

    }
    public function render()
    {
        return view('livewire.components.order.ordercreatemodal');
    }
}
