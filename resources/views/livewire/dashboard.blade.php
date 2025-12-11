<x-layouts.app :title="__('Dashboard')">

    <div class="min-h-screen flex flex-col bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800">

        {{-- NavBar --}}
        <header>
            @livewire('dashboard.nav-bar')
        </header>

        {{-- Main --}}

        {{-- - Footer --}}
    </div>
</x-layouts.app>