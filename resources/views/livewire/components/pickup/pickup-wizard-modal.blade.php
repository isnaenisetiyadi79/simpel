<div>
    <div wire:show="showWizard" x-cloak>
        <div class="fixed inset-0 flex items-center justify-center bg-black/50 z-100">
            <div class="w-full p-4 bg-gray-100 rounded shadow-lg md:w-3/4 lg:w-2/3">

                {{-- HEADER --}}
                <div class="flex items-center justify-between px-6 pb-2 border-b border-gray-400">
                    {{-- <h3 class="text-lg font-semibold">{{ $update_data ? 'Edit' : 'Tambah' }} Service
                            {{ $update_data ? $name : 'Baru' }}</h3> --}}
                    <h3 class="text-lg font-semibold">
                        {{ $step === 1 ? 'Pilih order dan pesanan (Step 1/2)' : 'Finalisasi Penyerahan & Pembayaran (Step 2/2)' }}
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        wire:click="closeWizard">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                {{--  END OF: HEADER --}}

                {{-- BODY --}}
                @if (session()->has('error'))
                    <div class="p-4 border-red-500 bg-red-50 border-s-4 dark:bg-red-800/30" role="alert"
                        tabindex="-1" aria-labelledby="hs-bordered-red-style-label">
                        <div class="flex">
                            <div class="shrink-0">
                                <!-- Icon -->
                                <span
                                    class="inline-flex items-center justify-center text-red-800 bg-red-200 border-4 border-red-100 rounded-full size-8 dark:border-red-900 dark:bg-red-800 dark:text-red-400">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                </span>
                                <!-- End Icon -->
                            </div>
                            <div class="ms-3">
                                <h3 id="hs-bordered-red-style-label"
                                    class="font-semibold text-gray-800 dark:text-white">
                                    Error!
                                </h3>
                                <p class="text-sm text-gray-700 dark:text-neutral-400">
                                    {{ session('error') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- STEP 1 -->
                @if ($step === 1)
                    <div class="px-6 py-4 text-sm text-gray-700 border-gray-400">
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div>
                                <label
                                    class="text-xs font-bold text-gray-600 uppercase dark:text-neutral-100">Customer</label>
                                <select wire:model.live.debounce.50ms="customer_id"
                                    class="block w-full border-gray-300 shadow-sm rounded-xl focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">Pilih ...</option>
                                    @foreach ($customers as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="text-sm font-medium">Order</label>
                                <select wire:model.live.debounce.50ms="order_id"
                                    class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="">Pilih Order --</option>
                                    @foreach ($availableOrders as $o)
                                        <option value="{{ $o['id'] }}">#{{ $o['id'] }} — Total:
                                            {{ number_format($o['total_amount'] ?? 0, 0, ',', '.') }} —
                                            {{-- {{ strtoupper($o['payment_status']) }} --}}
                                            <ul class="ml-4 list-disc">
                                                @forelse ($o['orderdetail'] as $od)
                                                    <li>{{ $od['description'] }}</li>
                                                @empty
                                                    <li>---</li>
                                                @endforelse
                                            </ul>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($order_id)
                                <div class="p-3 mb-3 border rounded-xl bg-gray-50">
                                    <div class="text-sm text-end">
                                        <div>Total Order: <strong>Rp
                                                {{ number_format($order_total, 2, ',', '.') }}</strong>
                                        </div>
                                        <div>Sudah Dibayar (sebelumnya): <strong>Rp
                                                {{ number_format($paid_total, 2, ',', '.') }}</strong></div>
                                        <div>Sisa: <strong
                                                class="{{ $outstanding > 0 ? 'text-red-600' : 'text-green-600' }}">Rp
                                                {{ number_format($outstanding, 2, ',', '.') }}</strong></div>
                                    </div>
                                </div>
                            @endif
                        </div>



                    </div>
                    {{-- TABEL ORDER --}}

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100 border border-t-gray-500 border-b-gray-500">
                                <tr>
                                    <th class="px-6 py-3">
                                        <input type="checkbox" wire:model.lazy="selectAll"
                                            class="shrink-0 mt-0.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                    </th>
                                    <th scope="col" class="px-6 py-3 truncate text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold text-gray-800 uppercase dark:text-neutral-200">
                                                Service
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 truncate text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold text-gray-800 uppercase dark:text-neutral-200">
                                                qty
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 truncate text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold text-gray-800 uppercase dark:text-neutral-200">
                                                Harga
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 truncate text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold text-gray-800 uppercase dark:text-neutral-200">
                                                Subtotal
                                            </span>
                                        </div>
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-3 truncate text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold text-gray-800 uppercase dark:text-neutral-200">
                                                Keterangan
                                            </span>
                                        </div>
                                    </th> --}}



                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($availableOrderDetails as $row)
                                    <tr class="mb-2 ">
                                        <td class="p-1 text-center">
                                            {{-- <input type="checkbox" wire:model.live.debounce="selectedDetailIds" --}}
                                            <input type="checkbox" wire:model.lazy="selectedDetailIds"
                                                value="{{ $row['id'] }}"
                                                class="shrink-0 mt-0.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                        </td>
                                        <td class="p-1 border border-t-gray-400">
                                            <span class="text-sm text-gray-800 dark:text-neutral-200">

                                                {{ $row['service_name'] }} <br>
                                                {{ $row['description'] }}
                                            </span>

                                        </td>
                                        <td class="p-1 border border-t-gray-400 text-end">
                                            <span class="text-sm text-gray-800 dark:text-neutral-200 text-end">
                                                @if (!$row['is_package'])
                                                    ({{ number_format($row['length'], 2, ',', '.') }} x
                                                    {{ number_format($row['width'], 2, ',', '.') }})
                                                @endif
                                                {{-- {{ $row['qty'] }} --}}
                                                <input type="number"
                                                    wire:model.live.debounce.30="pickupQty.{{ $row['id'] }}"
                                                    min="1" max="{{ $row['qty_remaining'] }}"
                                                    class="w-16 px-1 text-center border rounded">
                                            </span>
                                        </td>
                                        <td class="p-1 border border-t-gray-400 text-end">
                                            <span class="text-sm text-gray-800 dark:text-neutral-200 ">
                                                {{ number_format($row['price'], 0, ',', '.') }}
                                            </span>
                                        </td>

                                        <td class="p-1 border border-t-gray-400 text-end">
                                            <span class="text-sm text-gray-800 dark:text-neutral-200 ">
                                                @php
                                                    $qtyUsed = $pickupQty[$row['id']] ?? $row['qty_remaining'];
                                                    if ($qtyUsed < 0) {
                                                        $qtyUsed = 0;
                                                    }

                                                    if ($row['is_package']) {
                                                        $lineSubtotal = $qtyUsed * $row['price'];
                                                    } else {
                                                        $lineSubtotal =
                                                            $row['length'] * $row['width'] * $qtyUsed * $row['price'];
                                                    }
                                                @endphp
                                                {{ number_format($lineSubtotal, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        {{-- <td class="p-1 border border-t-gray-400">
                                            <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                {{ $row['description'] }}
                                            </span>
                                        </td> --}}
                                        {{-- <td class="p-1 border border-t-gray-400 text-end">
                                            <span class="text-sm text-gray-800 dark:text-neutral-200 ">
                                                {{ number_format($row['price'], 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="p-1 border border-t-gray-400 text-end">
                                            <span class="text-sm text-gray-800 dark:text-neutral-200 ">
                                                {{ number_format($row['subtotal'], 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="p-1 border border-t-gray-400">
                                            <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                {{ $row['description'] }}
                                            </span>
                                        </td> --}}

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-3 py-6 text-sm text-center text-gray-500">Tidak
                                            ada
                                            item yang siap
                                            diambil</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @error('selectedDetailIds')
                            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    @if ($availableOrderDetails)
                        <div class="flex justify-end gap-2 mt-4">
                            <button type="button" wire:click="closeWizard"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-lg gap-x-2 hover:bg-orange-700 focus:outline-hidden focus:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 48 48">
                                    <g fill="none" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="4">
                                        <path d="M12.9998 8L6 14L12.9998 21" />
                                        <path
                                            d="M6 14H28.9938C35.8768 14 41.7221 19.6204 41.9904 26.5C42.2739 33.7696 36.2671 40 28.9938 40H11.9984" />
                                    </g>
                                </svg>
                                Batal
                            </button>
                            <button type="button" wire:click="nextFromStep1"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                Next Pickup
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-width="2"
                                        d="m7 2l10 10L7 22" />
                                </svg>
                            </button>
                        </div>
                    @endif
                @endif

                @if ($step === 2)
                    {{-- END : TABEL ORDER --}}

                    <div class="px-6 py-4 text-sm text-gray-700 border-gray-400">
                        <div class="grid grid-cols-1 gap-3 mb-4 md:grid-cols-3">
                            <div>
                                <label class="text-sm font-medium">Tanggal Pickup</label>
                                <input type="datetime-local" wire:model="pickup_date"
                                    class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div class="md:col-span-2">
                                <label class="text-sm font-medium">Catatan</label>
                                <input type="text" wire:model="note"
                                    class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="overflow-x-auto border rounded-xl">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 truncate text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-bold text-gray-800 uppercase dark:text-neutral-200">
                                                    Service
                                                </span>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 truncate text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-bold text-gray-800 uppercase dark:text-neutral-200">
                                                    Qty
                                                </span>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 truncate text-start">
                                            <div class="flex items-center gap-x-2 text-end">
                                                <span
                                                    class="text-xs font-bold text-gray-800 uppercase dark:text-neutral-200">
                                                    Harga @
                                                </span>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 truncate text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-bold text-gray-800 uppercase dark:text-neutral-200">
                                                    Subtotal
                                                </span>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 truncate text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-bold text-gray-800 uppercase dark:text-neutral-200">
                                                    Work & Karyawan
                                                </span>
                                            </div>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($selectedRows as $i => $row)
                                        <tr>
                                            <td class="px-3 py-2">
                                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $row['service']->name }}
                                                    {{-- {{ $row->service->name }} --}}
                                                </span>
                                            </td>
                                            <td class="px-3 py-2">
                                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                    @if (!$row['order_detail']->service->is_package)
                                                        ({{ number_format($row['order_detail']['length'], 2, ',', '.') }}
                                                        x
                                                        {{ number_format($row['order_detail']['width'], 2, ',', '.') }})
                                                    @endif
                                                    {{ $row['order_detail']->qty }}
                                                </span>

                                            </td>
                                            <td class="px-3 py-2">
                                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                    Rp {{ number_format($row['order_detail']->price, 0, ',', '.') }}
                                                </span>
                                            </td>
                                            <td class="px-3 py-2">
                                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                    Rp {{ number_format($row['order_detail']->subtotal, 0, ',', '.') }}
                                                </span>
                                            </td>
                                            <td class="px-3 py-2">
                                                @if (!empty($row['works']))
                                                    <div class="space-y-2">
                                                        @foreach ($row['works'] as $j => $w)
                                                            <div class="grid items-center grid-cols-5 gap-2">
                                                                <div class="col-span-2 text-sm">{{ $w['work']->name }}
                                                                </div>
                                                                <div class="col-span-2">
                                                                    <select
                                                                        wire:model="selectedRows.{{ $i }}.works.{{ $j }}.employee_id"
                                                                        class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">
                                                                        {{-- <option value="">Pilih Karyawan — --}}
                                                                        </option>
                                                                        @foreach ($row['employees'] as $emp)
                                                                            <option value="{{ $emp['id'] }}">
                                                                                <span class="text-sm">
                                                                                    {{ $emp['name'] }}
                                                                            </option>
                                                                            </span>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                {{-- <div>
                                                                <input type="number" step="0.01"
                                                                    wire:model.lazy="selectedRows.{{ $i }}.works.{{ $j }}.fee"
                                                                    class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                                                                    placeholder="Fee">
                                                            </div> --}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-gray-400">—</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- Pembayaran --}}
                        <div class="grid grid-cols-1 gap-3 mt-4 md:grid-cols-3">
                            {{-- Ringkasan Order --}}
                            <div class="p-3 border rounded-xl bg-gray-50">
                                <div class="text-sm">Total Order:
                                    <strong>Rp {{ number_format($order_total, 0, ',', '.') }}</strong>
                                </div>
                                <div class="text-sm">Sudah Dibayar:
                                    <strong>Rp {{ number_format($paid_total, 0, ',', '.') }}</strong>
                                </div>
                                <div class="text-sm">Sisa:
                                    <strong class="{{ $outstanding > 0 ? 'text-red-600' : 'text-green-600' }}">
                                        Rp {{ number_format($outstanding, 0, ',', '.') }}
                                    </strong>
                                </div>
                            </div>

                            {{-- Form Pembayaran --}}
                            @if ($outstanding > 0)
                                <div class="space-y-4 md:col-span-2">

                                    {{-- Total Rp --}}
                                    <div class="grid items-center grid-cols-3 gap-2">

                                        <label class="col-span-1 font-bold text-gray-600 uppercase">TOTAL RP.</label>
                                        <div class="col-span-2">

                                            <input type="text" wire:model.live.debounce.300ms="outstanding"
                                                class="text-end py-2.5 px-4 block w-full border-gray-200 rounded-lg text-2xl focus:border-blue-500 focus:ring-blue-500"
                                                readonly>
                                        </div>
                                    </div>

                                    {{-- Bayar Rp --}}
                                    <div class="grid items-center grid-cols-3 gap-2">
                                        <label class="font-bold text-gray-600 uppercase">BAYAR RP.</label>
                                        <div class="flex items-center w-full col-span-2 gap-2">
                                            <label
                                                class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer">
                                                <input type="radio" wire:model.live.debounce.50ms="payment_method"
                                                    value="cash">
                                                <span class="text-sm uppercase">Cash</span>
                                            </label>

                                            <label
                                                class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer">
                                                <input type="radio" wire:model.live.debounce.50ms="payment_method"
                                                    value="transfer">
                                                <span class="text-sm uppercase">Transfer</span>
                                            </label>

                                            <input type="number" wire:model.live.debounce.300ms="pay_now"
                                                class="text-end py-2.5 px-4 block w-full border-gray-200 rounded-lg text-2xl focus:border-blue-500 focus:ring-blue-500"
                                                placeholder="0">
                                        </div>
                                    </div>

                                    {{-- Kembalian Rp --}}
                                    <div class="grid items-center grid-cols-3 gap-2">
                                        <label class="col-span-1 font-bold text-gray-600 uppercase">KEMBALIAN
                                            RP.</label>
                                        <div class="col-span-2">

                                            <input type="number" wire:model.live.debounce.300ms="change"
                                                class="text-end py-2.5 px-4 block w-full border-gray-200 rounded-lg text-2xl focus:border-blue-500 focus:ring-blue-500"
                                                readonly>
                                        </div>
                                    </div>


                                </div>
                            @else
                                <div class="flex items-center md:col-span-2">
                                    <span
                                        class="inline-flex items-center gap-2 px-3 py-2 text-green-800 bg-green-100 rounded-xl">
                                        ✅ Order sudah LUNAS — tidak perlu pembayaran lagi
                                    </span>
                                </div>
                            @endif
                        </div>


                        <div class="flex justify-between mt-4">
                            <button type="button"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                wire:click="backToStep1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="24"
                                    viewBox="0 0 12 24">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M10 19.438L8.955 20.5l-7.666-7.79a1.02 1.02 0 0 1 0-1.42L8.955 3.5L10 4.563L2.682 12z" />
                                </svg>
                                Kembali</button>

                            {{-- Tombol --}}
                            <div class="flex justify-end gap-2">
                                <button type="button" wire:click="closeWizard"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-lg gap-x-2 hover:bg-orange-700 focus:outline-hidden focus:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 48 48">
                                        <g fill="none" stroke="#FFF" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="4">
                                            <path d="M12.9998 8L6 14L12.9998 21" />
                                            <path
                                                d="M6 14H28.9938C35.8768 14 41.7221 19.6204 41.9904 26.5C42.2739 33.7696 36.2671 40 28.9938 40H11.9984" />
                                        </g>
                                    </svg>
                                    Batal
                                </button>
                                <button type="button" wire:click="save"
                                    {{ !empty($selectedDetailIds) && count($selectedDetailIds) > 0 ? '' : 'disabled' }}
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-width="1">
                                            <path
                                                d="M16 21v-2c0-1.886 0-2.828-.586-3.414S13.886 15 12 15h-1c-1.886 0-2.828 0-3.414.586S7 17.114 7 19v2" />
                                            <path stroke-linecap="round" d="M7 8h5" />
                                            <path
                                                d="M3 9c0-2.828 0-4.243.879-5.121C4.757 3 6.172 3 9 3h7.172c.408 0 .613 0 .796.076s.329.22.618.51l2.828 2.828c.29.29.434.434.51.618c.076.183.076.388.076.796V15c0 2.828 0 4.243-.879 5.121C19.243 21 17.828 21 15 21H9c-2.828 0-4.243 0-5.121-.879C3 19.243 3 17.828 3 15z" />
                                        </g>
                                    </svg>
                                    Simpan
                                </button>
                            </div>
                        </div>


                        {{-- INI ITEM YANG LAMA --}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
