<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>

    <x-nav-link :href="route('resources.index')" :active="request()->routeIs('resources.index')">
        {{ __('Inventory') }}
    </x-nav-link>

    @if(auth()->user()->isAdmin() || auth()->user()->isManager())
        <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
            {{ __('Pending Approvals') }}
        </x-nav-link>
    @else
        <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
            {{ __('My Reservations') }}
        </x-nav-link>
    @endif
</div>