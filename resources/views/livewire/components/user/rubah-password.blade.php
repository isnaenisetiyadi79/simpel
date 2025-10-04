<div class="max-w-md mx-auto bg-white rounded-xl shadow-md p-6 mt-8">
    <h2 class="text-lg font-semibold mb-4">Ubah Password</h2>
    @if (session('success'))
        <div class="mt-2 mb-5 bg-teal-100 border border-teal-200 text-sm text-teal-800 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500"
            role="alert" tabindex="-1" aria-labelledby="hs-soft-color-success-label">
            <span id="hs-soft-color-success-label" class="font-bold">Success</span> {{ session('success') }}
        </div>
    @endif
    <form wire:submit.prevent="updatePassword" class="space-y-4">
        <!-- Password Lama -->
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700">Password Lama</label>
            <input type="password" id="current_password" wire:model.defer="current_password"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            @error('current_password')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password Baru -->
        <div>
            <label for="new_password" class="block text-sm font-medium text-gray-700">Password Baru</label>
            <input type="password" id="new_password" wire:model.defer="new_password"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            @error('new_password')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Konfirmasi Password Baru -->
        <div>
            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password
                Baru</label>
            <input type="password" id="new_password_confirmation" wire:model.defer="new_password_confirmation"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:ring focus:ring-blue-300 disabled:opacity-50">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
