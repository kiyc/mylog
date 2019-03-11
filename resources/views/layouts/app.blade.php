<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <v-app id="app">
        <v-toolbar fixed>
            <v-toolbar-title class="header-title">
                <router-link to="/home">{{ config('app.name') }}</router-link>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="align-center">
                @guest
                    <v-btn flat href="/register">
                        {{ __('Register') }}
                    </v-btn>
                @else
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <v-btn flat href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </v-btn>
                @endguest
            </v-toolbar-items>
        </v-toolbar>

        <v-content style="margin-top:64px">
            <v-container fluid>
                @guest
                    @yield('content')
                @else
                    <router-view></router-view>
                @endguest
            </v-container>
        </v-content>
        <v-footer app>
            <v-layout justify-center>
                <span>&copy; {{ date('Y') }} {{ config('app.name') }}</span>
            </v-layout>
        </v-footer>
    </v-app>

    <!-- Scripts -->
    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
