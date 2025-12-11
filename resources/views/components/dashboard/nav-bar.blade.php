<div class="navbar-wrapper">
    <div class="logo">CloudDocs</div>
    <flux:navbar>
        <flux:navbar.item href="#" icon="home" class="item">Home</flux:navbar.item>
        <flux:navbar.item href="#" icon="puzzle-piece" class="item">Features</flux:navbar.item>
        <flux:navbar.item href="#" icon="currency-dollar" class="item">Pricing</flux:navbar.item>
        <!--<flux:navlist.item href="#" icon="user" class="item">Profile</flux:navlist.item>-->
        <flux:dropdown position="bottom" align="end">
            <flux:profile avatar="{{ asset('build/assets/default_user.jpg') }}" class="item" />
            <flux:navmenu>
                <flux:navmenu.item href="#" icon="credit-card"
                    x-on:click="Livewire.dispatch('open-edit-profile-modal', { arguments: {user_id: {{ $user->id }} }})">
                    Edit
                    profile
                </flux:navmenu.item>
                <flux:navmenu.item href="#" icon="arrow-right-start-on-rectangle" wire:click='logout'>Logout
                </flux:navmenu.item>
                <flux:navmenu.item href="#" icon="trash" variant="danger" wire:click='deleteAccount'>Delete
                </flux:navmenu.item>
            </flux:navmenu>
        </flux:dropdown>
    </flux:navbar>
</div>