<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    {{-- Chart.js  --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
</head>
<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">
{{-- The navbar with `sticky` and `full-width` --}}
<x-mary-nav sticky full-width>

    <x-slot:brand>
        {{-- Drawer toggle for "main-drawer" --}}
        <label for="main-drawer" class="lg:hidden mr-3">
            <x-mary-icon name="o-bars-3" class="cursor-pointer" />
        </label>

        {{-- Brand --}}
        <div>Bank Piastowski - plan handlowy</div>
    </x-slot:brand>

    {{-- Right side actions --}}
    <x-slot:actions>
{{--        <x-mary-button label="Messages" icon="o-envelope" link="###" class="btn-ghost btn-sm" responsive />--}}
{{--        <x-mary-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive />--}}
    </x-slot:actions>
</x-mary-nav>
{{-- The main content with `full-width` --}}
<x-mary-main with-nav full-width>

    {{-- This is a sidebar that works also as a drawer on small screens --}}
    {{-- Notice the `main-drawer` reference here --}}
    <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">

        {{-- User --}}
        @if($user = auth()->user())
            <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="pt-2">
                <x-slot:actions>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate link="{{ route('logout') }}"
                                       @click.prevent="$root.submit();"
                        />
                    </form>
                </x-slot:actions>
            </x-mary-list-item>

            <x-mary-menu-separator />
        @endif

        {{-- Activates the menu item when a route matches the `link` property --}}
        <x-mary-menu activate-by-route>
            @hasanyrole(['manager', 'super-manager'])
                <x-mary-menu-item title="{{__('main.main')}}" icon="o-home" link="{{route('manager:index')}}" />
            @endrole
            @hasanyrole('employee')
                <x-mary-menu-item title="{{__('main.main')}}" icon="o-home" link="{{route('employee:index')}}" />
            @endrole
            <x-mary-menu-item title="{{__('main.calculator')}}" icon="o-calculator" link="{{route('calculator')}}" />
            <x-mary-menu-item title="{{__('sale.sale')}}" icon="o-presentation-chart-line" link="{{ route('sale.index')}}" />
            <x-mary-menu-item title="{{__('main.calendar')}}" icon="o-calendar" link="{{ route('calendar')}}" />
            <x-mary-menu-item title="{{__('main.campaigns')}}" icon="o-list-bullet" link="{{ route('campaigns')}}" />
{{--            <x-mary-menu-item title="Messages" icon="o-envelope" link="###" />--}}
{{--            <x-mary-menu-sub title="Settings" icon="o-cog-6-tooth">--}}
{{--                <x-mary-menu-item title="Wifi" icon="o-wifi" link="####" />--}}
{{--                <x-mary-menu-item title="Archives" icon="o-archive-box" link="####" />--}}
{{--            </x-mary-menu-sub>--}}
            @hasanyrole('admin')
            <x-mary-menu-sub title="Admin" icon="o-cog-6-tooth">
                <x-mary-menu-item title="{{__('main.users')}}" icon="o-users" link="{{ route('admin:users.index') }}" />
                <x-mary-menu-item title="Archives" icon="o-archive-box" link="####" />
            </x-mary-menu-sub>
            @endrole
            @hasanyrole(['manager', 'admin', 'super-manager'])
            <x-mary-menu-sub title="Manager" icon="o-cog-6-tooth">
                <x-mary-menu-item title="{{__('main.users')}}" icon="o-users" link="{{ route('manager:users.index') }}" />
                <x-mary-menu-item title="Plan-doradcy" icon="o-archive-box" link="{{ route('manager:plan.index') }}" />
                @hasanyrole(['admin', 'super-manager'])
                <x-mary-menu-item title="Plan-oddziały" icon="o-archive-box" link="{{ route('supermanager:department.plan') }}" />
                @endrole
            </x-mary-menu-sub>
            @endrole
            @hasrole('employee')
            <x-mary-menu-item title="{{ __('sale.new_sale') }}" icon="s-plus" link="/new-sale" />
            @endrole
        </x-mary-menu>
    </x-slot:sidebar>

    {{-- The `$slot` goes here --}}
    <x-slot:content>
        {{ $slot }}
    </x-slot:content>
</x-mary-main>

{{--  TOAST area --}}
<x-mary-toast />
@livewireScripts
</body>
</html>
