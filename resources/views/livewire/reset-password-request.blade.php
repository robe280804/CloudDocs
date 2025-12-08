<div
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 p-4">
    <div
        class="backdrop-blur-xl bg-white/10 border border-white/10 text-white rounded-2xl shadow-2xl p-10 w-full max-w-md">
        {{-- Title --}}
        <h2
            class="text-4xl font-extrabold mb-8 text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-slate-200 drop-shadow-lg tracking-wide">
            Sing in to <span class="text-blue-300">Cloud Docs</span>
        </h2>
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
            @csrf

            <!-- Email -->
            <div class="space-y-1">
                <flux:field>
                    <flux:label>
                        <span class="font-semibold text-blue-400">Email</span>
                    </flux:label>
                    <flux:input wire:model="email" type="email" placeholder="Insert your email" class="text-white" />
                    <flux:error name="email" />
                </flux:field>
            </div>

            <!-- Submit Button -->
            <div>
                <flux:button variant="primary" color="blue" type="submit"
                    class="cursor-pointer w-full py-3 rounded-xl font-semibold shadow-lg shadow-blue-600/40">
                    Send email
                </flux:button>
            </div>
        </form>
    </div>
</div>