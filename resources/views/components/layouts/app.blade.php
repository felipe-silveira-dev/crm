<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/robsontenorio/mary@0.44.2/libs/currency/currency.js"></script>
</head>

<body class="min-h-screen font-sans antialiased bg-black">
    <x-toast />
    @if (session()->has('impersonate'))
        <livewire:admin.users.stop-impersonate />
    @endif

    @if (!app()->environment('production'))
        <x-devbar  />
    @endif

    <x-main full-width>
        <x-slot:sidebar drawer="main-drawer" class="collapsible" class="bg-black">

            <!-- Hidden when collapsed -->
            <div class="ml-3 text-4xl font-black hidden-when-collapsed flex flex-col border-b border-zinc-950/5 p-4 dark:border-white/5">
                <div class="relative font-mono">
                    Silveira
                </div>
            </div>

            <!-- Display when collapsed -->
            <div class="ml-3 text-4xl font-black display-when-collapsed">
                <div class="relative font-mono">
                    Silveira
                </div>
            </div>

            <x-menu activate-by-route>

                {{-- Admin --}}
                @can(\App\Enums\Can::BE_AN_ADMIN->value)
                    <x-menu-sub title="Admin" icon="o-lock-closed">
                        <x-menu-item title="{{__('Dashboard')}}" icon="o-chart-bar-square" link="{{ route('admin.dashboard') }}" route="admin.dashboard"  />
                        <x-menu-item title="{{__('Users')}}" icon="o-users" link="{{ route('admin.users') }}" route="admin.users"  />
                        <x-menu-item title="{{__('Categories')}}" icon="o-folder" link="{{ route('admin.categories') }}" route="admin.categories"  />
                    </x-menu-sub>
                @endcan

                {{--  --}}
                <x-menu-item title="{{__('Board')}}" icon="o-chart-bar-square" link="{{route('dashboard')}}" route="dashboard" />
                <x-menu-item title="{{__('Customers')}}" icon="o-building-storefront" link="{{route('customers')}}" route="customers" />
                <x-menu-item title="{{__('Opportunities')}}" icon="o-currency-dollar" link="{{route('opportunities')}}" route="opportunities" />
                <x-menu-item title="{{__('Products')}}" icon="o-archive-box" link="{{route('products')}}" route="products" />
                <x-menu-item title="{{__('Webhooks')}}" icon="o-share" link="{{route('webhooks')}}" route="webhooks" />

                <!-- User -->
                @if ($user = auth()->user())
                    <x-list-item :item="$user" sub-value="username" no-separator no-hover>
                        <x-slot:actions>
                            <div class="tooltip tooltip-left" data-tip="{{__('edit')}}">
                                <x-button
                                    icon="o-pencil"
                                    class="btn-circle btn-ghost btn-xs"
                                    @click="$dispatch('user::update', { userId: {{ $user->id }} })"
                                />
                            </div>
                            <div class="tooltip tooltip-left" data-tip="{{__('logoff')}}">
                                <x-button
                                    icon="o-power"
                                    class="btn-circle btn-ghost btn-xs"
                                    wire:click="logout"
                                    @click="$dispatch('logout')"
                                />
                            </div>
                        </x-slot:actions>
                    </x-list-item>
                @endif

            </x-menu-item>
        </x-slot:sidebar>

        <!-- The `$slot` goes here -->
        <x-slot:content class="bg-zinc-900 rounded-xl border border-zinc-800">
            {{ $slot }}
        </x-slot:content>
    </x-main>
    <livewire:auth.logout>
    <livewire:auth.update>
</body>

</html>
