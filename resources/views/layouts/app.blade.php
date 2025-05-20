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
    @unless(request()->is('login', 'register') || !session()->has('token'))
        <nav class="bg-indigo-600 border-gray-200 shadow-sm">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="/home" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Tryout App</span>
                </a>
                <button id="mobile-menu-button" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Toggle main menu</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="hidden w-full md:flex md:w-auto md:items-center md:justify-end" id="desktop-menu">
                    <ul
                        class="flex flex-col md:flex-row items-center font-medium mt-4 md:mt-0 space-y-2 md:space-y-0 md:space-x-6">
                        @if(session('token'))
                            <li class="text-white">Halo, <strong>{{ session('name') }}</strong></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                        class="text-white hover:bg-blue-500 hover:rounded-md px-3 py-1 transition">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="hidden md:hidden px-4 pb-4" id="mobile-menu">
                <ul class="space-y-2">
                    @if(session('token'))
                        <li class="text-white">Halo, <strong>{{ session('name') }}</strong></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                @method('POST')
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-white hover:bg-blue-500 transition rounded-md">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    @endunless
    <main>
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="{{ asset('js/soal.js') }}"></script>
    <div id="alert-message" data-type="{{ session('success') ? 'success' : (session('error') ? 'error' : '') }}"
        data-message="{{ session('success') ?? session('error') ?? '' }}">
    </div>
    @vite(['resources/js/app.js'])
</body>

</html>