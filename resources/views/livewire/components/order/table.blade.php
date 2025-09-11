<div>
    {{-- Alert --}}
    @if (session()->has('success'))
        <div class="p-4 mt-2 mb-5 text-sm text-teal-800 bg-teal-100 border border-teal-200 rounded-lg dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500"
            role="alert" tabindex="-1" aria-labelledby="hs-soft-color-success-label">
            <span id="hs-soft-color-success-label" class="font-bold">Success</span> {{ session('success') }}
        </div>
    @endif
    {{-- End Alert --}}
    <!-- Card -->
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div
                    class="overflow-hidden bg-white border border-gray-200 rounded-xl shadow-2xs dark:bg-neutral-800 dark:border-neutral-700">
                    <!-- Header -->
                    <div
                        class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                Pesanan/ Orderan
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                Tambah Pesanan baru, Edit dan Hapus
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">


                                <button type="button" wire:click="openModal"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                    Orderan Baru
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End Header -->
                    <!-- Search Item -->
                    <div class="flex flex-wrap gap-3 px-4 py-3 ">
                        <div class="relative w-full lg:w-1/4">
                            <label class="sr-only">Search</label>
                            <input type="text" wire:model.live.debounce.100ms="search"
                                class="py-1.5 sm:py-2 px-3 ps-9 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Cari customer atau pesanan">
                            <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                <svg class="text-gray-400 size-4 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-center max-w-xs gap-2 ml-4">
                            <label for="hs-date-from"
                                class="text-sm text-gray-800 dark:text-neutral-200">Tanggal</label>
                            <input type="date" wire:model.live.debounce.100ms="dateFrom" id="hs-date-from"
                                class="py-1.5 sm:py-2 px-3 ps-9 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
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
                        <div class="flex items-center max-w-xl gap-2 ml-4">
                            <label class="text-sm text-gray-800 dark:text-neutral-200">Sampai</label>
                            <input type="date" name="date-to" wire:model.live.debounce.100ms="dateTo"
                                class="py-1.5 sm:py-2 px-3 ps-9 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
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
                    <!-- End Search Item -->
                    <!-- Table -->
                    <div class="overflow-x-auto">


                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-800">
                                <tr>


                                    <th scope="col" class="w-8 py-3 ps-6 pe-6 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                                #
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="w-40 px-6 py-3 truncate text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                                Nama Customer
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="w-32 px-6 py-3 truncate text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                                Service
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="w-12 px-6 py-3 text-end">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                                Qty
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="w-24 px-6 py-3 text-end">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                                Subtotal
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="hidden w-32 px-6 py-3 text-start sm:table-cell">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                                Status Proses
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="w-32 px-6 py-3 text-start sm:table-cell hidde">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                                Pengambilan
                                            </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="hidden w-32 px-6 py-3 text-start sm:table-cell">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                                Pembayaran
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="w-32 px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                                Order Date
                                            </span>
                                        </div>
                                    </th>


                                    <th scope="col" class="px-6 py-3 text-end"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse ($details as $item)
                                    <tr>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="py-3 ps-6 pe-6">
                                                <div class="flex items-center gap-x-3">

                                                    <div class="grow">

                                                        <span
                                                            class="block text-sm text-gray-500 dark:text-neutral-500">{{ $loop->iteration }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="h-px w-72 whitespace-nowrap">
                                            <div class="px-6 py-3">

                                                <span
                                                    class="block text-sm text-gray-500 dark:text-neutral-500">{{ $item->order->customer->name }}</span>
                                            </div>
                                        </td>
                                        <td class="h-px w-72 whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <ul>
                                                    <li class="block text-sm text-gray-500 dark:text-neutral-500">
                                                        {{ $item->service->name }}
                                                    </li>
                                                    <li class="block text-xs text-gray-500 dark:text-neutral-500">
                                                        {{ $item->description }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="h-px w-72 whitespace-nowrap">
                                            <div class="px-6 py-3">

                                                <span
                                                    class="block text-sm text-gray-500 dark:text-neutral-500">{{ number_format($item->qty, 0, ',', '.') }}
                                                    ({{ number_format($item->width, 2, ',', '.') }} x
                                                    {{ number_format($item->length, 2, ',', '.') }})
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px w-72 whitespace-nowrap">
                                            <div class="px-6 py-3">

                                                <span class="block text-sm text-gray-500 dark:text-neutral-500">Rp
                                                    {{ number_format($item->subtotal, 2, ',', '.') }}</span>
                                            </div>
                                        </td>
                                        <td class="h-px w-72 whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                @if ($item->process_status == 'pending')
                                                    <div>
                                                        <button type="button"
                                                            wire:click="changeStatus({{ $item->id }})"
                                                            class="inline-flex items-center px-2 py-1 text-xs text-orange-800 bg-gray-100 rounded-full cursor-pointer gap-x-1 hover:bg-gray-200 hover:text-orange-500 dark:bg-neutral-500/20 dark:text-neutral-400">
                                                            <svg class="shrink-0 size-3"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path
                                                                    d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z">
                                                                </path>
                                                                <path d="M12 9v4"></path>
                                                                <path d="M12 17h.01"></path>
                                                            </svg>
                                                            Pending
                                                        </button>
                                                    </div>
                                                @elseif ($item->process_status == 'process')
                                                    <div>
                                                        <button type="button"
                                                            wire:click="changeStatus({{ $item->id }})"
                                                            class="cursor-pointer py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-blue-100 hover:bg-blue-200 text-blue-800 hover:text-blue-500 rounded-full dark:bg-yellow-500/10 dark:text-blue-500">
                                                            <svg class="shrink-0 size-3"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <line x1="12" x2="12" y1="2"
                                                                    y2="6"></line>
                                                                <line x1="12" x2="12" y1="18"
                                                                    y2="22"></line>
                                                                <line x1="4.93" x2="7.76" y1="4.93"
                                                                    y2="7.76"></line>
                                                                <line x1="16.24" x2="19.07" y1="16.24"
                                                                    y2="19.07"></line>
                                                                <line x1="2" x2="6" y1="12"
                                                                    y2="12"></line>
                                                                <line x1="18" x2="22" y1="12"
                                                                    y2="12"></line>
                                                                <line x1="4.93" x2="7.76" y1="19.07"
                                                                    y2="16.24"></line>
                                                                <line x1="16.24" x2="19.07" y1="7.76"
                                                                    y2="4.93"></line>
                                                            </svg>
                                                            Proses
                                                        </button>
                                                    </div>
                                                @else
                                                    <div>
                                                        <button type="button"
                                                            wire:click="changeStatus({{ $item->id }})"
                                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-teal-800 rounded-full gap-x-1 bg-sky-100 hover:text-teal-500 dark:bg-teal-500/10 hover:bg-teal-200 dark:text-teal-500 disabled:hover:bg-sky-100 disabled:hover:text-teal-800 enabled:cursor-pointer"
                                                            {{ $item->pickup_status != 'pending' ? 'disabled' : '' }}>
                                                            <svg class="shrink-0 size-3"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path
                                                                    d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z">
                                                                </path>
                                                                <path d="m9 12 2 2 4-4"></path>
                                                            </svg>
                                                            Selesai
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="h-px w-72 whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                @if ($item->pickup_status == 'completed')
                                                    <div>
                                                        <span
                                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-teal-800 bg-teal-100 rounded-full gap-x-1 dark:bg-teal-500/10 dark:text-teal-500">
                                                            <svg class="shrink-0 size-3"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path
                                                                    d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z">
                                                                </path>
                                                                <path d="m9 12 2 2 4-4"></path>
                                                            </svg>
                                                            Sudah
                                                        </span>
                                                    </div>
                                                @elseif ($item->pickup_status == 'partially')
                                                    <div>
                                                        <span
                                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-teal-800 bg-teal-100 rounded-full gap-x-1 dark:bg-teal-500/10 dark:text-teal-500">
                                                            <svg class="shrink-0 size-3"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path
                                                                    d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z">
                                                                </path>
                                                                <path d="m9 12 2 2 4-4"></path>
                                                            </svg>
                                                            Sebagian
                                                            {{ number_format($item->pickupdetail()->sum('qty'), 0, ',', '.') }}
                                                            / {{ number_format($item->qty, 0, ',', '.') }}
                                                        </span>
                                                    </div>
                                                @else
                                                    <div>
                                                        <span
                                                            class="inline-flex items-center px-2 py-1 text-xs text-orange-800 bg-gray-200 rounded-sm gap-x-1 dark:bg-neutral-500/20 dark:text-neutral-400">
                                                            <svg class="shrink-0 size-3"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path
                                                                    d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z">
                                                                </path>
                                                                <path d="M12 9v4"></path>
                                                                <path d="M12 17h.01"></path>
                                                            </svg>
                                                            Belum
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="h-px w-72 whitespace-nowrap">
                                            <div class="px-6 py-3">

                                                <span
                                                    class="block text-sm text-gray-500 capitalize dark:text-neutral-500">
                                                    @if ($item->order->payment_status === 'unpaid')
                                                        Belum Dibayar
                                                    @elseif ($item->order->payment_status === 'partially')
                                                        Dibayar sebagian
                                                    @elseif ($item->order->payment_status === 'paid')
                                                        Lunas
                                                    @endif
                                                    {{-- {{ $item->order->payment_status }} --}}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px w-72 whitespace-nowrap">
                                            <div class="px-6 py-3">

                                                <span class="block text-sm text-gray-500 dark:text-neutral-500"
                                                    title="{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}">
                                                    {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                                </span>
                                            </div>
                                        </td>


                                        <td class="size-px whitespace-nowrap">
                                            <div class="flex gap-2">

                                                {{-- <div class="inline-block hs-tooltip">
                                                    <button type="button"
                                                        class="cursor-pointer hs-tooltip-toggle py-1.5 px-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-md bg-sky-400 text-white shadow-2xs hover:bg-sky-500 focus:outline-hidden focus:bg-sky-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                                        wire:click="edit({{ $item->id }})"
                                                        {{ $item->status == 'completed' ? 'disabled' : '' }}>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 24 24">
                                                            <g class="edit-outline">
                                                                <g fill="currentColor" fill-rule="evenodd"
                                                                    class="Vector" clip-rule="evenodd">
                                                                    <path
                                                                        d="M2 6.857A4.857 4.857 0 0 1 6.857 2H12a1 1 0 1 1 0 2H6.857A2.857 2.857 0 0 0 4 6.857v10.286A2.857 2.857 0 0 0 6.857 20h10.286A2.857 2.857 0 0 0 20 17.143V12a1 1 0 1 1 2 0v5.143A4.857 4.857 0 0 1 17.143 22H6.857A4.857 4.857 0 0 1 2 17.143z" />
                                                                    <path
                                                                        d="m15.137 13.219l-2.205 1.33l-1.033-1.713l2.205-1.33l.003-.002a1.2 1.2 0 0 0 .232-.182l5.01-5.036a3 3 0 0 0 .145-.157c.331-.386.821-1.15.228-1.746c-.501-.504-1.219-.028-1.684.381a6 6 0 0 0-.36.345l-.034.034l-4.94 4.965a1.2 1.2 0 0 0-.27.41l-.824 2.073a.2.2 0 0 0 .29.245l1.032 1.713c-1.805 1.088-3.96-.74-3.18-2.698l.825-2.072a3.2 3.2 0 0 1 .71-1.081l4.939-4.966l.029-.029c.147-.15.641-.656 1.24-1.02c.327-.197.849-.458 1.494-.508c.74-.059 1.53.174 2.15.797a2.9 2.9 0 0 1 .845 1.75a3.15 3.15 0 0 1-.23 1.517c-.29.717-.774 1.244-.987 1.457l-5.01 5.036q-.28.281-.62.487m4.453-7.126s-.004.003-.013.006z" />
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <span
                                                            class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded-md opacity-0 hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible shadow-2xs dark:bg-neutral-700"
                                                            role="tooltip">
                                                            Update
                                                        </span>
                                                    </button>
                                                </div> --}}
                                                <div class="inline-block hs-tooltip">
                                                    <button type="button"
                                                        class="cursor-pointer hs-tooltip-toggle py-1.5 px-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-md bg-orange-400 text-white shadow-2xs hover:bg-orange-500 focus:outline-hidden focus:bg-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                                        wire:click="openModalBayarDepe({{ $item->order_id }})"
                                                        {{ $item->pickup_status == 'completed' ? 'disabled' : '' }}>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 14 14">
                                                            <g fill="none" stroke="currentColor"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1">
                                                                <path
                                                                    d="M8.276 3.979a1 1 0 0 0-.943-.667H6.56a.893.893 0 0 0-.19 1.765l1.178.257a1 1 0 0 1-.214 1.978h-.666a1 1 0 0 1-.943-.667M7 3.312v-1m0 6v-1" />
                                                                <path
                                                                    d="M11.5 5.031a4.5 4.5 0 1 0-6.5 4v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1.5a4.48 4.48 0 0 0 2.5-4M5 13.5h4" />
                                                            </g>
                                                        </svg>
                                                        <span
                                                            class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded-md opacity-0 hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible shadow-2xs dark:bg-neutral-700"
                                                            role="tooltip">
                                                            Bayar Depe
                                                        </span>
                                                    </button>
                                                </div>
                                                <div class="inline-block hs-tooltip">
                                                    <button type="button"
                                                        class="cursor-pointer hs-tooltip-toggle py-1.5 px-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-md bg-gray-400 text-white shadow-2xs hover:bg-gray-500 focus:outline-hidden focus:bg-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                                        wire:click="print({{ $item->order->id }})"
                                                        {{ $item->pickup_status === 'completed' ? 'disabled' : '' }}>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 24 24">
                                                            <g fill="none" stroke="currentColor" stroke-width="1">
                                                                <path
                                                                    d="M18 13.5h.5c.943 0 1.414 0 1.707-.293s.293-.764.293-1.707v-1c0-1.886 0-2.828-.586-3.414S18.386 6.5 16.5 6.5h-9c-1.886 0-2.828 0-3.414.586S3.5 8.614 3.5 10.5v2c0 .471 0 .707.146.854c.147.146.383.146.854.146H6" />
                                                                <path
                                                                    d="M6.5 19.806V11.5c0-.943 0-1.414.293-1.707S7.557 9.5 8.5 9.5h7c.943 0 1.414 0 1.707.293s.293.764.293 1.707v8.306c0 .317 0 .475-.104.55s-.254.025-.554-.075l-2.168-.723a.5.5 0 0 0-.173-.042a.5.5 0 0 0-.171.052l-2.144.858a.5.5 0 0 1-.186.055a.5.5 0 0 1-.186-.055l-2.144-.858c-.084-.034-.126-.05-.17-.052s-.088.013-.174.042l-2.168.723c-.3.1-.45.15-.554.075s-.104-.233-.104-.55Z" />
                                                                <path stroke-linecap="round" d="M9.5 13.5h4m-4 3h5" />
                                                                <path
                                                                    d="M17.5 6.5v-.4c0-1.697 0-2.546-.527-3.073S15.597 2.5 13.9 2.5h-3.8c-1.697 0-2.546 0-3.073.527S6.5 4.403 6.5 6.1v.4" />
                                                            </g>
                                                        </svg>
                                                        <span
                                                            class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded-md opacity-0 hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible shadow-2xs dark:bg-neutral-700"
                                                            role="tooltip">
                                                            Print Struck
                                                        </span>
                                                    </button>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-4 py-6 text-sm text-center text-gray-500">Belum
                                            ada
                                            pesanan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table -->

                    <!-- Footer -->
                    <div
                        class="grid gap-3 px-6 py-4 border-t border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                <span
                                    class="font-semibold text-gray-800 dark:text-neutral-200">{{ $details->total() }}</span>
                                results
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">
                                <button type="button" {{ $details->onFirstPage() ? 'disabled' : '' }}
                                    class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m15 18-6-6 6-6" />
                                    </svg>
                                    Prev
                                </button>

                                <button type="button" {{ $details->onLastPage() ? 'disabled' : '' }}
                                    class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50  disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    wire:click="nextPage" wire:loading.attr="disabled" rel="next">
                                    Next
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End Footer -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Card -->


    @livewire('components.order.ordercreatemodal')
    @livewire('components.orderdetail.changeprocess')
    @livewire('components.order.modalbayardepe')
</div>
