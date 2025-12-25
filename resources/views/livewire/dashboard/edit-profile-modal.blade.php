<flux:modal name="edit-profile-modal">
    <h2
        class="text-4xl font-extrabold mb-8 text-center bg-clip-text text-transparent bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 drop-shadow-lg tracking-wide">
        Edit profile
    </h2>
    <div
        class="backdrop-blur-xl bg-white/10 border border-white/10 text-white rounded-2xl shadow-2xl p-10 w-full max-w-md">

        @if($errors->has('form'))
        <div class="text-red-500 mb-2">{{ $errors->first('form') }}</div>
        @endif

        {{-- Form register --}}
        <form class="space-y-6" wire:submit='edit'>
            @csrf
            <!-- Name -->
            <div class="space-y-1">
                <flux:field>
                    <flux:label>
                        <span class="font-semibold text-blue-400">Name</span>
                    </flux:label>
                    <flux:input wire:model="name" type="name" placeholder="{{ $user->name }}" class="text-white" />
                    <flux:error name="name" />
                </flux:field>
            </div>

            <!-- Email -->
            <div class="space-y-1">
                <flux:field>
                    <flux:label>
                        <span class="font-semibold text-blue-400">Email</span>
                    </flux:label>
                    <flux:input wire:model="email" type="email" placeholder="{{ $user->email }}" class="text-white" />
                    <flux:error name="email" />
                </flux:field>
            </div>

            <flux:button variant="primary" color="blue" type="submit"
                class="cursor-pointer w-full py-3 rounded-xl font-semibold shadow-lg shadow-blue-600/40">
                Send
            </flux:button>
        </form>
    </div>
</flux:modal>