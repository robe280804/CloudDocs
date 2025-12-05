<div class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="bg-gray-800 text-white rounded-xl shadow-lg p-10 w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-center text-indigo-400"> Reset your password </h2>

        <!-- Error server side -->
        @error('reset-password')
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="flex items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 shadow-md"
            role="alert">
            <svg class="fill-current w-5 h-5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M10 0C4.477 0 0 4.477 0 10s4.477 10 10 10 10-4.477 10-10S15.523 0 10 0zm1 15H9v-2h2v2zm0-4H9V5h2v6z" />
            </svg>
            <span class="block sm:inline">{{ $message }}</span>
        </div>
        @enderror

        <!-- Success message -->
        @if ($successMessage)
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="flex items-center bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 shadow-md"
            role="alert">
            <svg class="fill-current w-5 h-5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M10 0C4.477 0 0 4.477 0 10s4.477 10 10 10 10-4.477 10-10S15.523 0 10 0zm-1 14l-4-4 1.414-1.414L9 11.172l4.586-4.586L15 8l-6 6z" />
            </svg>
            <span class="block sm:inline">{{ $successMessage }}</span>
        </div>
        @endif

        <!-- Form for email -->
        <form class="space-y-6" wire:submit='resetPasswordRequest'>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="mario@example.com" wire:model='email'>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit -->
            <button type="submit"
                class="cursor-pointer w-full bg-indigo-600 hover:bg-indigo-700 transition-colors duration-300 text-white font-semibold py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Sign In
            </button>
        </form>
    </div>
</div>