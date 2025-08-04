<?php

namespace App\Livewire\Components\Order;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Service;
use Livewire\Attributes\on;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
// use PhpParser\Node\Stmt\TryCatch;

class Modalform extends Component
{

    public $modalFormData = false;
    public $id;
    public $update_data = false;

    public $name;
    public $email;
    public $phone_number;
    public $address;


    public $customer;
    public $service;
    public $weight = 0;
    public $amount = 0; // angka bersih yang dipakai perhitungan
    public $displayAmount = ''; // angka yang terlihat user

    #[On('open-modal')]
    public function openModal()
    {
        $this->modalFormData = true;
    }

    public function closeModal()
    {
        $this->modalFormData = false;
        $this->reset();
    }

    public function getCustomers()
    {
        return Customer::all();
    }
    public function getServices()
    {
        return Service::all();
    }

    #[On('edit-modal')]
    public function editModal($id)
    {

        $this->id = $id;
        $this->update_data = true;
        $this->modalFormData = true;

        $order = Order::find($id);
        $this->customer = $order->customer_id;
        $this->service = $order->detail->service_id;
        $this->weight = $order->detail->weight;
        // $this->amount = $order->detail->subtotal;
        $this->amount = $order->total_amount;
        $this->mount();

        // dd($this->customer);
    }
    public function save()
    {
        $this->validate([
            'customer' => 'required',
            'service' => 'required',
            'weight' => 'required|numeric|min:0.01',
        ]);


        DB::beginTransaction();

        try {

            if ($this->update_data) {
                $order = Order::find($this->id);
                $order->update([
                    'customer_id' => $this->customer,
                    'total_amount' => $this->amount
                ]);
                $order->detail->update([
                    'service_id' => $this->service,
                    'weight' => $this->weight,
                    'subtotal' => $this->amount,
                ]);
                $this->reset();
                $this->dispatch('success', message: 'Order updated successfully');
            } else {

                $order = Order::create([
                    'customer_id' => $this->customer,
                    'total_amount' => $this->amount
                ]);
                OrderDetail::create([
                    'order_id' => $order->id,
                    'service_id' => $this->service,
                    'weight' => $this->weight,
                    'subtotal' => $this->amount,
                ]);
                $this->reset();
                $this->dispatch('success', message: 'Order created successfully');
            }
            DB::commit();
            $this->closeModal();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
        }
    }

    public function mount()
    {
        $this->displayAmount = $this->format($this->amount);
    }
    public function updatedDisplayAmount($value)
    {
        // hapus semua selain digit
        $clean = preg_replace('/\D/', '', $value);
        $this->amount = $clean;

        // set kembali display dengan format ribuan
        $this->displayAmount = $this->format($clean);
    }

    private function format($n)
    {
        if ($n === '' || $n === null) {
            return '';
        }
        // Kalau angka sangat besar, pastikan $n adalah string dari digit
        return number_format((int)$n, 0, ',', '.');
    }
    public function updatedWeight()
    {
        $this->recalculateAmount();
    }
    public function updatedService()
    {
        $this->recalculateAmount();
    }

    protected function recalculateAmount()
    {
        // dd($this->service);
        $this->validate([
            'service' => 'required|numeric',
            'weight' => 'required|numeric|min:0.01'
        ]);
        if ($this->service) {
            if ($service = Service::find($this->service)) {
                $this->amount = $service ? $this->weight * $service->price : 0;
            }
        }
        $this->mount();
    }


    public function render()
    {

        // if ($this->service && $this->weight) {
        //     $service = Service::find($this->service);
        //     $this->amount = $this->weight * $service->price;
        // }
        return view('livewire.components.order.modalform', [
            'customers' => $this->getCustomers(),
            'services' => $this->getServices()
        ]);
    }
}
