<div>
    {{-- <div wire:show="modalFormData" x-cloak> --}}
    <!-- Modal background -->
    {{-- <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-[80]"> --}}
    <!-- Modal container -->
    <div class="bg-white rounded-lg shadow-lg w-full">
        <form wire:submit="save">
            <!-- Header -->


            <!-- Body -->
            <div class="px-6 py-4 text-sm text-gray-700">
                <!-- Section -->
                @if (session()->has('error'))
                    <div class="bg-red-50 border-s-4 border-red-500 p-4 dark:bg-red-800/30" role="alert" tabindex="-1"
                        aria-labelledby="hs-bordered-red-style-label">
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
                @if (session()->has('success'))
                    <div class=" bg-teal-100 border border-teal-200 text-sm text-teal-800 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500 rounded-lg"
                        role="alert" id="flash-message" tabindex="-1"
                        aria-labelledby="hs-toast-solid-color-teal-label">
                        <div id="hs-toast-solid-color-teal-label" class="flex p-4">
                            <span id="hs-soft-color-success-label" class="font-bold">Success </span>
                                {{ session('success') }}


                            <div class="ms-auto">
                                <button type="button" onclick="document.getElementById('flash-message').remove()"
                                    class="inline-flex shrink-0 justify-center items-center size-5 rounded-lg text-teal-950 hover:text-teal-400  hover:opacity-100 focus:outline-hidden focus:opacity-100"
                                    aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-5">
                <div class="space-y-4">
                    <div class="w-full">
                        <label for="input-label-with-helper-text"
                            class="block text-sm font-medium mb-2 dark:text-white">Nama</label>
                        <input type="name" wire:model="name" name="name" id="input-label-with-helper-name"
                            class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Express" aria-describedby="hs-input-helper-text" required>
                        @error('name')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="w-full">
                        <label for="input-label-with-helper-text"
                            class="block text-sm font-medium mb-2 dark:text-white">Slogan</label>
                        <input type="name" wire:model="slogan" name="slogan" id="input-label-with-helper-name"
                            class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Express" aria-describedby="hs-input-helper-text" required>
                        @error('slogan')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="w-full mt-4">
                        <label for="input-label-with-helper-phone"
                            class="block text-sm font-medium mb-2 dark:text-white">No.
                            Telp</label>
                        <input type="number" wire:model="phone_number" name="phone_number"
                            id="input-label-with-helper-phone"
                            class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="08122222222" aria-describedby="hs-input-helper-text" required>
                        @error('phone_number')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="w-full">
                        <label for="textarea-label"
                            class="block text-sm font-medium mb-2 dark:text-white">Alamat</label>
                        <textarea id="textarea-label" wire:model="address" name="address"
                            class="py-2 px-3 sm:py-3 sm:px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            rows="3" placeholder="Layanan full lembur"></textarea>
                        @error('address')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mt-4">
                        <label for="textarea-label" class="block text-sm font-medium mb-2 dark:text-white">Catatan
                            Nota</label>
                        <textarea id="textarea-label" wire:model="note" name="note"
                            class="py-2 px-3 sm:py-3 sm:px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            rows="3" placeholder="Layanan full lembur"></textarea>
                        @error('note')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mt-4">
                        <label for="input-label-with-helper-text"
                            class="block text-sm font-medium mb-2 dark:text-white">Ukuran Printer</label>
                        <select wire:model="printer_width"
                            class="py-3 mb-2 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option selected="">Lebar Printer</option>
                            <option value="80">80mm</option>
                            <option value="58">58mm</option>

                        </select>
                    </div>
                </div>
            </div>


            <!-- Footer -->
            <div class="flex justify-end gap-2 px-6 py-4 border-t border-gray-200">

                <button type="submit" wire:loading.attr="disabled"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    Simpan
                    <div wire:loading
                        class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full dark:text-white"
                        role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </form>
    </div>
    {{-- </div> --}}
    {{-- </div>  --}}
</div>
