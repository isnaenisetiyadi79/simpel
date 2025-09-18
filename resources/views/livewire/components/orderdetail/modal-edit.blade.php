<div>
    <div wire:show="modalFormData" x-cloak>
        <!-- Modal background -->
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-[80]">
            <!-- Modal container -->
            <div class="bg-white rounded-lg shadow-lg max-w-xl w-full">
                <form wire:submit="save">
                    <!-- Header -->
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                        {{-- <h3 class="text-lg font-semibold">{{ $update_data ? 'Edit' : 'Tambah' }} Service
                            {{ $update_data ? $name : 'Baru' }}</h3> --}}
                        <h3 class="text-lg font-semibold">Edit Pesanan
                        </h3>
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

                        {{-- Komponen Service --}}
                        <div class="w-full mt-4">
                            <label for="input-label-with-helper-text"
                                class="block text-sm font-medium mb-2 dark:text-white">Layanan</label>
                            <select wire:model.live.debounce.50ms="service_id"
                                class="py-3 mb-2 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                <option selected="">Pilih Layanan</option>
                                @foreach ($services as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        {{-- END: Komponen Service --}}

                        {{-- Komponen Input Name --}}
                        <div class="w-full mt-4">
                            <label for="input-label-with-helper-phone"
                                class="block text-sm font-medium mb-2 dark:text-white">Deskripsi</label>
                            <input type="text" wire:model="description" name="description"
                                id="input-label-with-helper-phone"
                                class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="John Doe" aria-describedby="hs-input-helper-text" required>
                            @error('name')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- END: Komponen Input Name --}}


                        <div class="mt-4 {{ $this->service->is_package ?? false ? 'columns-2' : 'columns-4' }}">
                            <div class="{{ $this->service->is_package ?? false ? 'hidden' : '' }}">
                                <label for="input-length"
                                    class="block text-sm font-medium mb-2 dark:text-white">Panjang</label>
                                <input type="number" step="0.01" name="input-length"
                                    wire:model.live.debounce.300ms="length"
                                    class="text-end block w-full rounded-md border-gray-300 shadow-sm
                                focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>
                            <div class="{{ $this->service->is_package ?? false ? 'hidden' : '' }}">
                                <label for="input-width"
                                    class="block text-sm font-medium mb-2 dark:text-white">Lebar</label>
                                <input type="number" step="0.01" name="input-width"
                                    wire:model.live.debounce.300ms="width"
                                    class="text-end block w-full rounded-md border-gray-300 shadow-sm
                        focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />

                            </div>
                            <div>
                                <label for="input-qty"
                                    class="block text-sm font-medium mb-2 dark:text-white">Qty</label>
                                <input type="number" step="1.00" name="input-qty"
                                    wire:model.live.debounce.300ms="qty"
                                    class="text-end block w-full rounded-md border-gray-300 shadow-sm
                                focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>
                            <div>
                                <label for="input-qty_final"
                                    class="block text-sm font-medium mb-2 dark:text-white">Jumlah Total</label>
                                <input type="text" name="input-qty_final" readonly
                                    value="{{ number_format($qty_final, 2, ',', '.') }}"
                                    class="pointer-events-none text-end block w-full rounded-md border-gray-300 shadow-sm
                        focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>
                        </div>
                        <div class="mt-4 columns-2">

                            <div>
                                <label for="input-price"
                                    class="block text-sm font-medium mb-2 dark:text-white">Harga</label>
                                <input type="number" step="0.01" name="input-price"
                                    wire:model.live.debounce.30ms="price"
                                    class="text-end block w-full rounded-md border-gray-300 shadow-sm
                                focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>
                            <div>
                                <label for="input-subtotal"
                                    class="block text-sm font-medium mb-2 dark:text-white">Subtotal</label>
                                <input type="text" step="0.01" name="input-subtotal"
                                    value="{{ number_format($subtotal, 2, ',', '.') }}" readonly
                                    class="read-only:pointer-events-none text-end block w-full rounded-md border-gray-300 shadow-sm
                        focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />

                            </div>
                        </div>



                    </div>

                    <!-- Footer -->
                    <div class="flex justify-end gap-2 px-6 py-4 border-t border-gray-200">
                        <button type="button" wire:click="closeModal"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                            Keluar
                        </button>
                        <button type="submit" wire:loading.attr="disabled"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Update
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
