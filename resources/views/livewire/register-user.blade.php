<div
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 p-4">
    <div
        class="backdrop-blur-xl bg-white/10 border border-white/10 text-white rounded-2xl shadow-2xl p-10 w-full max-w-md">
        {{-- Title --}}
        <h2
            class="text-4xl font-extrabold mb-8 text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-slate-200 drop-shadow-lg tracking-wide">
            Create your account
        </h2>

        {{-- Form register --}}
        <form class="space-y-6">
            <!-- Name -->
            <div class="space-y-1">
                <flux:field>
                    <flux:label>
                        <span class="font-semibold text-blue-400">Name</span>
                    </flux:label>
                    <flux:input wire:model="name" type="name" placeholder="Insert your name" class="text-white" />
                    <flux:error name="name" />
                </flux:field>
            </div>

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

            <!-- Password -->
            <div class="space-y-1">
                <flux:field>
                    <flux:label>
                        <span class="font-semibold text-blue-400">Password</span>
                    </flux:label>
                    <flux:input wire:model="password" type="password" placeholder="************" class="text-black">
                        <x-slot name="iconTrailing">
                            <flux:button size="sm" variant="subtle" icon="eye" class="-mr-1" />
                        </x-slot>
                    </flux:input>
                    <flux:error name="password" />
                </flux:field>
            </div>

            <!-- Confirm Password -->
            <div class="space-y-1">
                <flux:field>
                    <flux:label>
                        <span class="font-semibold text-blue-400">Confirm password</span>
                    </flux:label>
                    <flux:input wire:model='password_confirmation' type="password" placeholder="Confirm your password"
                        class="text-black">
                        <x-slot name="iconTrailing">
                            <flux:button size="sm" variant="subtle" icon="eye" class="-mr-1" />
                        </x-slot>
                    </flux:input>
                    <flux:error name="password_confirmation" />
                </flux:field>
            </div>

            <!-- Submit Button -->
            <div>
                <flux:button variant="primary" color="blue" wire:click='register'
                    class="cursor-pointer w-full py-3 rounded-xl font-semibold shadow-lg shadow-blue-600/40">
                    Register
                </flux:button>
            </div>
        </form>

        {{-- Links --}}
        <p class="mt-8 text-center text-gray-300 text-sm">
            Already have an account?
            <a href="{{ route('login') }}"
                class="text-blue-400 hover:text-blue-300 transition underline font-semibold">Sign In</a>
        </p>
    </div>
</div>