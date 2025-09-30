<div>
    {{-- @include('livewire.components.payment.widget', [
        'totalAmount' => $totalAmount,
        'pageAmount' => $payments->sum('amount'),
    ]) --}}
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
                                Laporan Kas
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                Uang Muka/ Depe, Bayar pengambilan, Pembayaran Piutang
                            </p>
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
                            <input type="date" wire:model.live.debounce.30ms="dateFrom"
                                class="py-1.5 sm:py-2 px-3 ps-9 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        </div>
                        <div>
                            <input type="date" wire:model.live.debounce.30ms="dateTo"
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
                                            Tanggal Bayar
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Item dibayar
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start w-32">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Metode
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Jenis Pembayaran
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 w-16 text-end">
                                    {{-- <div class="flex items-center"> --}}
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Jumlah
                                        </span>
                                    {{-- </div> --}}
                                </th>
                                {{--
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Detail Order
                                        </span>
                                    </div>
                                </th>



                                <th scope="col" class="px-6 py-3 text-start">
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
                                            Jenis
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Subtotal
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Bayar DP
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold text-gray-800 uppercase dark:text-neutral-200">
                                            Bayar Pengambilan
                                        </span>
                                    </div>
                                </th>



                                <th scope="col" class="px-6 py-3 text-end"></th> --}}
                            </tr>
                        </thead>
                        {{ $payments->sum('amount') }}
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @forelse ($payments as $item)
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
                                                        class="block text-sm text-gray-500 dark:text-neutral-500">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap ">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                @if (optional($item->order)->id)
                                                    @foreach ($item->order->orderdetail as $od)
                                                        {{ $od->description }}
                                                    @endforeach
                                                @elseif (optional($item->pickup)->id)
                                                    @foreach ($item->pickup->pickupdetail as $od)
                                                        {{ $od->orderdetail->description }}
                                                    @endforeach
                                                @endif
                                            </span>
                                        </div>
                                    </td>

                                    <td class="h-px whitespace-nowrap w-32">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                @if ($item->payment_method == 'cash')
                                                    CASH
                                                @else
                                                    TRANSFER
                                                @endif
                                            </span>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap ">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                @if (optional($item->order)->id)
                                                    UANG MUKA
                                                @elseif (optional($item->pickup)->id)
                                                    @if (!$item->pickup->pickup_date->isSameDay($item->created_at))
                                                        PIUTANG
                                                    @else
                                                        PENGAMBILAN/ PENYERAHAN
                                                    @endif
                                                @endif
                                            </span>
                                        </div>
                                    </td>
                                    <td class="h-px whitespace-nowrap text-right w-16">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                {{ number_format($item->amount, 2, ',', '.') }}
                                            </span>
                                        </div>
                                    </td>
                                    {{--
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                @if ($item->orderdetail->service->is_package)
                                                    {{ number_format($item->qty, 2, ',', '.') }}
                                                @else
                                                    {{ number_format($item->qty, 2, ',', '.') }}
                                                    ({{ number_format($item->orderdetail->width, 2, ',', '.') }} x
                                                    {{ number_format($item->orderdetail->length, 2, ',', '.') }})
                                                @endif
                                            </span>
                                        </div>
                                    </td>

                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="text-sm text-gray-500 dark:text-neutral-500">
                                                <ul>
                                                    <li>
                                                        {{ $item->pickup->customer->name }}
                                                    </li>
                                                    <li>
                                                        {{ $item->orderdetail->order->note }}
                                                    </li>
                                                </ul>
                                            </span>
                                        </div>
                                    </td> --}}
                                    {{-- <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <ul class="text-sm text-gray-700 list-disc list-inside">
                                                <span
                                                    class="text-sm text-gray-500 dark:text-neutral-500">{{ $item->orderdetail->service->name }}</span>

                                            </ul>
                                        </div>
                                    </td> --}}
                                    {{-- <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <ul class="text-sm text-gray-700 list-disc list-inside text-end">
                                                <span class="text-sm text-gray-500 dark:text-neutral-500">
                                                    @if ($item->orderdetail->service->is_package)
                                                        {{ number_format($item->orderdetail->price * $item->qty, 2, ',', '.') }}
                                                    @else
                                                        {{ number_format($item->orderdetail->price * $item->orderdetail->width * $item->orderdetail->length * $item->qty, 2, ',', '.') }}
                                                    @endif

                                                </span>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <ul class="text-sm text-gray-700 list-disc list-inside text-end">
                                                <span
                                                    class="text-sm text-gray-500 dark:text-neutral-500">{{ number_format($item->dp, 2, ',', '.') }}</span>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <ul class="text-sm text-gray-700 list-disc list-inside text-end">
                                                <span
                                                    class="text-sm text-gray-500 dark:text-neutral-500">{{ number_format($item->bayarpickup, 2, ',', '.') }}</span>
                                            </ul>
                                        </div>
                                    </td> --}}


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-sm text-center text-gray-500">Belum ada
                                        pembayaran apapun
                                    </td>
                                </tr>
                            @endforelse




                        </tbody>
                        <tfoot class="bg-gray-50 dark:bg-neutral-800">
                            <tr>
                                <td colspan="5"
                                    class="px-6 py-3 text-end font-semibold text-gray-800 dark:text-neutral-200">
                                    SUBTOTAL
                                </td>
                                <td class="px-6 py-3 text-right font-semibold text-gray-800 dark:text-neutral-200">
                                    {{ number_format($payments->sum('amount'), 2, ',', '.') }}
                                </td>
                                {{-- <td colspan="2"></td> --}}
                            </tr>
                        </tfoot>
                    </table>
                    <!-- End Table -->

                    <!-- Footer -->
                    <div
                        class="grid gap-3 px-6 py-4 border-t border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                <span
                                    class="font-semibold text-gray-800 dark:text-neutral-200">{{ $payments->total() }}</span>
                                results
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">
                                <button type="button" {{ $payments->onFirstPage() ? 'disabled' : '' }}
                                    class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m15 18-6-6 6-6" />
                                    </svg>
                                    Prev
                                </button>

                                <button type="button" {{ $payments->onLastPage() ? 'disabled' : '' }}
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
                    </div>
                    <!-- End Footer -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Card -->
    {{-- Nothing in the world is as soft and yielding as water. --}}
    {{-- @livewire('components.pickup.pickup-wizard-modal') --}}
</div>
