<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tryout App</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @endif
</head>

<body class="antialiased">
    @hasSection('show_navbar')
        <nav class="bg-blue-600 px-4 py-3 shadow-sm">
            <div class="max-w-screen-xl mx-auto flex items-center justify-between">
                <a href="{{ route('soal.show', 1) }}" class="text-white font-semibold text-xl tracking-wide">
                    Tryout App
                </a>
                <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none hover:cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="hidden md:flex items-center gap-6">
                    @if(session('token'))
                        <div class="text-white">
                            <span class="mr-2">Halo, <strong>{{ session('name') }}</strong></span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            @method('POST')
                            <button type="submit"
                                class="text-white hover:bg-blue-500 hover:rounded-md px-3 py-1 transition duration-150 ease-in-out">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-blue-200 transition font-medium">Login</a>
                        <a href="{{ route('register') }}"
                            class="text-white hover:text-blue-200 transition font-medium">Register</a>
                    @endif
                </div>
            </div>
            <div id="mobile-menu" class="hidden md:hidden mt-2 space-y-1">
                @if(session('token'))
                    <div class="px-4 text-white">Halo, <strong>{{ session('name') }}</strong></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        @method('POST')
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-white hover:bg-blue-500 transition rounded-md">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 text-white hover:bg-blue-500 transition rounded-md">Login</a>
                    <a href="{{ route('register') }}"
                        class="block px-4 py-2 text-white hover:bg-blue-500 transition rounded-md">Register</a>
                @endif
            </div>
        </nav>
    @endif
    <main>
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="{{ asset('js/soal.js') }}"></script>
    <div id="alert-message" data-type="{{ session('success') ? 'success' : (session('error') ? 'error' : '') }}"
        data-message="{{ session('success') ?? session('error') ?? '' }}">
    </div>
    @vite(['resources/js/app.js'])
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>