<div class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="bg-gray-800 text-white rounded-xl shadow-2xl p-10 w-full max-w-md">

        <!-- Titolo -->
        <h2 class="text-3xl font-bold mb-6 text-center text-indigo-400">Sign In</h2>

        <!-- Alert login -->
        @error('login')
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="flex items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 shadow-md"
            role="alert">
            <!-- Icona -->
            <svg class="fill-current w-5 h-5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M10 0C4.477 0 0 4.477 0 10s4.477 10 10 10 10-4.477 10-10S15.523 0 10 0zm1 15H9v-2h2v2zm0-4H9V5h2v6z" />
            </svg>
            <span class="block sm:inline">{{ $message }}</span>
        </div>
        @enderror

        <!-- Form -->
        <form class="space-y-5" wire:submit.prevent='login'>

            <!-- Email -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-300">Email</label>
                <input type="email" id="email" wire:model='email' required placeholder="mario@example.com"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-300">Password</label>
                <input type="password" id="password" wire:model='password' required minlength="8" placeholder="********"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center text-gray-400">
                <input type="checkbox" id="remember" wire:model="remember" class="mr-2">
                <label for="remember" class="text-sm">Remember Me</label>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="cursor-pointer w-full bg-indigo-600 hover:bg-indigo-700 transition-colors duration-300 text-white font-semibold py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Sign In
            </button>
        </form>

        <!-- Links -->
        <div class="mt-6 flex flex-col items-center gap-2 text-sm text-gray-400">

            <a href="{{ route('forgot.password') }}" class="text-indigo-500 hover:underline">Forgotten
                password?</a>

            <span class="text-gray-400">or</span>

            <a href="{{ route('register') }}" class="text-indigo-500 hover:underline font-semibold">Sign Up</a>
        </div>
    </div>
</div>