<div>
    <div wire:show="showModal" x-cloak>
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-100">
            <div class="bg-gray-100 rounded shadow-lg  md:w-3/4 lg:w-2/3 p-4 w-full">

                {{-- HEADER --}}
                <div class="flex items-center justify-between px-6 pb-2 border-b border-gray-400">
                    {{-- <h3 class="text-lg font-semibold">{{ $update_data ? 'Edit' : 'Tambah' }} Service
                            {{ $update_data ? $name : 'Baru' }}</h3> --}}
                    <h3 class="text-lg font-semibold">Orderan Baru</h3>
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
                <div class="px-6 py-4 text-sm text-gray-700 border-gray-400">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div wire:ignore>
                            <label
                                class="text-xs font-bold uppercase text-gray-600 dark:text-neutral-100">Customer</label>
                            <select
                                data-hs-select='{
                                                "hasSearch": true,
                                                "searchPlaceholder": "Search...",
                                                "searchClasses": "block w-full sm:text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-1 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-1.5 sm:py-2 px-3",
                                                "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
                                                "placeholder": "Pilih Customer...",
                                                "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200 \" data-title></span></button>",
                                                "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600",
                                                "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                                "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-neutral-200 \" data-title></div></div></div>",
                                                "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                }'
                                class="hidden" wire:model="customer_id">
                                <option value="">Choose</option>
                                @foreach ($customers as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="max-w-sm">
                            <label for="catatan-label"
                                class="text-xs font-bold uppercase text-gray-600 dark:text-neutral-100">Catatan</label>
                            <input type="text" id="catatan-label" wire:model = "order_note"
                                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Dipercepat, akan dipakai besok">
                        </div>
                        <div>
                            <label class="text-xs font-bold uppercase text-gray-600 dark:text-neutral-100">Tanggal
                                Order</label>
                            <input type="datetime-local" wire:model="order_date"
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

                    {{-- TABEL ORDER --}}
                    @error('details.*.service_id')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                    @error('customer_id')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead class="bg-gray-100 border border-t-gray-500 border-b-gray-500">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">
                                                Service
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">
                                                Panjang
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">
                                                Lebar
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">
                                                Qty
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">
                                                Qty Asli
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">
                                                Bulat?
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">
                                                Qty Bulat
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">
                                                Harga
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">
                                                Sub Total
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start truncate">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">

                                            </span>
                                        </div>
                                    </th>


                                </tr>
                            </thead>
                            <tbody class="border border-b-gray-500">
                                @foreach ($details as $i => $row)
                                    <tr wire:key="row-{{ $i }}" class="mb-2 border border-b-gray-500">
                                        <td class="p-1 border border-t-gray-400">
                                            <select
                                                wire:model.live.debounce.300ms="details.{{ $i }}.service_id"
                                                class="block w-full rounded-md border-gray-300 shadow-sm
           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                <option value="">Pilih ...</option>
                                                @foreach ($services as $s)
                                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                                @endforeach
                                            </select>

                                        </td>
                                        <td class="p-1 border border-t-gray-400">
                                            <input type="number" step="0.01"
                                                wire:model.live.debounce.300ms="details.{{ $i }}.length"
                                                class="text-end block w-full rounded-md border-gray-300 shadow-sm
           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm {{ $details[$i]['is_package'] ?? false ? 'hidden' : '' }}" />
                                        </td>
                                        <td class="p-1 border border-t-gray-400">
                                            <input type="number" step="0.01"
                                                wire:model.live.debounce.300ms="details.{{ $i }}.width"
                                                class="text-end block w-full rounded-md border-gray-300 shadow-sm
           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm {{ $details[$i]['is_package'] ?? false ? 'hidden' : '' }}" />
                                        </td>
                                        <td class="p-1 border border-t-gray-400">
                                            <input type="number" step="0.01"
                                                wire:model.live.debounce.300ms="details.{{ $i }}.qty"
                                                class="text-end block w-full rounded-md border-gray-300 shadow-sm
           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                        </td>
                                        <td class="p-1 border border-t-gray-400">
                                            <input type="number" step="0.01"
                                                wire:model.live.debounce.300ms="details.{{ $i }}.qty_asli"
                                                class="text-end block w-full rounded-md border-gray-300 shadow-sm
           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-gray-100"
                                                readonly />
                                        </td>
                                        <td class="p-1 border text-center">
                                            <input type="checkbox"
                                                class="shrink-0 mt-0.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                wire:model.live.debounce.300ms="details.{{ $i }}.use_rounding" />
                                        </td>
                                        <td class="p-1 border border-t-gray-400">
                                            <input type="number" step="0.01"
                                                wire:model.live.debounce.300ms="details.{{ $i }}.qty_final"
                                                readonly
                                                class="text-end block w-full rounded-md border-gray-100 shadow-sm
           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-gray-100" />
                                        </td>
                                        <td class="p-1 border border-t-gray-400">
                                            <input type="number" step="0.01"
                                                wire:model.live.debounce.300ms="details.{{ $i }}.price"
                                                class="text-end block w-full rounded-md border-gray-300 shadow-sm
           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                        </td>
                                        <td class="p-1 border border-t-gray-400">
                                            <input type="text"
                                                wire:model.live.debounce.300ms="details.{{ $i }}.subtotal"
                                                readonly
                                                class="text-end block w-full rounded-md border-gray-300 shadow-sm
           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-gray-100" />
                                        </td>

                                        <td class="p-1 border border-t-gray-400 text-center" rowspan="2">
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
                                    <tr>
                                        <td class="p-1 border whitespace-nowrap" colspan="9">
                                            <div class="flex items-center gap-3">
                                                <label
                                                    class="text-xs font-bold uppercase text-gray-800 dark:text-neutral-200">Deskripsi
                                                    Pesanan</label>
                                                <input type="text"
                                                    wire:model="details.{{ $i }}.description"
                                                    class="block w-full max-w-screen rounded-md border-gray-300 shadow-sm
               focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- END : TABEL ORDER --}}
                    <div class="flex items-center">
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
                    <div class="items-en">
                        {{-- <button wire:click="addRow" class="bg-green-500 text-white px-3 py-2 rounded">+ Tambah
                            Baris</button> --}}
                        <div class="text-right">
                            {{-- <div class="font-bold text-2xl">Total: Rp
                                <span>{{ number_format(array_sum(array_column($details, 'subtotal')), 0, ',', '.') }}</span>
                            </div> --}}
                            <div class="mt-2 flex flex-col items-end space-y-2 w-full">
                                <div class="grid grid-cols-2 gap-2 w-full">
                                    <label for="catatan-label"
                                        class="w-60 font-bold uppercase text-lg text-gray-600 dark:text-neutral-100 mr-5">Total
                                        Rp.</label>
                                    <input type="text" id="catatan-label" wire:model="total_amount"
                                        class="text-end py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg text-2xl focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 read-only:cursor-not-allowed"
                                        placeholder="0" readonly>
                                </div>
                                <div class="grid grid-cols-2 gap-2 w-full">

                                    <label for="catatan-label"
                                        class="w-60 font-bold text-lg uppercase text-gray-600 dark:text-neutral-100 mr-5">Bayar
                                        Rp.</label>

                                    <div class="flex items-center gap-2 w-full">
                                        <label for="hs-radio-in-form"
                                            class="flex p-3 gap-2 bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 cursor-pointer">
                                            <input type="radio" name="hs-radio-in-form"
                                                class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                id="hs-radio-in-form" wire:model.change="payment_method"
                                                value="cash">
                                            <span
                                                class="text-sm text-gray-500 ms-3 dark:text-neutral-400 uppercase">Cash</span>
                                        </label>

                                        <label for="hs-radio-checked-in-form"
                                            class="flex p-3 bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 cursor-pointer">
                                            <input type="radio" name="hs-radio-in-form"
                                                class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 "
                                                id="hs-radio-checked-in-form" wire:model.change="payment_method"
                                                value="transfer">
                                            <span
                                                class="text-sm text-gray-500 ms-3 dark:text-neutral-400 uppercase">Transfer</span>
                                        </label>

                                        <input type="number" id="catatan-label"
                                            wire:model.live.debounce.300ms = "pay"
                                            class=" text-end py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg text-2xl focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none read-only:cursor-not-allowed"
                                            placeholder="0">

                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2 w-full">
                                    <label for="catatan-label"
                                        class="w-60 font-bold text-lg uppercase text-gray-600 dark:text-neutral-100 mr-5">Kembalian
                                        Rp.</label>
                                    <input type="number" id="catatan-label"
                                        wire:model.live.debounce.300ms = "change" readonly
                                        class="text-end py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg text-2xl focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none read-only:cursor-not-allowed"
                                        placeholder="0">
                                </div>
                            </div>
                            <div class="mt-2 space-x-2">

                                <button type="button" wire:click="closeModal"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-orange-400 text-white hover:bg-orange-500 focus:outline-hidden focus:bg-orange-500 disabled:opacity-50 disabled:pointer-events-none">
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
                                    {{ !empty($details) && count($details) > 0 ? '' : 'disabled' }}
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-400 text-white hover:bg-blue-500 focus:outline-hidden focus:bg-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 32 32">
                                        <path fill="currentColor"
                                            d="M7.5 29A4.5 4.5 0 0 1 3 24.5v-17A4.5 4.5 0 0 1 7.5 3h13.843q.06 0 .118.002a.5.5 0 0 1 .118.004a4.5 4.5 0 0 1 2.946 1.312l3.157 3.157A4.5 4.5 0 0 1 29 10.657V24.5a4.5 4.5 0 0 1-4.5 4.5zm0-25A3.5 3.5 0 0 0 4 7.5v17a3.5 3.5 0 0 0 3 3.465V18.5A2.5 2.5 0 0 1 9.5 16h13a2.5 2.5 0 0 1 2.5 2.5v9.465a3.5 3.5 0 0 0 3-3.465V10.657a3.5 3.5 0 0 0-1.025-2.475l-3.157-3.157A3.5 3.5 0 0 0 22 4.062V9.5a2.5 2.5 0 0 1-2.5 2.5h-8A2.5 2.5 0 0 1 9 9.5V4zM24 28v-9.5a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 8 18.5V28zM21 4H10v5.5a1.5 1.5 0 0 0 1.5 1.5h8A1.5 1.5 0 0 0 21 9.5z" />
                                    </svg>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
