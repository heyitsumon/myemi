<nav class="bg-base-100 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Left: Brand / Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-primary">Emi-System</a>
            </div>

            <!-- Center: Desktop Links -->
            <div class="hidden md:flex space-x-4">
                <a wire:navigate href="{{ route('dashboard') }}" class="btn btn-ghost btn-sm">Dashboard</a>
                <a wire:navigate href="{{ route('customers.index') }}" class="btn btn-ghost btn-sm">Customers</a>
                <a wire:navigate href="{{ route('locations.index') }}" class="btn btn-ghost btn-sm">Locations</a>
                <a href="{{ route('purchases.index') }}" class="btn btn-ghost btn-sm">Purchases</a>
                <a wire:navigate href="{{ route('products.index') }}" class="btn btn-ghost btn-sm">Products</a>
                <a wire:navigate href="{{ route('products.model') }}" class="btn btn-ghost btn-sm">Products Model</a>
                <a wire:navigate href="{{ route('users.index') }}" class="btn btn-ghost btn-sm">Users</a>
                <a wire:navigate href="{{ route('roles.index') }}" class="btn btn-ghost btn-sm">Roles</a>

                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-sm btn-outline">Theme</label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-56">
                        @for ($i = 1; $i <= 12; $i++)
                            <li>
                                <button type="button" class="btn btn-ghost justify-start theme-selector"
                                        data-theme="theme-{{ $i }}">
                                    <span class="w-4 h-4 rounded-full mr-2"
                                          style="background: var(--theme-{{ $i }});"></span>
                                    Theme {{ $i }}
                                </button>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>


            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="btn btn-square btn-ghost">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu-content" class="hidden md:hidden">
        <ul class="menu p-2 bg-base-100 space-y-1">
            <li><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a wire:navigate href="{{ route('customers.index') }}">Customers</a></li>
            <li><a wire:navigate href="{{ route('locations.index') }}">Locations</a></li>
            <li><a href="{{ route('purchases.index') }}">Purchases</a></li>
            <li><a wire:navigate href="{{ route('products.index') }}">Products</a></li>
            <li><a wire:navigate href="{{ route('products.model') }}">Products Model</a></li>
            <li><a wire:navigate href="{{ route('users.index') }}">Users</a></li>
            <li><a wire:navigate href="{{ route('roles.index') }}">Roles</a></li>
            <li class="border-t border-base-200 mt-2 pt-2">
                <span class="text-base-content text-sm font-semibold">Theme</span>
            </li>
            @for ($i = 1; $i <= 12; $i++)
                <li>
                    <button type="button" class="btn btn-ghost justify-start theme-selector w-full"
                            data-theme="theme-{{ $i }}">
                        <span class="w-4 h-4 rounded-full mr-2"
                              style="background: var(--theme-{{ $i }});"></span>
                        Theme {{ $i }}
                    </button>
                </li>
            @endfor
        </ul>
    </div>
</nav>

<script>
    if (!window.__navbarMenuInitialized) {
        window.__navbarMenuInitialized = true;

        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenuContent = document.getElementById('mobile-menu-content');

        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenuContent.classList.toggle('hidden');
            });
        }
    }
</script>
