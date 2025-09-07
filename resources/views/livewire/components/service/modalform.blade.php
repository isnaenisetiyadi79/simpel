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
                        <h3 class="text-lg font-semibold">{{ $update_data ? 'Edit' : 'Tambah' }} Layanan
                            {{ $update_data ? $name : 'Baru' }}</h3>
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
                        <div class="w-full mt-4">
                            <label for="input-label-with-helper-email"
                                class="block text-sm font-medium mb-2 dark:text-white">Harga /kg</label>
                            <input type="number" wire:model="price" name="price" id="input-label-with-helper-email"
                                class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600
                                @error('price') border-red-500 @enderror"
                                placeholder="100000" aria-describedby="hs-input-helper-text">
                            @error('price')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="w-full mt-4">
                            <label for="input-label-with-helper-unit"
                                class="block text-sm font-medium mb-2 dark:text-white">Unit</label>
                            <input type="text" wire:model="unit" name="unit" id="input-label-with-helper-unit"
                                class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Meter, Kg, Box" aria-describedby="hs-input-helper-text" required>
                            @error('unit')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="w-full mt-4">
                            <div class="flex">
                                <input type="checkbox"
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                    wire:model="is_package">
                                <label for="hs-checked-checkbox"
                                    class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Centang bila tidak
                                    menggunakan ukuran/dimensi (panjangxlebar)</label>
                            </div>
                            @error('unit')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="w-full mt-4">
                            <label for="textarea-label"
                                class="block text-sm font-medium mb-2 dark:text-white">Deskripsi</label>
                            <textarea id="textarea-label" wire:model="description" name="description"
                                class="py-2 px-3 sm:py-3 sm:px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                rows="3" placeholder="Layanan full lembur"></textarea>
                            @error('address')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Komponen Works Employees --}}
                        <div class="overflow-x-auto mt-4">
                             <label for="work-table"
                                class="block text-sm font-medium mb-2 dark:text-white">Daftar Upah Karyawan</label>
                            <table class="w-full table-auto" id="work-table">
                                <thead class="bg-gray-100 border">
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">
                                                Job
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">
                                                Karyawan
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">
                                                Upah
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        {{-- <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">
                                                Upah
                                            </span>
                                        </div> --}}
                                    </th>
                                </thead>
                                <tbody class="border">
                                    @foreach ($workemployees as $i => $row)
                                        <tr wire:key="row-{{ $i }}" class="mb-2 border">
                                            <td class="p-q border">
                                                <select
                                                    wire:model.live.debounce.300ms="workemployees.{{ $i }}.work_id"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm
           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    <option value="">Pilih ...</option>
                                                    @foreach ($works as $s)
                                                        <option value="{{ $s->id }}">{{ $s->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="p-q border">
                                                <select
                                                    wire:model.live.debounce.300ms="workemployees.{{ $i }}.employee_id"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm
           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    <option value="">Pilih ...</option>
                                                    @foreach ($employees as $s)
                                                        <option value="{{ $s->id }}">{{ $s->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="p-1 border border-t-gray-400">
                                                <input type="number" step="0.01"
                                                    wire:model.live.debounce.300ms="workemployees.{{ $i }}.default_pay"
                                                    class="text-end block w-full rounded-md border-gray-300 shadow-sm
           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm read-only:bg-gray-100" readonly />
                                            </td>
                                             <td class="p-1 border border-t-gray-400 text-center">
                                            {{-- <button wire:click="removeRow({{ $i }})"
                                                class="text-red-500">✕</button> --}}
                                            <button type="button"
                                                class="cursor-pointer hs-tooltip-toggle py-1.5 px-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-md bg-red-400 text-white shadow-2xs hover:bg-red-500 focus:outline-hidden focus:bg-red-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                                wire:click="removeRow({{ $i }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="m14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21q.512.078 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48 48 0 0 0-3.478-.397m-12 .562q.51-.088 1.022-.165m0 0a48 48 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a52 52 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a49 49 0 0 0-7.5 0" />
                                                </svg>
                                                <span
                                                    class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-2xs dark:bg-neutral-700"
                                                    role="tooltip">
                                                    Hapus
                                                </span>
                                            </button>
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <button type="button" wire:click="addRow"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-400 focus:outline-hidden focus:bg-teal-300 disabled:opacity-50 disabled:pointer-events-none">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            Tambah Baris
                        </button>
                        </div>
                        {{-- END: Komponen Works Employees --}}
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-end gap-2 px-6 py-4 border-t border-gray-200">
                        <button type="button" wire:click="closeModal"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                            Keluar
                        </button>
                        <button type="submit" wire:loading.attr="disabled"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            {{ $update_data ? 'Update' : 'Simpan' }}
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
