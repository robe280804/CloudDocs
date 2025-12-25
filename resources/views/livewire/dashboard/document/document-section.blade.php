<div>
    <div>
        {{-- - btn for add new financial document --}}



        <flux:button onClick="Livewire.dispatch('openModal', { component: 'dashboard.document.create-document' })">
            Add
        </flux:button>



        {{-- Display financial document --}}
        {{-- - Not all, you have the option to display everyone --}}

    </div>
</div>