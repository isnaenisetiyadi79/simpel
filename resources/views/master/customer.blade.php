@extends('layouts.master')

@section('title', 'Customer')


@section('content')
    <!-- Content -->
    <div class="w-full lg:ps-64">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <!-- Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <!-- Card -->
                <div
                    class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <div class="p-4 md:p-5">
                        <div class="flex items-center gap-x-2">
                            <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                                Total users
                            </p>
                            <div class="hs-tooltip">
                                <div class="hs-tooltip-toggle">
                                    <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                        <path d="M12 17h.01" />
                                    </svg>
                                    <span
                                        class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-2xs dark:bg-neutral-700"
                                        role="tooltip">
                                        The number of daily users
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                                72,540
                            </h3>
                            <span class="flex items-center gap-x-1 text-green-600">
                                <svg class="inline-block size-4 self-center" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="22 7 13.5 15.5 8.5 10.5 2 17" />
                                    <polyline points="16 7 22 7 22 13" />
                                </svg>
                                <span class="inline-block text-sm">
                                    1.7%
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div
                    class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <div class="p-4 md:p-5">
                        <div class="flex items-center gap-x-2">
                            <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                                Sessions
                            </p>
                        </div>

                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                                29.4%
                            </h3>
                        </div>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div
                    class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <div class="p-4 md:p-5">
                        <div class="flex items-center gap-x-2">
                            <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                                Avg. Click Rate
                            </p>
                        </div>

                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                                56.8%
                            </h3>
                            <span class="flex items-center gap-x-1 text-red-600">
                                <svg class="inline-block size-4 self-center" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="22 17 13.5 8.5 8.5 13.5 2 7" />
                                    <polyline points="16 17 22 17 22 11" />
                                </svg>
                                <span class="inline-block text-sm">
                                    1.7%
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div
                    class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <div class="p-4 md:p-5">
                        <div class="flex items-center gap-x-2">
                            <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                                Pageviews
                            </p>
                        </div>

                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                                92,913
                            </h3>
                        </div>
                    </div>
                </div>
                <!-- End Card -->
            </div>
            <!-- End Grid -->


            @livewire('components.customers.table');
        </div>
    </div>
    <!-- End Content -->

    

    {{-- <div id="hs-offcanvas-right"
        class="hs-overlay hs-overlay-open:translate-x-0 hidden translate-x-full fixed top-0 end-0 transition-all duration-300 transform h-full max-w-md w-full z-80 bg-white border-s border-gray-200 dark:bg-neutral-800 dark:border-neutral-700"
        role="dialog" tabindex="-1" aria-labelledby="hs-offcanvas-right-label">
        <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
            <h3 id="hs-offcanvas-right-label" class="font-bold text-gray-800 dark:text-white">
                Create New Customer
            </h3>
            <button type="button"
                class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                aria-label="Close" data-hs-overlay="#hs-offcanvas-right">
                <span class="sr-only">Close</span>
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-4">
            <form action="{{ route('master.customer.store') }}" method="POST">
                @csrf
                <div class="w-full">
                    <label for="input-label-with-helper-text"
                        class="block text-sm font-medium mb-2 dark:text-white">Nama Customer</label>
                    <input type="name" name="name" id="input-label-with-helper-name"
                        class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        placeholder="John Doe" aria-describedby="hs-input-helper-text" required>

                </div>
                <div class="w-full mt-4">
                    <label for="input-label-with-helper-email"
                        class="block text-sm font-medium mb-2 dark:text-white">Email</label>
                    <input type="email" name="email" id="input-label-with-helper-email"
                        class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        placeholder="moge@gmail.com" aria-describedby="hs-input-helper-text">

                </div>
                <div class="w-full mt-4">
                    <label for="input-label-with-helper-phone" class="block text-sm font-medium mb-2 dark:text-white">No.
                        Telp</label>
                    <input type="number" name="phone_number" id="input-label-with-helper-phone"
                        class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        placeholder="08122222222" aria-describedby="hs-input-helper-text" required>

                </div>
                <div class="w-full mt-4">
                    <label for="textarea-label" class="block text-sm font-medium mb-2 dark:text-white">Alamat</label>
                    <textarea id="textarea-label" name="address"
                        class="py-2 px-3 sm:py-3 sm:px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        rows="3" placeholder="Jl. Siswa"></textarea>
                </div>
                <div class="mt-4 w-full">
                    <button type="submit"
                        class="w-full py-2 px-3 gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div> --}}
@endsection
