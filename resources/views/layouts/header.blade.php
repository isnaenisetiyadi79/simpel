 <!-- ========== HEADER ========== -->
 <header
     class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-48 w-full bg-white border-b border-gray-200 text-sm py-2.5 lg:ps-65 dark:bg-neutral-800 dark:border-neutral-700">
     <nav class="px-4 sm:px-6 flex basis-full items-center w-full mx-auto">
         <div class="me-5 lg:me-0 lg:hidden flex items-center">
             <div class="pr-6 pt-0 flex items-center">
                 <!-- Logo -->
                 <a class="flex-none rounded-xl text-xl inline-block font-semibold focus:outline-hidden focus:opacity-80"
                     href="{{ route('dashboard') }}" aria-label="Preline">

                     <div class="flex items-center p-0 m-0">
                         <div class="p-0 m-0">
                             <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 48 48">
                                 <path fill="#06ac75"
                                     d="M11 7.75a.75.75 0 0 0-1.5 0v9a1.25 1.25 0 1 1-2.5 0v-7.5a.75.75 0 0 0-1.5 0v10.574c0 .79.163 1.57.478 2.295l1.36 3.127a3.75 3.75 0 0 0 3.44 2.254h3.04c1.427 0 2.803-.858 3.73-2.214c2.668-3.904 6.158-6.306 7.852-7.323c-.274-.451-.64-.841-1.092-.996c-.461-.157-1.46-.211-3.271 1.255A1.25 1.25 0 0 1 19 17.25v-9.5a.75.75 0 0 0-1.5 0v7.5a1.25 1.25 0 1 1-2.5 0v-9a.75.75 0 0 0-1.5 0v9a1.25 1.25 0 1 1-2.5 0zm10.5 7.21c1.33-.63 2.538-.727 3.617-.358c1.512.517 2.328 1.816 2.702 2.581c.567 1.16-.076 2.306-.912 2.793c-1.424.83-4.785 3.049-7.296 6.72C18.349 28.547 16.276 30 13.82 30h-3.042a6.25 6.25 0 0 1-5.73-3.756l-1.362-3.128A8.25 8.25 0 0 1 3 19.824V9.25a3.25 3.25 0 0 1 4.39-3.045a3.25 3.25 0 0 1 4-1.5a3.25 3.25 0 0 1 5.72 0A3.25 3.25 0 0 1 21.5 7.75zm-6.38 16.937C16.051 39.286 22.358 45 30 45c8.285 0 15-6.716 15-15s-6.715-15-15-15q-.578 0-1.145.043c.355.482.601.935.761 1.262c.198.404.321.805.382 1.195H30c6.904 0 12.5 5.596 12.5 12.5S36.904 42.5 30 42.5c-6.529 0-11.889-5.006-12.451-11.389a8.4 8.4 0 0 1-2.43.786m7.698 1.305a1.25 1.25 0 0 1 1.73.366A6.47 6.47 0 0 0 30 36.5a6.47 6.47 0 0 0 5.452-2.932a1.25 1.25 0 1 1 2.096 1.364A8.97 8.97 0 0 1 30 39a8.97 8.97 0 0 1-7.548-4.068a1.25 1.25 0 0 1 .366-1.73M34 29a2 2 0 1 0 0-4a2 2 0 0 0 0 4m-6-2a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                             </svg>
                         </div>
                         <div class="leading p-0 m-0">
                             <div class="m-0 pt-0 -mb-2">
                                 <span
                                     class="font-extrabold text-green-600 pl-3 italic text-2xl tracking-widest">Sim</span>
                                 <span
                                     class="font-extrabold text-orange-400 pr-3 italic text-2xl tracking-widest">Pel</span>

                             </div>
                             <div class="m-0 pt-0 -mt-4">
                                 <span
                                     class="pl-3 font-medium text-orange-400 pr-3 italic text-sm tracking-widest">{{ $toko->name ?? 'Nama Toko' }}</span>
                             </div>
                         </div>

                     </div>
                 </a>
                 <!-- End Logo -->
             </div>
         </div>

         <div class="w-full flex items-center justify-end ms-auto md:justify-between gap-x-1 md:gap-x-3">

             <div class="hidden md:block">

             </div>

             <div class="flex flex-row items-center justify-end gap-1">
                 {{-- <button type="button"
                     class="md:hidden size-9.5 relative inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                     <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                         <circle cx="11" cy="11" r="8" />
                         <path d="m21 21-4.3-4.3" />
                     </svg>
                     <span class="sr-only">Search</span>
                 </button> --}}


                 <button type="button"
                     class="size-9.5 relative inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">

                     <span class="sr-only">Activity</span>
                 </button>

                 <!-- Dropdown -->
                 <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">

                     <button id="hs-dropdown-account" type="button"
                         class="size-9.5 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none dark:text-white"
                         aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                         <img class="shrink-0 size-9.5 rounded-full"
                             src="{{ Auth::user()->profile_photo_url}}"
                             alt="Avatar">
                     </button>

                     <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                         role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-account">
                         <div class="py-3 px-5 bg-gray-100 rounded-t-lg dark:bg-neutral-700">
                             <p class="text-sm text-gray-500 dark:text-neutral-500">Login Sebagai</p>
                             <p class="text-sm font-medium text-gray-800 dark:text-neutral-200 capitalize">
                                 {{ auth()->user()->name }}
                                 {{-- {{auth()->user()->roles->first()->name}} --}}
                             </p>
                         </div>
                         <div class="p-1.5 space-y-0.5">

                             <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                 href="{{ route('logout.auth') }}">
                                 <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24">
                                     <path fill="currentColor"
                                         d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z" />
                                 </svg>
                                 Logout
                             </a>
                         </div>
                     </div>
                 </div>
                 <!-- End Dropdown -->
             </div>
         </div>
     </nav>
 </header>
 <!-- ========== END HEADER ========== -->

 <!-- ========== MAIN CONTENT ========== -->
 <!-- Breadcrumb -->
 <div
     class="sticky top-0 inset-x-0 z-20 bg-white border-y border-gray-200 px-4 sm:px-6 lg:px-8 lg:hidden dark:bg-neutral-800 dark:border-neutral-700">
     <div class="flex items-center py-2">
         <!-- Navigation Toggle -->
         <button type="button"
             class="size-8 flex justify-center items-center gap-x-2 border border-gray-200 text-gray-800 hover:text-gray-500 rounded-lg focus:outline-hidden focus:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
             aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-application-sidebar"
             aria-label="Toggle navigation" data-hs-overlay="#hs-application-sidebar">
             <span class="sr-only">Toggle Navigation</span>
             <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round">
                 <rect width="18" height="18" x="3" y="3" rx="2" />
                 <path d="M15 3v18" />
                 <path d="m8 9 3 3-3 3" />
             </svg>
         </button>
         <!-- End Navigation Toggle -->

         {{-- <!-- Breadcrumb -->
            <ol class="ms-3 flex items-center whitespace-nowrap">
                <li class="flex items-center text-sm text-gray-800 dark:text-neutral-400">
                    Application Layout
                    <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500"
                        width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </li>
                <li class="text-sm font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
                    Dashboard
                </li>
            </ol>
            <!-- End Breadcrumb --> --}}
     </div>
 </div>
 <!-- End Breadcrumb -->
