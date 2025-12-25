<x-layouts.app :title="__('Dashboard')">

    <div class="min-h-screen flex flex-col bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800">

        {{-- NavBar --}}
        <header>
            @livewire('dashboard.nav-bar')
        </header>

        {{-- Modal for edit profile --}}
        @livewire("dashboard.edit-profile-modal")

        {{-- Main --}}


        <main class="flex-1 flex overflow-hidden">
            <div class="w-full px-6 py-6 flex gap-6">

                {{-- Left column: Ai Agent --}}
                <section class="flex-1 flex flex-col">
                    <div class="backdrop-blur-md rounded-xl p-6 h-full overflow-y-auto shadow-xl">
                        <h2 class="text-xl font-semibold text-white mb-4 italic text-center">Financial Documents</h2>
                        @livewire("dashboard.document.document-section")
                    </div>
                </section>

                {{-- Right column: financial documents --}}
                <section class="w-1/3 flex flex-col">
                    <div class="backdrop-blur-md rounded-xl p-6 h-full overflow-y-auto shadow-xl">
                        <h2 class="text-xl font-semibold text-white mb-4 italic text-center">Chat with AI</h2>

                    </div>
                </section>
            </div>
        </main>

        {{-- - Footer --}}
    </div>
</x-layouts.app>