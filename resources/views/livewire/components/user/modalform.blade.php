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
                        <h3 class="text-lg font-semibold">{{ $update_data ? 'Edit' : 'Tambah' }} User
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



                        {{-- Komponen Input Name --}}
                        <div class="w-full mt-4">
                            <label for="input-label-with-helper-phone"
                                class="block text-sm font-medium mb-2 dark:text-white">Nama</label>
                            <input type="text" wire:model="name" name="name" id="input-label-with-helper-phone"
                                class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="John Doe" aria-describedby="hs-input-helper-text" required>
                            @error('name')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- END: Komponen Input Name --}}

                        {{-- Komponen Input EMail --}}
                        <div class="w-full mt-4">
                            <label for="input-label-with-helper-total"
                                class="block text-sm font-medium mb-2 dark:text-white">Email</label>
                            <input type="text" wire:model="email" name="email" id="input-label-with-helper-total"
                                class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 "
                                placeholder="johndoe@gmail.com" aria-describedby="hs-input-helper-text">
                            @error('email')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- END: Komponen Input Email --}}
                        {{-- Komponen Input Password --}}
                        <div class="w-full mt-4">
                            <label for="password" class="block text-sm mb-2 dark:text-white">Password</label>
                            <div class="relative">
                                <input type="password" wire:model="password" id="password" name="password"
                                    value="{{ old('password') }}"
                                    class="py-2.5 sm:py-3 px-4 pe-11 block w-full border-gray-200 rounded-lg sm:text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('password') border-red-500 @enderror""
                                    {{ $update_data ? '' : 'required' }}
                                    placeholder="{{ $update_data ? '[Biarkan kosong bila tidak ingin merubah password]' : '********' }}">

                                <div class="hs-tooltip absolute inset-y-0 end-0 flex items-center cursor-pointer z-20 pe-4 "
                                    id="toggle-password">
                                    <div class="hs-tooltip-toggle" id="hs-password-tooptip">
                                        <svg id="passwordshow"
                                            class="hidden shrink-0 size-6 text-gray-800  dark:text-neutral-500"
                                            xmlns="http://www.w3.org/2000/svg" width="576" height="512"
                                            viewBox="0 0 576 512">
                                            <path fill="currentColor"
                                                d="M288 144a111 111 0 0 0-31.24 5a55.4 55.4 0 0 1 7.24 27a56 56 0 0 1-56 56a55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144m284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19M288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400" />
                                        </svg>
                                        <svg id="passwordhide"
                                            class="shrink-0 size-6 text-gray-800  dark:text-neutral-500"
                                            xmlns="http://www.w3.org/2000/svg" width="512" height="512"
                                            viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M432 448a15.92 15.92 0 0 1-11.31-4.69l-352-352a16 16 0 0 1 22.62-22.62l352 352A16 16 0 0 1 432 448M248 315.85l-51.79-51.79a2 2 0 0 0-3.39 1.69a64.11 64.11 0 0 0 53.49 53.49a2 2 0 0 0 1.69-3.39m16-119.7L315.87 248a2 2 0 0 0 3.4-1.69a64.13 64.13 0 0 0-53.55-53.55a2 2 0 0 0-1.72 3.39" />
                                            <path fill="currentColor"
                                                d="M491 273.36a32.2 32.2 0 0 0-.1-34.76c-26.46-40.92-60.79-75.68-99.27-100.53C349 110.55 302 96 255.68 96a226.5 226.5 0 0 0-71.82 11.79a4 4 0 0 0-1.56 6.63l47.24 47.24a4 4 0 0 0 3.82 1.05a96 96 0 0 1 116 116a4 4 0 0 0 1.05 3.81l67.95 68a4 4 0 0 0 5.4.24a343.8 343.8 0 0 0 67.24-77.4M256 352a96 96 0 0 1-93.3-118.63a4 4 0 0 0-1.05-3.81l-66.84-66.87a4 4 0 0 0-5.41-.23c-24.39 20.81-47 46.13-67.67 75.72a31.92 31.92 0 0 0-.64 35.54c26.41 41.33 60.39 76.14 98.28 100.65C162.06 402 207.92 416 255.68 416a238.2 238.2 0 0 0 72.64-11.55a4 4 0 0 0 1.61-6.64l-47.47-47.46a4 4 0 0 0-3.81-1.05A96 96 0 0 1 256 352" />
                                        </svg>
                                        <span
                                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-2xs dark:bg-neutral-700"
                                            role="tooltip" id="tooltip-name">
                                            Show
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <p class=" text-xs text-red-600 mt-2" id="password-error">{{ $message }}</p>
                        @enderror
                        {{-- END: Komponen Input Password --}}

                        <div class="w-full mt-4">
                            <label for="input-label-with-helper-text"
                                class="block text-sm font-medium mb-2 dark:text-white">Level Akses</label>
                            <select wire:model="role"
                                class="py-3 mb-2 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                <option selected="">Pilih Level Akses ...</option>
                                @foreach ($roles as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="w-full mt-4">
                            <label class="block text-sm font-medium mb-2 dark:text-white">Foto Profil</label>
                            @if ($profile_photo)
                                <input type="file" wire:model="profile_photo" name="profile_photo"
                                    id="input-label-with-helper-phone"
                                    class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    aria-describedby="hs-input-helper-text">
                            @else
                                <input type="file" wire:model="newProfilePhoto" name="newProfilePhoto"
                                    id="input-label-with-helper-phone"
                                    class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    aria-describedby="hs-input-helper-text">
                            @endif
                            <div class="flex p-4 justify-center items-center">
                                @if ($newProfilePhoto)
                                    <img width="50" height="50"
                                        src="{{ $newProfilePhoto->temporaryUrl() }}" />
                                @elseif ($profile_photo)
                                    <img width="50" height="50"
                                        src="{{ asset('storage/' . $profile_photo) }}" />
                                @else
                                    <img width="50" height="50"
                                    src="{{ asset('images/default-avatar.png') }}" />
                                @endif
                            </div>

                        </div>

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

{{-- @livewireScripts --}}
<script>
    const showHidePassword = document.getElementById('toggle-password');
    showHidePassword.addEventListener('click', function() {
        const password = document.getElementById('password');
        const type = password.getAttribute('type');
        const tooltipName = document.getElementById('tooltip-name');
        const iconShow = document.getElementById('passwordshow');
        const iconHide = document.getElementById('passwordhide');
        if (type == 'password') {
            password.setAttribute('type', 'text')
            tooltipName.innerHTML = 'hide';
            iconShow.classList.remove('hidden');
            iconHide.classList.add('hidden');
        } else {
            password.setAttribute('type', 'password')
            tooltipName.innerHTML = 'show';
            iconShow.classList.add('hidden');
            iconHide.classList.remove('hidden');
        }
    })
</script>
