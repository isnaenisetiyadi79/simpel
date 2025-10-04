<div>
    <div wire:show="modalFormBayarHutang" x-cloak>
        <div class="fixed inset-0 flex items-center justify-center bg-black/50 z-100">
            <div class="w-full p-4 bg-gray-100 rounded shadow-lg md:w-3/4 lg:w-2/3">

                {{-- HEADER --}}
                <div class="flex items-center justify-between px-6 pb-2 border-b border-gray-400">
                    {{-- <h3 class="text-lg font-semibold">{{ $update_data ? 'Edit' : 'Tambah' }} Service
                            {{ $update_data ? $name : 'Baru' }}</h3> --}}
                    <h3 class="text-lg font-semibold">
                        Pembayaran Piutang
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
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



                {{-- END : TABEL ORDER --}}

                <div class="px-6 py-4 text-sm text-gray-700 border-gray-400">
                    {{-- Date Time Picker --}}
                    <div class="mt-2 flex flex-col">
                        <label class="text-xs font-bold uppercase text-gray-600 dark:text-neutral-100">Tanggal
                            Bayar</label> <span class="text-xs font-medium col-span-2">(Hanya bisa dirubah oleh
                            owner/admin)</span>
                        <div class="relative mt-1 max-w-sm">
                            <input type="datetime-local" wire:model="payment_date" @disabled(!Auth::user()->hasRole('owner') && !Auth::user()->hasRole('admin'))
                                class="py-3  px-3 ps-9 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M17 14a1 1 0 1 0 0-2a1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2a1 1 0 0 0 0 2m-4-5a1 1 0 1 1-2 0a1 1 0 0 1 2 0m0 4a1 1 0 1 1-2 0a1 1 0 0 1 2 0m-6-3a1 1 0 1 0 0-2a1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M7 1.75a.75.75 0 0 1 .75.75v.763c.662-.013 1.391-.013 2.193-.013h4.113c.803 0 1.532 0 2.194.013V2.5a.75.75 0 0 1 1.5 0v.827q.39.03.739.076c1.172.158 2.121.49 2.87 1.238c.748.749 1.08 1.698 1.238 2.87c.153 1.14.153 2.595.153 4.433v2.112c0 1.838 0 3.294-.153 4.433c-.158 1.172-.49 2.121-1.238 2.87c-.749.748-1.698 1.08-2.87 1.238c-1.14.153-2.595.153-4.433.153H9.945c-1.838 0-3.294 0-4.433-.153c-1.172-.158-2.121-.49-2.87-1.238c-.748-.749-1.08-1.698-1.238-2.87c-.153-1.14-.153-2.595-.153-4.433v-2.112c0-1.838 0-3.294.153-4.433c.158-1.172.49-2.121 1.238-2.87c.749-.748 1.698-1.08 2.87-1.238q.35-.046.739-.076V2.5A.75.75 0 0 1 7 1.75M5.71 4.89c-1.005.135-1.585.389-2.008.812S3.025 6.705 2.89 7.71q-.034.255-.058.539h18.336q-.024-.284-.058-.54c-.135-1.005-.389-1.585-.812-2.008s-1.003-.677-2.009-.812c-1.027-.138-2.382-.14-4.289-.14h-4c-1.907 0-3.261.002-4.29.14M2.75 12c0-.854 0-1.597.013-2.25h18.474c.013.653.013 1.396.013 2.25v2c0 1.907-.002 3.262-.14 4.29c-.135 1.005-.389 1.585-.812 2.008s-1.003.677-2.009.812c-1.027.138-2.382.14-4.289.14h-4c-1.907 0-3.261-.002-4.29-.14c-1.005-.135-1.585-.389-2.008-.812s-.677-1.003-.812-2.009c-.138-1.027-.14-2.382-.14-4.289z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
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
                                        <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer">
                                            <input type="radio" wire:model.live.debounce.50ms="payment_method"
                                                value="cash">
                                            <span class="text-sm uppercase">Cash</span>
                                        </label>

                                        <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer">
                                            <input type="radio" wire:model.live.debounce.50ms="payment_method"
                                                value="transfer">
                                            <span class="text-sm uppercase">Transfer</span>
                                        </label>

                                        <input type="number" wire:model.live.debounce.300ms="pay_now"
                                            class="text-end py-2.5 px-4 block w-full border-gray-200 rounded-lg text-2xl focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="0">
                                    </div>
                                    @error('pay_now')
                                        <span class="text-xs text-red-600">{{ $message }} (Tidak boleh bayar
                                            nol)</span>
                                    @enderror
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
                        <div></div>

                        {{-- Tombol --}}
                        <div class="flex justify-end gap-2">
                            <button type="button" wire:click="closeModal"
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
                            <button type="button" wire:click="save" {{-- {{ !empty($selectedDetailIds) && count($selectedDetailIds) > 0 ? '' : 'disabled' }} --}}
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

            </div>
        </div>
    </div>
</div>
</div>
