<div>
    <div wire:show="modalFormBayarDepe" x-cloak>
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-100">
            <div class="bg-gray-100 rounded shadow-lg  md:w-3/4 lg:w-2/3 p-4 w-full">

                {{-- HEADER --}}
                <div class="flex items-center justify-between px-6 pb-2 border-b border-gray-400">
                    {{-- <h3 class="text-lg font-semibold">{{ $update_data ? 'Edit' : 'Tambah' }} Service
                            {{ $update_data ? $name : 'Baru' }}</h3> --}}
                    <h3 class="text-lg font-semibold">
                        Tambah Pembayaran Depe
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        wire:click="closeModal">
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
                    <div class="bg-red-50 border-s-4 border-red-500 p-4 dark:bg-red-800/30" role="alert"
                        tabindex="-1" aria-labelledby="hs-bordered-red-style-label">
                        <div class="flex">
                            <div class="shrink-0">
                                <!-- Icon -->
                                <span
                                    class="inline-flex justify-center items-center size-8 rounded-full border-4 border-red-100 bg-red-200 text-red-800 dark:border-red-900 dark:bg-red-800 dark:text-red-400">
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
                                    class="text-gray-800 font-semibold dark:text-white">
                                    Error!
                                </h3>
                                <p class="text-sm text-gray-700 dark:text-neutral-400">
                                    {{ session('error') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif



                {{-- END : TABEL ORDER --}}

                <div class="px-6 py-4 text-sm text-gray-700 border-gray-400">



                    {{-- Pembayaran --}}
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-3">
                        {{-- Ringkasan Order --}}
                        <div class="rounded-xl border p-3 bg-gray-50">
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
                            <div class="md:col-span-2 space-y-4">

                                {{-- Total Rp --}}
                                <div class="grid grid-cols-3 gap-2 items-center">

                                    <label class="col-span-1 font-bold uppercase text-gray-600">TOTAL RP.</label>
                                    <div class="col-span-2">

                                        <input type="text" wire:model.live.debounce.300ms="outstanding"
                                            class="text-end py-2.5 px-4 block w-full border-gray-200 rounded-lg text-2xl focus:border-blue-500 focus:ring-blue-500"
                                            readonly>
                                    </div>
                                </div>

                                {{-- Bayar Rp --}}
                                <div class="grid grid-cols-3 gap-2 items-center">
                                    <label class="font-bold uppercase text-gray-600">BAYAR RP.</label>
                                    <div class="col-span-2 flex items-center gap-2 w-full">
                                        <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer">
                                            <input type="radio" wire:model.live.debounce.50ms="payment_method"
                                                value="cash">
                                            <span class="uppercase text-sm">Cash</span>
                                        </label>

                                        <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer">
                                            <input type="radio" wire:model.live.debounce.50ms="payment_method"
                                                value="transfer">
                                            <span class="uppercase text-sm">Transfer</span>
                                        </label>

                                        <input type="number" wire:model.live.debounce.300ms="pay_now"
                                            class="text-end py-2.5 px-4 block w-full border-gray-200 rounded-lg text-2xl focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="0">
                                        </div>
                                        @error('pay_now')
                                            <span class="text-red-600 text-xs">{{ $message }} (Tidak boleh bayar nol)</span>
                                        @enderror
                                </div>

                                {{-- Kembalian Rp --}}
                                <div class="grid grid-cols-3 gap-2 items-center">
                                    <label class="col-span-1 font-bold uppercase text-gray-600">KEMBALIAN
                                        RP.</label>
                                    <div class="col-span-2">

                                        <input type="number" wire:model.live.debounce.300ms="change"
                                            class="text-end py-2.5 px-4 block w-full border-gray-200 rounded-lg text-2xl focus:border-blue-500 focus:ring-blue-500"
                                            readonly>
                                    </div>
                                </div>


                            </div>
                        @else
                            <div class="md:col-span-2 flex items-center">
                                <span
                                    class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-green-100 text-green-800">
                                    ✅ Order sudah LUNAS — tidak perlu pembayaran lagi
                                </span>
                            </div>
                        @endif
                    </div>


                    <div class="mt-4 flex justify-between">
                        <div></div>

                        {{-- Tombol --}}
                        <div class="flex justify-end gap-2">
                            <button type="button" wire:click="closeModal"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-orange-600 text-white hover:bg-orange-700 focus:outline-hidden focus:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none">
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
                            <button type="button" wire:click="save" {{-- {{ !empty($selectedDetailIds) && count($selectedDetailIds) > 0 ? '' : 'disabled' }} --}}
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
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

            </div>
        </div>
    </div>
</div>
</div>
