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
                                Upah/ Gaji
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                Berdasarkan pengambilan dan upah kerja
                            </p>
                        </div>
                        <div>
                            <div class="inline-flex gap-x-2">


                                <button type="button" wire:click="print"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
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
                                    Print
                                </button>
                            </div>
                        </div>

                    </div>
                    <!-- End Header -->
                    <!-- Search Item -->
                    {{-- <div class="px-4 py-3"> --}}
                    <div class="grid grid-cols-1 gap-3 px-4 my-4 md:grid-cols-4">
                        <div class="relative max-w-xs">
                            <label for="hs-table-search" class="sr-only">Search</label>
                            <input type="text" name="hs-table-search" wire:model.live.debounce.100ms="search"
                                id="hs-table-search"
                                class="py-1.5 sm:py-2 px-3 ps-9 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Search for items">
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
                        <div>
                            <input type="date" wire:model.live.debounce.100ms="start_date"
                                class="py-1.5 sm:py-2 px-3 ps-9 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        </div>
                        <div>
                            <input type="date" wire:model.live.debounce.100ms="end_date"
                                class="py-1.5 sm:py-2 px-3 ps-9 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        </div>

                    </div>
                    <!-- End Search Item -->
                    <!-- Table -->
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead class="bg-gray-50 dark:bg-neutral-800">
                            <tr>


                                <th scope="col" class="py-3 ps-6 pe-6 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            NO
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="py-3 ps-6 pe-6 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Tgl. Pengambilan
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="py-3 ps-6 pe-6 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Customer
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Panjang
                                        </span>
                                    </div>
                                </th>



                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Lebar
                                        </span>
                                    </div>
                                </th>

                                {{-- <th scope="col" class="px-6 py-3 text-right">
                                    <div class="flex gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Harga
                                        </span>
                                    </div>
                                </th> --}}
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex justify-end gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Qty
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex justify-end gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Qty Total
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex justify-end gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Sub Total
                                        </span>
                                    </div>
                                </th>
                                @foreach ($employees as $emp)
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex justify-end gap-x-2">
                                            <span
                                                class="text-xs font-semibold text-gray-800 uppercase text-end dark:text-neutral-200">
                                                {{ $emp }}
                                            </span>
                                        </div>
                                    </th>
                                @endforeach



                                {{-- <th scope="col" class="px-6 py-3 text-end"></th> --}}
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @forelse ($rows as $row)
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
                                    <td class="size-px whitespace-nowrap">
                                        <div class="py-3 ps-6 pe-6">
                                            <div class="flex items-center gap-x-3">

                                                <div class="grow">

                                                    <span
                                                        class="block text-sm text-gray-500 dark:text-neutral-500">{{ \Carbon\Carbon::parse($row->pickup_date)->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="py-3 ps-6 pe-6">
                                            <div class="flex items-center gap-x-3">

                                                <div class="grow">

                                                    <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                        {{ $row->customer }}<br>
                                                        {{ $row->service_name }} : {{ $row->description }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="py-3 ps-6 pe-6">
                                            <div class="flex items-center gap-x-3">

                                                <div class="grow">

                                                    <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                        {{ number_format($row->width, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="py-3 ps-6 pe-6">
                                            <div class="flex items-center gap-x-3 ">
                                                <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                    {{ number_format($row->length, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="py-3 ps-6 pe-6">
                                            <div class="flex items-center justify-end gap-x-3">
                                                <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                    {{ number_format($row->qty, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="py-3 ps-6 pe-6">
                                            <div class="flex items-center justify-end gap-x-3">
                                                <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                    {{ number_format($row->qty_final, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="py-3 ps-6 pe-6">
                                            <div class="flex items-center justify-end gap-x-3">
                                                <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                    {{ number_format($row->subtotal, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    @foreach ($employees as $emp)
                                        <td class="size-px whitespace-nowrap">
                                            <div class="py-3 ps-6 pe-6">
                                                <div class="flex items-center justify-end gap-x-3">
                                                    <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                        {{ number_format($row->$emp ?? 0, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    @endforeach


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-sm text-center text-gray-500">Tidak ada
                                        Beluma ada data pengambilan dibayar
                                    </td>
                                </tr>
                            @endforelse




                        </tbody>
                    </table>
                    <!-- End Table -->

                    <!-- Footer -->
                    {{-- <div
                        class="grid gap-3 px-6 py-4 border-t border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
                        {{ $this->rows->links() }}
                        <div>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                <span
                                    class="font-semibold text-gray-800 dark:text-neutral-200">{{ $rows->total() }}</span>
                                results
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">
                                <button type="button" {{ $rows->onFirstPage() ? 'disabled' : '' }}
                                    class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m15 18-6-6 6-6" />
                                    </svg>
                                    Prev
                                </button>

                                <button type="button" {{ $rows->onLastPage() ? 'disabled' : '' }}
                                    class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
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
                    </div> --}}
                    <!-- End Footer -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Card -->

</div>
