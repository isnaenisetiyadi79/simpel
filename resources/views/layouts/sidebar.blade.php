<!-- Sidebar -->
<div id="hs-application-sidebar"
    class="hs-overlay  [--auto-close:lg]
    hs-overlay-open:translate-x-0
    -translate-x-full transition-all duration-300 transform
    w-65 h-full
    hidden
    fixed inset-y-0 start-0 z-60
    bg-white border-e border-gray-200
    lg:block lg:translate-x-0 lg:end-auto lg:bottom-0
    dark:bg-neutral-800 dark:border-neutral-700"
    role="dialog" tabindex="-1" aria-label="Sidebar">
    <div class="relative flex flex-col h-full max-h-full">
        <div class="px-6 pt-4 flex items-center">
            <!-- Logo -->
            <a class="flex-none rounded-xl text-xl inline-block font-semibold focus:outline-hidden focus:opacity-80"
                href="{{ route('dashboard') }}" aria-label="Preline">

                <div class="flex items-center">


                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><path fill="#06ac75" d="M11 7.75a.75.75 0 0 0-1.5 0v9a1.25 1.25 0 1 1-2.5 0v-7.5a.75.75 0 0 0-1.5 0v10.574c0 .79.163 1.57.478 2.295l1.36 3.127a3.75 3.75 0 0 0 3.44 2.254h3.04c1.427 0 2.803-.858 3.73-2.214c2.668-3.904 6.158-6.306 7.852-7.323c-.274-.451-.64-.841-1.092-.996c-.461-.157-1.46-.211-3.271 1.255A1.25 1.25 0 0 1 19 17.25v-9.5a.75.75 0 0 0-1.5 0v7.5a1.25 1.25 0 1 1-2.5 0v-9a.75.75 0 0 0-1.5 0v9a1.25 1.25 0 1 1-2.5 0zm10.5 7.21c1.33-.63 2.538-.727 3.617-.358c1.512.517 2.328 1.816 2.702 2.581c.567 1.16-.076 2.306-.912 2.793c-1.424.83-4.785 3.049-7.296 6.72C18.349 28.547 16.276 30 13.82 30h-3.042a6.25 6.25 0 0 1-5.73-3.756l-1.362-3.128A8.25 8.25 0 0 1 3 19.824V9.25a3.25 3.25 0 0 1 4.39-3.045a3.25 3.25 0 0 1 4-1.5a3.25 3.25 0 0 1 5.72 0A3.25 3.25 0 0 1 21.5 7.75zm-6.38 16.937C16.051 39.286 22.358 45 30 45c8.285 0 15-6.716 15-15s-6.715-15-15-15q-.578 0-1.145.043c.355.482.601.935.761 1.262c.198.404.321.805.382 1.195H30c6.904 0 12.5 5.596 12.5 12.5S36.904 42.5 30 42.5c-6.529 0-11.889-5.006-12.451-11.389a8.4 8.4 0 0 1-2.43.786m7.698 1.305a1.25 1.25 0 0 1 1.73.366A6.47 6.47 0 0 0 30 36.5a6.47 6.47 0 0 0 5.452-2.932a1.25 1.25 0 1 1 2.096 1.364A8.97 8.97 0 0 1 30 39a8.97 8.97 0 0 1-7.548-4.068a1.25 1.25 0 0 1 .366-1.73M34 29a2 2 0 1 0 0-4a2 2 0 0 0 0 4m-6-2a2 2 0 1 1-4 0a2 2 0 0 1 4 0"/></svg>
                <span class="font-extrabold text-green-600 pt-3 pl-3 italic text-2xl tracking-widest">Sim</span>
                <span class="font-extrabold text-orange-400 pt-3 pr-3 italic text-2xl tracking-widest">Pel</span>
                </div>
            </a>
            <!-- End Logo -->
        </div>

        <!-- Content -->
        <div
            class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
            <nav class="hs-accordion-group p-3 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
                <ul class="flex flex-col space-y-1">
                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm {{ Route::is('dashboard') ? 'bg-gray-100' : '' }} text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-700 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-white"
                            href="{{ route('dashboard') }}">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                            Dashboard
                        </a>
                    </li>



                    <li class="hs-accordion {{ Route::is('master.*') ? 'active' : '' }}" id="projects-accordion">
                        <button type="button"
                            class="hs-accordion-toggle w-full text-start flex {{ Route::is('master.*') ? 'bg-gray-100' : '' }} items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                            aria-expanded="true" aria-controls="projects-accordion-child">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                            </svg>
                            Data Master

                            <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m18 15-6-6-6 6" />
                            </svg>

                            <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </button>

                        <div id="projects-accordion-child"
                            class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 {{ Route::is('master.*') ? 'block' : 'hidden' }}"
                            role="region" aria-labelledby="projects-accordion">
                            <ul class="ps-8 pt-1 space-y-1">
                                <li>
                                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm {{ Route::is('master.customer') ? 'bg-gray-100' : '' }} text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                        href="{{ route('master.customer') }}">
                                        Customers
                                    </a>
                                </li>
                                <li>
                                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm {{ Route::is('master.service') ? 'bg-gray-100' : '' }} text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                        href="{{ route('master.service') }}">
                                        Service
                                    </a>
                                </li>
                                <li>
                                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm {{ Route::is('master.job') ? 'bg-gray-100' : '' }} text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                        href="{{ route('master.work') }}">
                                        Work/ Job type
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm {{ Route::is('order') ? 'bg-gray-100' : '' }} text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-700 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-white"
                            href="{{ route('order') }}">
                            <svg class="shrink-0 size-4"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.275 20.25l3.475-3.45l-1.05-1.05l-2.425 2.375l-.975-.975l-1.05 1.075zM6 9h12V7H6zm12 14q-2.075 0-3.537-1.463T13 18t1.463-3.537T18 13t3.538 1.463T23 18t-1.463 3.538T18 23M3 22V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v6.675q-.475-.225-.975-.375T19 11.075V5H5v14.05h6.075q.125.775.388 1.475t.687 1.325L12 22l-1.5-1.5L9 22l-1.5-1.5L6 22l-1.5-1.5zm3-5h5.075q.075-.525.225-1.025t.375-.975H6zm0-4h7.1q.95-.925 2.213-1.463T18 11H6zm-1 6.05V5z" />
                            </svg>
                            Transaction
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm {{ Route::is('user') ? 'bg-gray-100' : '' }} text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-700 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-white"
                            href="{{ route('user') }}">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M10 15H6a4 4 0 0 0-4 4v2m12.305-4.47l.923-.382m0-2.296l-.923-.383m2.547-1.241l-.383-.923m.383 6.467l-.383.924m2.679-6.468l.383-.923m-.001 7.391l-.382-.924m1.624-3.92l.924-.383m-.924 2.679l.924.383"/><circle cx="18" cy="15" r="3"/><circle cx="9" cy="7" r="4"/></g></svg>
                            User Management
                        </a>
                    </li>
                    {{-- <li><a class="w-full flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                            href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                <line x1="16" x2="16" y1="2" y2="6" />
                                <line x1="8" x2="8" y1="2" y2="6" />
                                <line x1="3" x2="21" y1="10" y2="10" />
                                <path d="M8 14h.01" />
                                <path d="M12 14h.01" />
                                <path d="M16 14h.01" />
                                <path d="M8 18h.01" />
                                <path d="M12 18h.01" />
                                <path d="M16 18h.01" />
                            </svg>
                            Calendar
                        </a></li> --}}

                    {{-- <li><a class="w-full flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                            href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                            </svg>
                            Documentation
                        </a></li> --}}
                </ul>
            </nav>
        </div>
        <!-- End Content -->
    </div>
</div>
<!-- End Sidebar -->
