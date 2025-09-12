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
use Auth;
use Carbon\Carbon;

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
    public $pickupQty = [];

    // Step 2 filters(final)
    public $selectedRows = [];
    public $pickup_id;
    public $pickup_date;
    public $note;

    // Data pendukung
    public $customers;

    // Payment section (Step 2)
    public $order_total = 0;
    public $paid_total = 0; // total payment recorded (order-level)
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
        // refresh total setiap pilihan berubah
        $this->order_total = $this->pickupGrandTotal;
        $this->outstanding = max(0, $this->order_total - $this->paid_total);
    }

    public function updatedSelectedDetailIds()
    {
        // kalau semua dicentang manual, selectAll juga otomatis aktif
        $this->selectAll = count($this->selectedDetailIds) === count($this->availableOrderDetails);

        // refresh total setiap pilihan berubah
        $this->order_total = $this->pickupGrandTotal;
        $this->outstanding = max(0, $this->order_total - $this->paid_total);
        // dd($this->paid_total);
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
            ->whereHas('orderdetail', function ($query) {
                $query->whereIn('pickup_status', ['pending', 'partially']);
            })
            ->with(['orderdetail' => function ($query) {
                $query->select('id', 'order_id', 'description', 'pickup_status');
            }])
            ->orderByDesc('id')
            ->get(['id', 'total_amount', 'payment_status'])
            ->toArray();

        $this->availableOrderDetails = [];
        $this->selectedDetailIds = [];
    }

    // public function updatedOrderId()
    // {
    //     // Ambil order details yang boleh di-pickup
    //     $ods = OrderDetail::query()
    //         ->with(['service:id,name'])
    //         ->where('order_id', $this->order_id)
    //         ->where('process_status', 'done')
    //         ->whereIn('pickup_status', ['pending', 'partially'])
    //         ->get();

    //     $this->pickupQty = $ods->mapWithKeys(function ($od) {
    //         $picked = $od->pickupdetail()->sum('qty');
    //         $remaining = max(0, $od->qty - $picked);
    //         return [$od->id => $remaining];
    //     })->toArray();

    //     $this->availableOrderDetails = $ods->map(function ($od) {
    //         $picked = $od->pickupdetail()->sum('qty');
    //         return [
    //             'id' => $od->id,
    //             'service_name' => optional($od->service)->name,
    //             'qty' => (float)$od->qty,
    //             'qty_remaining' => max(0, (float)$od->qty - $picked),
    //             'price' => (float)$od->price,
    //             'subtotal' => (float)$od->subtotal,
    //             'description' => $od->description,
    //         ];
    //     })->toArray();

    //     // Hitung total & pembayaran existing
    //     $order = Order::withSum('payment as paid_sum', 'amount')->find($this->order_id);
    //     $this->order_total = (float)($order->total_amount ?? 0);
    //     $this->paid_total = (float)($order->paid_sum ?? 0);
    //     $this->outstanding = max(0, $this->order_total - $this->paid_total);
    //     // $this->change = (float) $this->outstanding - $this->pay_now;
    //     $this->selectedDetailIds = [];
    // }
    public function updatedOrderId()
    {
        // Ambil order details yang boleh di-pickup
        $ods = OrderDetail::query()
            ->with(['service:id,name'])
            ->where('order_id', $this->order_id)
            ->where('process_status', 'done')
            ->whereIn('pickup_status', ['pending', 'partially'])
            ->get();

        $this->pickupQty = $ods->mapWithKeys(function ($od) {
            $picked = $od->pickupdetail()->sum('qty');
            $remaining = max(0, $od->qty - $picked);
            return [$od->id => $remaining];
        })->toArray();

        $this->availableOrderDetails = $ods->map(function ($od) {
            $picked = $od->pickupdetail()->sum('qty');
            $qtyRemaining = max(0, (float)$od->qty - $picked);
            // dd($od->qty);
            return [
                'id' => $od->id,
                'service_id' => $od->service_id,
                'service_name' => optional($od->service)->name,
                'is_package' => (bool) (optional($od->service)->is_package ?? false),
                'length' => (float) $od->length,
                'width' => (float) $od->width,
                'qty' => (float) $od->qty,
                'qty_remaining' => $qtyRemaining,
                'price' => (float) $od->price,
                'subtotal' => (float) $od->subtotal, // subtotal original (boleh disimpan, tapi kita hitung ulang saat pickup)
                'description' => $od->description,
            ];
        })->toArray();

        // Hitung total & pembayaran existing
        $order = Order::withSum('payment as paid_sum', 'amount')->find($this->order_id);
        $this->order_total = (float)($order->total_amount ?? 0);
        $this->paid_total = (float)($order->paid_sum ?? 0);
        $this->outstanding = max(0, $this->order_total - $this->paid_total);
        $this->selectedDetailIds = [];
    }
    public function updatedPickupQty($value, $key)
    {

        // dd('proses sampai di sini A');
        // $key adalah order_detail id (karena pickupQty[order_detail_id])
        $detailId = (int) $key;

        // cari data detail di availableOrderDetails
        $detail = collect($this->availableOrderDetails)->firstWhere('id', $detailId);
        if (!$detail) return;

        $max = $detail['qty_remaining'] ?? 0;

        if ($value === null) {
            // bila kosongan, restore ke max (atau 0)
            $this->pickupQty[$detailId] = $max;
            return;
        }

        $val = (float) $value;
        if ($val < 1) {
            $this->pickupQty[$detailId] = 1;
        } elseif ($val > $max) {
            $this->pickupQty[$detailId] = $max;
        } else {
            // valid, sudah di-set otomatis oleh Livewire
            $this->pickupQty[$detailId] = $val;
        }

        // refresh total setiap qty berubah
        $this->order_total = $this->pickupGrandTotal;
        $this->outstanding = max(0, $this->order_total - $this->paid_total);
    }


    public function nextFromStep1()
    {
        // Validasi ada pilihan
        if (empty($this->selectedDetailIds)) {
            $this->addError('selectedDetailIds', 'Pilih minimal 1 item untuk bisa melanjutkan');
            return;
        }

        // Ambil detail lengkap (service + relasinya)
        $details = OrderDetail::with(['service.work', 'service.employees'])
            ->whereIn('id', $this->selectedDetailIds)
            ->get();

        $this->selectedRows = $details->map(function ($od) {
            // hitung sisa di DB (untuk limit dan safety)
            $picked = $od->pickupdetail()->sum('qty');
            $qtyRemaining = max(0, $od->qty - $picked);

            // ambil qty yang dipilih di Step 1 (fallback ke sisa jika tidak ada)
            $qtyUsed = $this->pickupQty[$od->id] ?? $qtyRemaining;
            $qtyUsed = (float) max(0, min($qtyUsed, $qtyRemaining));

            // hitung subtotal sesuai tipe service
            $subtotal = 0.0;
            $price = (float) $od->price;
            if ($od->service && $od->service->is_package) {
                $subtotal = $qtyUsed * $price;
            } else {
                $length = (float) $od->length;
                $width = (float) $od->width;
                $subtotal = $length * $width * $qtyUsed * $price;
            }

            // **Mutate model instance (memory only)** agar Blade yang memakai $row['order_detail']->qty/subtotal langsung menampilkan nilai baru
            $od->qty = $qtyUsed;
            $od->subtotal = $subtotal;

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
                'employees' => Employee::orderBy('name')->get(),
                'note'      => $od->description,
            ];
        })->values();

        // sinkronkan total / outstanding sesuai pilihan
        $this->order_total = $this->pickupGrandTotal;
        $this->outstanding = max(0, $this->order_total - $this->paid_total);

        $this->step = 2;
    }



    public function getPickupGrandTotalProperty()
    {
        //  dd('proses sampai di sini B');
        $total = 0;

        foreach ($this->availableOrderDetails as $row) {
            // hanya jumlahkan bila baris dipilih
            if (!in_array($row['id'], $this->selectedDetailIds ?? [])) continue;

            $qty = $this->pickupQty[$row['id']] ?? $row['qty_remaining'] ?? 0;
            if ($qty <= 0) continue;

            if ($row['is_package']) {
                $line = $qty * $row['price'];
            } else {
                $line = $row['length'] * $row['width'] * $qty * $row['price'];
            }

            $total += $line;
        }

        return $total;
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

    public function save()
    {
        // $this->validate([
        //     'order_id' => 'required|exists:orders,id',
        //     'pickup_date' => 'required|date',
        //     'selectedRows' => 'required|array|min:1',
        //     'selectedRows.*.order_detail_id' => 'required|exists:order_details,id',
        //     'selectedRows.*.works' => 'array',
        //     'selectedRows.*.works.*.work_id' => 'required|exists:works,id',
        //     'selectedRows.*.works.*.employee_id' => 'nullable|exists:employees,id',
        //     'selectedRows.*.works.*.fee' => 'nullable|numeric|min:0',
        //     'pay_now' => 'nullable|numeric|min:0',
        // ]);

        DB::beginTransaction();

        try {
            $pickup = Pickup::create([
                'customer_id' => $this->customer_id,
                'user_id' => Auth::user()->id,
                'pickup_date' => Carbon::parse($this->pickup_date)->format('Y-m-d H:i:s'),
                'note' => $this->note,
            ]);

            // dd($this->selectedRows);
            foreach ($this->selectedRows as $row) {
                // $od = OrderDetail::find($row['order_detail']['id']);
                // $qtyPicked = (float) ($row['order_detail']['qty']);
                $od = OrderDetail::find($row['order_detail']['id']);
                if (!$od) {
                    throw new \RuntimeException("OrderDetail id {$row['order_detail']['id']} tidak ditemukan.");
                }

                // Ambil qty yang dipilih user — PRIORITAS:
                // 1) nilai yang ada di selectedRows (hasil nextFromStep1) — bisa berupa model atau array
                // 2) nilai yang ada di pickupQty (hasil Step 1 array)
                // Jika tidak ditemukan, jangan fallback diam-diam: lempar exception supaya mudah debug.
                $selectedQty = null;

                $odData = $row['order_detail'];
                if (is_array($odData) && array_key_exists('qty', $odData)) {
                    $selectedQty = $odData['qty'];
                } elseif (is_object($odData) && property_exists($odData, 'qty')) {
                    $selectedQty = $odData->qty;
                }

                if ($selectedQty === null) {
                    // coba dari pickupQty (nilai yang di-bind di Step 1)
                    if (isset($this->pickupQty[$od->id])) {
                        $selectedQty = $this->pickupQty[$od->id];
                    }
                }

                // kalau masih null, stop dan beri pesan jelas (biar nggak silent-fail)
                if ($selectedQty === null) {
                    throw new \RuntimeException("Qty terpilih untuk order_detail id {$od->id} tidak ditemukan. Periksa selectedRows/pickupQty.");
                }

                $qtyPicked = (float) $selectedQty;
                $pd = PickupDetail::create([
                    'pickup_id' => $pickup->id,
                    'order_detail_id' => $od->id,
                    'qty' => $qtyPicked, // jika nanti mau partial, ganti sesuai input
                ]);
                // dd($qtyPicked, $pd->qty);


                // Simpan pivot pekerjaan per baris
                if (!empty($row['works'])) {
                    foreach ($row['works'] as $w) {
                        // $work = Work::findOrFail($w['work']['id']);
                        $work = Work::find($w['work']['id']);
                        // $employeeId = $w['employee_id'] ?? null;
                        $employeeId = $w['employee_id'];

                        // ambil service utk tahu dimensi/paket
                        $service = Service::find($od->service_id);
                        $isDimensional = $service ? !$service->is_package : true;

                        // basis area: kalau dimensional pakai length*width, kalau paket = 1
                        $length = (float)($od->length ?? 0);
                        $width  = (float)($od->width ?? 0);
                        $area   = $isDimensional ? max(0, $length) * max(0, $width) : 1;

                        // qty pickup (bukan total order), aman untuk partial di masa depan
                        $qtyPickup = (float)($pd->qty ?? 1);
                        $defaultPay = (float)($work->default_pay ?? 0);

                        if ($work->one_time) {
                            // Cek: sudah pernah dicatat untuk order_detail + work ini?
                            $alreadyCreated = DB::table('pickup_detail_employee_works as pdew')
                                ->join('pickup_details as pd2', 'pd2.id', '=', 'pdew.pickup_detail_id')
                                ->where('pd2.order_detail_id', $od->id)
                                ->where('pdew.work_id', $work->id)
                                ->exists();

                            if ($alreadyCreated) {
                                continue; // sudah pernah, jangan buat lagi
                            }

                            // Dibayar sekali berdasarkan area × 1 (bukan dikali qty lembar)
                            $pay = $defaultPay * $area * 1;
                        } else {
                            // Dibayar per qty pickup (× area)
                            $pay = $defaultPay * $qtyPickup * $length * $width;
                        }

                        DB::table('pickup_detail_employee_works')->insert([
                            'pickup_detail_id' => $pd->id,
                            'work_id'          => $work->id,
                            'employee_id'      => $employeeId,
                            'pay_default'      => $pay,
                            'is_paid'          => false, // akan di-set true saat proses payroll
                            'created_at'       => now(),
                            'updated_at'       => now(),
                        ]);
                    }
                }

                // 3) Update status order_detail → completed
                $totalPicked = PickupDetail::where('order_detail_id', $od->id)->sum('qty');
                $totalOrder  = (float) $od->qty;

                if ($totalPicked <= 0) {
                    $status = 'pending';
                } elseif ($totalPicked < $totalOrder) {
                    $status = 'partially';
                } else {
                    $status = 'completed';
                }

                $od->update(['pickup_status' => $status]);

                // 4) Pembayaran (kalau ada)
                $payAmount = (float)($this->pay_now ?? 0);
                // 5) Cek jumlah pembayaran dulu, untuk melihat lebih apa tidak
                $order   = Order::withSum('payment as paid_sum', 'amount')->find($this->order_id);
                $pickups = Pickup::withSum('payment as paid_sum', 'amount')->find($this->pickup_id);
                $paid    = (float)($order->paid_sum ?? 0) + (float)($pickups->paid_sum ?? 0 + $payAmount);
                // dd($pickups->paid_sum);
                // dd($paid);
                $total   = (float)($order->total_amount ?? 0);

                if ($payAmount > 0) {
                    $pickup->payment()->create([
                        // 'order_id'       => $this->order_id, // tetap kaitkan ke order
                        'pickup_id'      => $pickup->id, // tetap kaitkan ke pickup
                        'amount'         => $payAmount > $total ? $this->outstanding : $payAmount,
                        'paid_amount' => $payAmount,
                        'payment_method' => $this->payment_method,
                    ]);
                }

                // 6) Update status order (unpaid/partially_paid/paid) setelah pembayaran
                $order   = Order::withSum('payment as paid_sum', 'amount')->find($this->order_id);
                $pickups = Pickup::withSum('payment as paid_sum', 'amount')->find($this->pickup_id);
                $paid    = (float)($order->paid_sum ?? 0) + (float)($pickups->paid_sum ?? 0 + $payAmount);
                // dd($pickups->paid_sum);
                // dd($paid);
                $total   = (float)($order->total_amount ?? 0);
                $status  = match (true) {
                    $paid <= 0        => 'unpaid',
                    $paid < $total    => 'partially',
                    default           => 'paid',
                };

                $order->update(['payment_status' => $status]);
            }
            DB::commit();
            $this->dispatch('success', message: 'Pickup added succesfully');
            $this->redirectRoute('pickup.print', $pickup->id);
            $this->closeWizard();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.components.pickup.pickup-wizard-modal');
    }
}
