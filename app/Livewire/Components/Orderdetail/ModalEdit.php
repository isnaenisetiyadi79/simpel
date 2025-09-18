<?php

namespace App\Livewire\Components\Orderdetail;

use App\Models\OrderDetail;
use Livewire\Component;
use Livewire\Attributes\on;
use Illuminate\Validation\Rule;
use App\Events\OrderDetailUpdated;
use App\Models\Service;

class ModalEdit extends Component
{
    public $modalFormData = false;
    public $id;

    public $order_id;
    public $service_id;
    public $description;
    public $length = 0.00;
    public $width = 0.00;
    public $qty = 0.00;
    public $qty_asli = 0.00;
    public $qty_final = 0.00;
    public $price = 0.00;
    public $subtotal = 0.00;
    public $process_status;
    public $pickup_status;

    // Variabel data
    public $services;
    public $service;

    protected $listeners = ['open-modal-edit' => 'openModal'];
    // #[On('open-modal-edit')]
    public function openModal($id)
    {
        $this->id = $id;
        $orderDetail = OrderDetail::find($id);
        if ($orderDetail) {
            $this->service_id = $orderDetail->service_id;
            $this->description = $orderDetail->description;
            $this->length = $orderDetail->length;
            $this->width = $orderDetail->width;
            $this->qty = $orderDetail->qty;
            $this->qty_asli = $orderDetail->qty_asli;
            $this->qty_final = $orderDetail->qty_final;
            $this->price = $orderDetail->price;
            $this->subtotal = $orderDetail->subtotal;
            $this->process_status = $orderDetail->process_status;
            $this->pickup_status = $orderDetail->pickup_status;
        }
        $this->service = Service::find($orderDetail->service_id);

        $this->modalFormData = true;
    }

    public function mount()
    {
        $this->services = Service::all();
    }
    public function closeModal()
    {
        $this->modalFormData = false;
        // $this->reset();
    }

    public function updatedServiceId()
    {

        $this->validate(
            [
                'service_id' => 'required'
            ]
        );

        $this->service = Service::find($this->service_id);
        $this->price = $this->service->price;
        $this->recalculatedSubtotal();
    }

    public function updated($propertyName)
    {
        $this->recalculatedSubtotal();
    }

    public function recalculatedSubtotal()
    {
        $this->validate([
            'width' => 'required|numeric',
            'length' => 'required|numeric',
            'qty' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        if (!$this->service->is_package) {
            $this->qty_final = $this->width * $this->length * $this->qty;
            $this->subtotal = (float)$this->width * $this->length * $this->qty * $this->price;
        }else {
            $this->qty_final = $this->qty;
            $this->subtotal = (float)$this->qty * $this->price;

        }
    }
    public function getSubtotalFormattedProperty()
    {
        return number_format($this->subtotal, 2, ',', '.');
    }

    public function getQtyFinalFormattedProperty()
    {
        return number_format($this->qty_final, 2, ',', '.');
    }

    protected function rules()
    {
        return [
            'description' => 'nullable|string|max:255',
            'length' => 'required|numeric|min:0',
            'width' => 'required|numeric|min:0',
            'qty_asli' => 'required|numeric|min:0',
            'qty_final' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'process_status' => ['required', Rule::in(['pending', 'process', 'done'])],
            'pickup_status' => ['required', Rule::in(['pending', 'partially', 'completed'])],
        ];
    }
    public function save()
    {
        // 1. Validasi data
        $this->validate();

        // 2. Ambil model
        $orderDetail = OrderDetail::find($this->id);

        if ($orderDetail) {
            // 3. Update atribut
            $orderDetail->service_id = $this->service_id;
            $orderDetail->description = $this->description;
            $orderDetail->length = $this->length;
            $orderDetail->width = $this->width;
            $orderDetail->qty = $this->qty;
            $orderDetail->qty_asli = $this->qty_asli;
            $orderDetail->qty_final = $this->qty_final;
            $orderDetail->price = $this->price;
            $orderDetail->subtotal = $this->subtotal;
            $orderDetail->process_status = $this->process_status;
            $orderDetail->pickup_status = $this->pickup_status;

            // Hitung ulang subtotal
            // $orderDetail->subtotal = $this->qty_final * $this->price;

            // 4. Simpan perubahan ke database
            $orderDetail->save();

            // 5. PANGGIL EVENT LARAVEL di sini
            event(new OrderDetailUpdated($orderDetail));

            // 6. Feedback dan tutup modal
            // session()->flash('message', 'Data order detail berhasil diperbarui!');
            $this->dispatch('success', message: 'Data order detail berhasil diperbarui!');
            $this->closeModal();

            // 7. Opsional: Panggil event Livewire untuk update tabel lain di halaman yang sama
            $this->dispatch('orderDetailUpdated');
        }
    }
    public function render()
    {
        return view('livewire.components.orderdetail.modal-edit');
    }
}
