<div>
    {{-- Alert --}}
    @if (session()->has('success'))
        <div class="mt-2 mb-5 bg-teal-100 border border-teal-200 text-sm text-teal-800 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500"
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
                    class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                    <!-- Header -->
                    <div
                        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                Layanan
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                Tambah jenis layanan, edit dan lain-lain
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">


                                <button type="button" wire:click="openModal"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                    Layanan Baru
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End Header -->
                    <!-- Search Item -->
                    <div class="py-3 px-4">
                        <div class="relative max-w-xs">
                            <label for="hs-table-search" class="sr-only">Search</label>
                            <input type="text" name="hs-table-search" wire:model.live.debounce.250ms="search"
                                id="hs-table-search"
                                class="py-1.5 sm:py-2 px-3 ps-9 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Search for items">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                <svg class="size-4 text-gray-400 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <!-- End Search Item -->
                    <!-- Table -->
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead class="bg-gray-50 dark:bg-neutral-800">
                            <tr>


                                <th scope="col" class="ps-6 pe-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            #
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="ps-6 pe-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Nama
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Harga
                                        </span>
                                    </div>
                                </th>



                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Deskripsi
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Jenis
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Unit
                                        </span>
                                    </div>
                                </th>


                                <th scope="col" class="px-6 py-3 text-end"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @foreach ($services as $item)
                                <tr>

                                    <td class="size-px whitespace-nowrap">
                                        <div class="ps-6  pe-6 py-3">
                                            <div class="flex items-center gap-x-3">

                                                <div class="grow">

                                                    <span
                                                        class="block text-sm text-gray-500 dark:text-neutral-500">{{ $loop->iteration }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="ps-6  pe-6 py-3">
                                            <div class="flex items-center gap-x-3">

                                                <div class="grow">

                                                    <span
                                                        class="block text-sm text-gray-500 dark:text-neutral-500">{{ $item->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3">

                                            <span class="block text-sm text-gray-500 dark:text-neutral-500">Rp
                                                {{ number_format($item->price, 0, ',', '.') }}</span>
                                        </div>
                                    </td>

                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="text-sm text-gray-500 dark:text-neutral-500">{{ $item->description }}</span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            @if ($item->is_package)
                                                <div>
                                                    <span
                                                        class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="m221.76 69.66l-88-48.18a12 12 0 0 0-11.52 0l-88 48.18A12 12 0 0 0 28 80.18v95.64a12 12 0 0 0 6.24 10.52l88 48.18a11.95 11.95 0 0 0 11.52 0l88-48.18a12 12 0 0 0 6.24-10.52V80.18a12 12 0 0 0-6.24-10.52M126.08 28.5a3.94 3.94 0 0 1 3.84 0L216.67 76L178.5 96.89a4 4 0 0 0-.58-.4l-88-48.18Zm1.92 96L39.33 76l42.23-23.13l88.67 48.54Zm-89.92 54.8a4 4 0 0 1-2.08-3.5V83.29l88 48.16v94.91Zm179.84 0l-85.92 47v-94.85l40-21.89V152a4 4 0 0 0 8 0v-46.82l40-21.89v92.53a4 4 0 0 1-2.08 3.5Z"/></svg>
                                                        Paket
                                                    </span>
                                                </div>
                                            @else
                                                <div>
                                                        <button type="button"
                                                            wire:click="changeStatus({{ $item->id }})"
                                                            class="cursor-pointer py-1 px-2 inline-flex items-center gap-x-1 text-xs bg-gray-100 hover:bg-gray-200 text-orange-800 hover:text-orange-500 rounded-full dark:bg-neutral-500/20 dark:text-neutral-400">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 23.3 25.7"><path fill="currentColor" d="M0 17.5v8.2h23.3v-8.2zm22.3 7.2H1v-6.2h1V20h1v-1.6h1v3.1h1v-3.1h1.5V20h1v-1.6h1.2v3.1h1v-3.1h1.4V20h1v-1.6h1.4v3.1h1v-3.1h1.2V20h1v-1.6h1.5v3.1h1v-3.1h1.1V20h1v-1.6h1zm-3-22.1H13V0h-2.7v2.6H4L1.4 15.9H22zm-8-1.6h.7v1.6h-.7zM4.8 3.6h13.7l2.2 11.3H2.6z"/><path fill="currentColor" d="M11 6.9h-1L8.6 8.6c-.2.1-.3.3-.5.5V4.7h-.8v7h.9V9.9l.4-.5l1.7 2.3h1.1L9.2 8.9zm4.2.7c-.2-.4-.7-.8-1.5-.8c-1.1 0-2.2.9-2.2 2.5c0 1.3.9 2.3 2 2.3c.7 0 1.3-.4 1.5-.8v.5c0 1.2-.7 1.7-1.5 1.7c-.6 0-1.1-.2-1.4-.4l-.1.8c.4.3 1 .4 1.6.4s1.3-.1 1.7-.6c.5-.4.7-1.1.7-2.2V6.9h-.8zm-.1 2c0 .1 0 .3-.1.5c-.2.6-.7.9-1.2.9c-.9 0-1.4-.8-1.4-1.7c0-1.1.6-1.8 1.4-1.8c.6 0 1.1.4 1.2.9v1.2z"/></svg>
                                                            Dimensi
                                                        </button>
                                                    </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="text-sm text-gray-500 dark:text-neutral-500">{{ $item->unit }}</span>
                                        </div>
                                    </td>

                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-1.5">
                                            <button type="button"
                                                class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500"
                                                wire:click="edit({{ $item->id }})">
                                                Edit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach




                        </tbody>
                    </table>
                    <!-- End Table -->

                    <!-- Footer -->
                    <div
                        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                <span
                                    class="font-semibold text-gray-800 dark:text-neutral-200">{{ $services->total() }}</span>
                                results
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">
                                <button type="button" {{ $services->onFirstPage() ? 'disabled' : '' }}
                                    class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m15 18-6-6 6-6" />
                                    </svg>
                                    Prev
                                </button>

                                <button type="button" {{ $services->onLastPage() ? 'disabled' : '' }}
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
    @livewire('components.service.modalform')
</div>
