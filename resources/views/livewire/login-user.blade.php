<div class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="bg-gray-800 text-white rounded-xl shadow-lg p-10 w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-center"> Sing In </h2>

        @error('login')
        <!-- timeout with alpine js-->
        <div id="login-error" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="flex items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
            role="alert">
            <!-- Icona -->
            <svg class="fill-current w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M10 0C4.477 0 0 4.477 0 10s4.477 10 10 10 10-4.477 10-10S15.523 0 10 0zm1 15H9v-2h2v2zm0-4H9V5h2v6z" />
            </svg>
            <span class="block sm:inline">{{ $message }}</span>
        </div>
        @enderror

        <form class="space-y-6" wire:submit='login'>
            <!-- Email -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="mario@example.com" wire:model='email'>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block mb-2 text-sm font-medium">Password</label>
                <input type="password" name="password" id="password" required minlength="8"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="********" wire:model='password'>
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 transition-colors duration-300 text-white font-semibold py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Sing in
                </button>
            </div>
        </form>

        <p class="mt-6 text-center text-gray-400 text-sm">
            You don't have an account?
            <a href="{{ route('register') }}" class="text-indigo-500 hover:underline">Sing Up</a>
        </p>
    </div>
</div>