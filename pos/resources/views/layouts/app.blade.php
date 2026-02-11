<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ICEBOX CAFE') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    
    @livewireStyles
    @livewireChartsScripts
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="">
                <i class="fas fa-dice-d6 fa-lg ml-1 mr-2"></i> ICEBOX CAFE
                </a>
                @auth
                @if (auth()->user()->level == "admin")
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Home
                </a>
                
                <div class="dropdown navbar-brand dropdown-toggle">
                    <a  id="product" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Inventory
                    </a>
                    <div class="dropdown-menu" aria-labelledby="product">
                        <a class="dropdown-item" href="{{ url('/products') }}"><i class="fas fa-hamburger fa-lg"></i>  Product List</a>
                        <a class="dropdown-item" href="{{ url('/Category') }}"><i class="fas fa-book fa-lg"></i>   Category</a>
                    </div>
                </div>
                @endif
                <div class="dropdown navbar-brand dropdown-toggle">
                    <a  id="pos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Point Of Sales
                    </a>
                    <div class="dropdown-menu" aria-labelledby="pos">
                        <a class="dropdown-item" href="{{ url('/cart') }}"><i class="fas fa-shopping-cart fa-lg"></i>  Cart</a>
                        <a class="dropdown-item" href="{{ url('/Membership') }}"><i class="fas fa-address-card fa-lg"></i>   Membership</a>
                        <a class="dropdown-item" href="{{ url('/transaction') }}"><i class="fas fa-file-invoice fa-lg"></i>   History Transaction</a>
                    </div>
                </div>
                @endauth
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <livewire:auth.logout />
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            <div class="container-fluid">
                {{isset($slot) ? $slot : null}}
        </div>       
        </main>
    </div>
    <!-- <script>
        window.addEventListener('show-form', event => {
            $('#form').modal('show');
        })

        window.addEventListener('hide-form', event => {
            $('#form').modal('hide');
        }
        )
    </script> -->
   
    @livewireChartsScripts
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @stack('script-custom')
</body>
</html>
