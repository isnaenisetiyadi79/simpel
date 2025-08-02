<div>
    <div wire:show="modalFormChange" x-cloak>
        <!-- Modal background -->
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-[80]">
            <!-- Modal container -->
            <div class="bg-white rounded-lg shadow-lg max-w-xl w-full">
                <form wire:submit="save">
                    <!-- Header -->
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                        {{-- <h3 class="text-lg font-semibold">{{ $update_data ? 'Edit' : 'Tambah' }} Service
                            {{ $update_data ? $name : 'Baru' }}</h3> --}}
                        <h3 class="text-lg font-semibold">Change Status Order</h3>
                        <button type="button"
                            class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                            wire:click="closeModal">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="px-6 py-4 text-sm text-gray-700">
                        <!-- Section -->
                        @if (session()->has('error'))
                            <div class="bg-red-50 border-s-4 border-red-500 p-4 dark:bg-red-800/30" role="alert"
                                tabindex="-1" aria-labelledby="hs-bordered-red-style-label">
                                <div class="flex">
                                    <div class="shrink-0">
                                        <!-- Icon -->
                                        <span
                                            class="inline-flex justify-center items-center size-8 rounded-full border-4 border-red-100 bg-red-200 text-red-800 dark:border-red-900 dark:bg-red-800 dark:text-red-400">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
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
                        {{-- Komponen Select Status --}}

                        <div class="w-full">
                            <label for="input-label-with-helper-text"
                                class="block text-sm font-medium mb-2 dark:text-white">Status</label>
                            <select wire:model.live.debounce.500ms="customer"
                                class="py-3 mb-2 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                wire:model.change="status">
                                <option selected="">Pilih Status...</option>
                                <option value="pending">Pending</option>
                                <option value="process">Proses</option>
                                <option value="done">Selesai</option>
                                <option value="completed">Completed</option>

                            </select>
                            @error('customer')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- END: Komponen Select Status --}}



                        @if ($status == 'completed')
                            {{-- Komponen Metode Pembayaran --}}
                            <div class="w-full mt-4">

                                <label for="input-label-with-helper-total"
                                    class="block text-sm font-medium mb-2 dark:text-white">Metode Pembayaran</label>
                                <div class="grid sm:grid-cols-2 gap-2">
                                    <label for="hs-radio-in-form"
                                        class="flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 cursor-pointer">
                                        <input type="radio" name="hs-radio-in-form"
                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                            id="hs-radio-in-form" wire:model.change="payment_method" value="cash">
                                        <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Cash</span>
                                    </label>

                                    <label for="hs-radio-checked-in-form"
                                        class="flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 cursor-pointer">
                                        <input type="radio" name="hs-radio-in-form"
                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                            id="hs-radio-checked-in-form" wire:model.change="payment_method" value="qris">
                                        <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">QRIS</span>
                                    </label>
                                </div>
                            </div>
                            {{-- END: Komponen Metode Pembayaran --}}

                            {{-- Komponen Total Pembayaran --}}
                            <div class="w-full mt-4">
                                <label for="input-label-with-helper-total"
                                    class="block text-sm font-medium mb-2 dark:text-white">Total Pembayaran</label>
                                <input type="text" wire:model="total_amount" name="amount"
                                    id="input-label-with-helper-total"
                                    class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 read-only:bg-gray-200 read-only:cursor-not-allowed"
                                    placeholder="0" aria-describedby="hs-input-helper-text" readonly>
                                @error('total_amount')
                                    <span class="text-red-600 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- END: Komponen Total Pembayaran --}}
                            {{-- Komponen Pembayaran --}}
                            <div class="w-full mt-4">
                                <label for="input-label-with-helper-phone"
                                    class="block text-sm font-medium mb-2 dark:text-white">Pembayaran</label>
                                <input type="number" wire:model.live.debounce.500ms="amount" name="amount"
                                    id="input-label-with-helper-phone"
                                    class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 {{ $payment_method == 'qris' ? 'read-only:bg-gray-200 read-only:cursor-not-allowed' : ''}}"
                                    placeholder="1" aria-describedby="hs-input-helper-text" required {{ $payment_method == 'qris' ? 'readonly' : '' }}>
                                @error('amount')
                                    <span class="text-red-600 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- END: Komponen Pembayaran --}}
                            {{-- Komponen Kembalian --}}
                            <div class="w-full mt-4">
                                <label for="input-label-with-helper-total"
                                    class="block text-sm font-medium mb-2 dark:text-white">Kembalian</label>
                                <input type="text" wire:model.live.debounce.500ms="spending" name="spending"
                                    id="input-label-with-helper-total"
                                    class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 read-only:bg-gray-200 read-only:cursor-not-allowed"
                                    placeholder="0" aria-describedby="hs-input-helper-text" readonly>
                                @error('spending')
                                    <span class="text-red-600 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- END: Komponen Input Berat --}}
                        @endif


                    </div>

                    <!-- Footer -->
                    <div class="flex justify-end gap-2 px-6 py-4 border-t border-gray-200">
                        <button type="button" wire:click="closeModal"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                            Keluar
                        </button>
                        <button type="submit" wire:loading.attr="disabled"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            {{ $change_status ? 'Update' : 'Simpan' }}
                            <div wire:loading
                                class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full dark:text-white"
                                role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> {{-- Do your work, then step back. --}}
</div>
