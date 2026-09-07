<nav class="bg-base-100 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-primary">MyAdmin</a>
            </div>

            <!-- Desktop Links -->
            <div class="hidden md:flex space-x-2">
                @if($locations->isNotEmpty())
                    <select wire:model.live="activeLocationId" wire:change="switchLocation($event.target.value)" class="select select-sm select-bordered max-w-48" aria-label="Active shop">
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                @endif
                <a wire:navigate href="{{ route('dashboard') }}" wire:click="$set('currentRoute','dashboard')"
                   class="btn btn-sm {{ $currentRoute == 'dashboard' ? 'bg-primary text-white' : 'btn-ghost' }}">
                        {{ __('ui.dashboard') }}
                </a>

                @can('customer-list')
                    <a wire:navigate href="{{ route('customers.index') }}" wire:click="$set('currentRoute','customers.index')"
                       class="btn btn-sm {{ $currentRoute == 'customers.index' ? 'bg-primary text-white' : 'btn-ghost' }}">
                        {{ __('ui.customers') }}
                    </a>
                @endcan

                @can('location-list')
                    <a wire:navigate href="{{ route('locations.index') }}" wire:click="$set('currentRoute','locations.index')"
                       class="btn btn-sm {{ $currentRoute == 'locations.index' ? 'bg-primary text-white' : 'btn-ghost' }}">
                        {{ __('ui.locations') }}
                    </a>
                @endcan

                @can('product-list')
                    <a wire:navigate href="{{ route('products.index') }}" wire:click="$set('currentRoute','products.index')"
                       class="btn btn-sm {{ $currentRoute == 'products.index' ? 'bg-primary text-white' : 'btn-ghost' }}">
                        {{ __('ui.products') }}
                    </a>
                @endcan

                @can('product-model-list')
                    <a wire:navigate href="{{ route('products.model') }}" wire:click="$set('currentRoute','products.model')"
                       class="btn btn-sm {{ $currentRoute == 'products.model' ? 'bg-primary text-white' : 'btn-ghost' }}">
                        {{ __('ui.product_models') }}
                    </a>
                @endcan

                @can('user-list')
                    <a wire:navigate href="{{ route('users.index') }}" wire:click="$set('currentRoute','users.index')"
                       class="btn btn-sm {{ $currentRoute == 'users.index' ? 'bg-primary text-white' : 'btn-ghost' }}">
                        {{ __('ui.users') }}
                    </a>
                @endcan

                @can('role-list')
                    <a wire:navigate href="{{ route('roles.index') }}" wire:click="$set('currentRoute','roles.index')"
                       class="btn btn-sm {{ $currentRoute == 'roles.index' ? 'bg-primary text-white' : 'btn-ghost' }}">
                        {{ __('ui.roles') }}
                    </a>
                @endcan

                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-sm btn-outline mr-2">{{ __('ui.theme') }}</label>
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

                <select wire:model.live="locale" wire:change="switchLocale($event.target.value)" class="select select-sm select-bordered" aria-label="{{ __('ui.language') }}">
                    <option value="en">{{ __('ui.english') }}</option>
                    <option value="bn">{{ __('ui.bangla') }}</option>
                </select>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="btn btn-square btn-ghost">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu-content" class="hidden md:hidden">
        <ul class="menu p-2 bg-base-100 space-y-1">
            <li>
                <a wire:navigate href="{{ route('dashboard') }}" wire:click="$set('currentRoute','dashboard')"
                   class="{{ $currentRoute == 'dashboard' ? 'bg-primary text-white rounded-lg px-2 py-1' : '' }}">
                   Dashboard
                </a>
            </li>
            @can('customer-list')
                <li>
                    <a wire:navigate href="{{ route('customers.index') }}" wire:click="$set('currentRoute','customers.index')"
                       class="{{ $currentRoute == 'customers.index' ? 'bg-primary text-white rounded-lg px-2 py-1' : '' }}">
                       Customers
                    </a>
                </li>
            @endcan
            @can('location-list')
                <li>
                    <a wire:navigate href="{{ route('locations.index') }}" wire:click="$set('currentRoute','locations.index')"
                       class="{{ $currentRoute == 'locations.index' ? 'bg-primary text-white rounded-lg px-2 py-1' : '' }}">
                       Locations
                    </a>
                </li>
            @endcan
            <li>
                <select wire:model.live="locale" wire:change="switchLocale($event.target.value)" class="select select-bordered w-full" aria-label="{{ __('ui.language') }}">
                    <option value="en">{{ __('ui.english') }}</option>
                    <option value="bn">{{ __('ui.bangla') }}</option>
                </select>
            </li>
            <li class="border-t border-base-200 mt-2 pt-2">
                <span class="text-sm font-semibold">Theme</span>
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
    (function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenuContent = document.getElementById('mobile-menu-content');
        const themeButtons = document.querySelectorAll('.theme-selector');

        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenuContent.classList.toggle('hidden');
            });
        }

        const getContrastColor = hex => {
            const normalized = hex.trim().replace('#', '');
            const r = parseInt(normalized.substring(0, 2), 16);
            const g = parseInt(normalized.substring(2, 4), 16);
            const b = parseInt(normalized.substring(4, 6), 16);
            const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
            return luminance > 0.6 ? '#111827' : '#ffffff';
        };

        const applyPalette = selectedPalette => {
            const value = `var(--${selectedPalette})`;
            const paletteColor = getComputedStyle(document.documentElement).getPropertyValue(`--${selectedPalette}`).trim() || '#2563eb';
            const themeTextColor = getContrastColor(paletteColor);
            document.documentElement.style.setProperty('--theme', value);
            document.documentElement.style.setProperty('--theme-bg', value);
            document.documentElement.style.setProperty('--theme-text', themeTextColor);
            themeButtons.forEach(el => {
                el.classList.toggle('active', el.dataset.theme === selectedPalette);
            });
            localStorage.setItem('site-theme-palette', selectedPalette);
        };

        const initThemeControls = () => {
            themeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    applyPalette(this.dataset.theme);
                });
            });

            const storedPalette = localStorage.getItem('site-theme-palette');
            applyPalette(storedPalette || 'theme-1');
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initThemeControls);
        } else {
            initThemeControls();
        }
    })();
</script>
