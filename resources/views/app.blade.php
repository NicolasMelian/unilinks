<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="canonical" href="{{ url()->current() }}">

        <link rel="icon" type="image/png" href="{{ asset('icon.svg') }}" alt="Logo de Unilinks">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @if (!request()->routeIs('landing.show'))

        <div class="max-w-4xl mx-auto navbar bg-base-100">
            <div class="flex-1">
              <a href="/" class="flex justify-center items-center"><img class="h-9 w-9 mr-1" src="/icon.png" /><h1 class="text-xl font-bold text-black">Unilinks.bio</h1></a>
            </div>
            <div class="flex-none">
              <ul class="menu menu-horizontal px-1">
                @guest
                  <li><a href="/register">Register</a></li>
                  <li><a href="/login">Login</a></li>
                @endguest
                @auth
                  <li><a href="/links">Links</a></li>
                  <li><a href="/appearance">Appearance</a></li>
                @endauth
              </ul>
            </div>
          </div>
          @endif
          
        @inertia
    </body>
</html>
