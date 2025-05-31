<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>@yield('title') - JerseyVerse</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-100">
    <!-- Header/Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="text-2xl font-bold text-blue-600">JerseyVerse</div>
            <div class="hidden md:flex space-x-8">
                <a href="/" class="{{ request()->is('home','/') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }}">Home</a>
                <a href="/products" class="{{ request()->is('products') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }}">Product</a>
                
                @auth
                @php
                    $cartCount = 0;
                    if(Auth::check()) {
                        $cartCount = \App\Models\CartItem::whereHas('cart', function($q){
                            $q->where('user_id', Auth::id());
                        })->count();
                    }
                @endphp
                <a href="{{ route('cart') }}" class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full px-1">{{ $cartCount }}</span>
                    @endif
                </a>
                @endauth
                
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-purple-600 bg-white hover:text-purple-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('orders.history')">
                                {{ __('Orders') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">
                        {{ __('Login') }}
                    </a>
                @endauth
            </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-10">
        <div class="container mx-auto px-4 text-center">
            &copy; {{ date('Y') }} JerseyVerse. All rights reserved.
        </div>
    </footer>
</body>
</html>