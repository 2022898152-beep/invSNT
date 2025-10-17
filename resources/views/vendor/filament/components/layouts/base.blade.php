@props([
    'title' => null,
])

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament::layout.direction') ?? 'ltr' }}"
    class="filament js-focus-visible min-h-screen antialiased"
>
    <head>
        {{ \Filament\Facades\Filament::renderHook('head.start') }}

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @foreach (\Filament\Facades\Filament::getMeta() as $tag)
            {{ $tag }}
        @endforeach

        @if ($favicon = config('filament.favicon'))
            <link rel="icon" href="{{ $favicon }}" />
        @endif

        <title>
            {{ $title ? "{$title} - " : null }} {{ config('filament.brand') }}
        </title>

        {{ \Filament\Facades\Filament::renderHook('styles.start') }}

        <style>
            [x-cloak=''],
            [x-cloak='x-cloak'],
            [x-cloak='1'] {
                display: none !important;
            }

            @media (max-width: 1023px) {
                [x-cloak='-lg'] {
                    display: none !important;
                }
            }

            @media (min-width: 1024px) {
                [x-cloak='lg'] {
                    display: none !important;
                }
            }

            :root {
                --sidebar-width: 280px;
                --collapsed-sidebar-width: 90px;
            }
        </style>

        @livewireStyles

        @if (filled($fontsUrl = config('filament.google_fonts')))
            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link
                rel="preconnect"
                href="https://fonts.gstatic.com"
                crossorigin
            />
            <link href="{{ $fontsUrl }}" rel="stylesheet" />
        @endif

        @foreach (\Filament\Facades\Filament::getStyles() as $name => $path)
            @if (\Illuminate\Support\Str::of($path)->startsWith(['http://', 'https://']))
                <link rel="stylesheet" href="{{ $path }}" />
            @elseif (\Illuminate\Support\Str::of($path)->startsWith('<'))
                {!! $path !!}
            @else
                <link
                    rel="stylesheet"
                    href="{{
                        route('filament.asset', [
                            'file' => "{$name}.css",
                        ])
                    }}"
                />
            @endif
        @endforeach

        {{ \Filament\Facades\Filament::getThemeLink() }}

        {{ \Filament\Facades\Filament::renderHook('styles.end') }}
        
        <!-- Modern UI Theme -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/modern-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('css/modern-login.css') }}">
        <link rel="stylesheet" href="{{ asset('css/modern-dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/modern-sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/modern-tables.css') }}">
        <link rel="stylesheet" href="{{ asset('css/modern-buttons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/modern-header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/hardware-table-fix.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ultra-clean-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <style>
            html, body, .filament-login-page, .filament-body {
                font-family: 'Inter', sans-serif;
            }
            /* Force light mode */
            html.dark {
                color-scheme: light !important;
                background-color: white !important;
            }
        </style>

        <script>
            // Force light mode
            localStorage.setItem('theme', 'light')
            document.documentElement.classList.remove('dark')
        </script>
        
        <script defer src="{{ asset('js/modern-charts.js') }}"></script>
        <script defer src="{{ asset('js/modern-sidebar.js') }}"></script>
        <script defer src="{{ asset('js/sidebar-icon-enhancer.js') }}"></script>
        <script defer src="{{ asset('js/compact-sidebar.js') }}"></script>
        <script defer src="{{ asset('js/layout-fix.js') }}"></script>
        
        {{ \Filament\Facades\Filament::renderHook('head.end') }}
    </head>

    <body
        style="background-color: white !important; background: white !important;"
        class="filament-body min-h-screen overflow-y-auto bg-white text-gray-900"
    >
        {{ \Filament\Facades\Filament::renderHook('body.start') }}

        {{ $slot }}

        {{ \Filament\Facades\Filament::renderHook('scripts.start') }}

        @livewireScripts

        <script>
            window.filamentData = @json(\Filament\Facades\Filament::getScriptData())
        </script>

        @foreach (\Filament\Facades\Filament::getBeforeCoreScripts() as $name => $path)
            @if (\Illuminate\Support\Str::of($path)->startsWith(['http://', 'https://']))
                <script defer src="{{ $path }}"></script>
            @elseif (\Illuminate\Support\Str::of($path)->startsWith('<'))
                {!! $path !!}
            @else
                <script
                    defer
                    src="{{
                        route('filament.asset', [
                            'file' => "{$name}.js",
                        ])
                    }}"
                ></script>
            @endif
        @endforeach

        @stack('beforeCoreScripts')

        <script
            defer
            src="{{
                route('filament.asset', [
                    'id' => Filament\get_asset_id('app.js'),
                    'file' => 'app.js',
                ])
            }}"
        ></script>

        @if (config('filament.broadcasting.echo'))
            <script
                defer
                src="{{
                    route('filament.asset', [
                        'id' => Filament\get_asset_id('echo.js'),
                        'file' => 'echo.js',
                    ])
                }}"
            ></script>

            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    window.Echo = new window.EchoFactory(@js(config('filament.broadcasting.echo')))

                    window.dispatchEvent(new CustomEvent('EchoLoaded'))
                })
            </script>
        @endif

        @foreach (\Filament\Facades\Filament::getScripts() as $name => $path)
            @if (\Illuminate\Support\Str::of($path)->startsWith(['http://', 'https://']))
                <script defer src="{{ $path }}"></script>
            @elseif (\Illuminate\Support\Str::of($path)->startsWith('<'))
                {!! $path !!}
            @else
                <script
                    defer
                    src="{{
                        route('filament.asset', [
                            'file' => "{$name}.js",
                        ])
                    }}"
                ></script>
            @endif
        @endforeach

        @stack('scripts')

        {{ \Filament\Facades\Filament::renderHook('scripts.end') }}

        {{ \Filament\Facades\Filament::renderHook('body.end') }}
    </body>
</html>
