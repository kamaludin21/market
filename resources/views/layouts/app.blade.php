<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/market.svg') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/market.svg') }}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Market</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.fancybox.min.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="navbar-brand">
                    <a href="/">
                        <img src="{{ asset('img/market.svg') }}" alt="Market Gadget" class="img-fluid" width="40">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @can('administrator')
                        <li class="nav-item @yield('status-home')">
                            <a class="nav-link" href="{{ url('home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item @yield('status-transaksi')">
                            <a class="nav-link" href="{{ url('transaksi') }}">{{ __('Transaksi') }}</a>
                        </li>
                        <li class="nav-item @yield('status-produk')">
                            <a class="nav-link" href="{{ url('produk') }}">{{ __('Produk') }}</a>
                        </li>
                        <li class="nav-item @yield('status-kategori')">
                            <a class="nav-link" href="{{ url('kategori') }}">{{ __('Kategori') }}</a>
                        </li>
                        <li class="nav-item @yield('status-customer')">
                            <a class="nav-link" href="{{ url('customer') }}">{{ __('Customer') }}</a>
                        </li>
                        @elsecan('customer')
                        <li class="nav-item @yield('status-katalog')">
                            <a class="nav-link" href="{{ url('katalog') }}">{{ __('Katalog') }}</a>
                        </li>
                        <li class="nav-item @yield('status-transaksi')">
                            <a class="nav-link" href="{{ url('customer/mytransaksi') }}">{{ __('Transaksi Saya') }}</a>
                        </li>
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        @can('customer')
                        <li class="nav-item @yield('status-cart')">
                            <a href="{{ url('customer/cart') }}" class="nav-link dropleft" id="mess">
                                <i class="gg-shopping-cart"></i>
                                <span class="{{ CartsDotNotify(Auth::user()->id) }}" style=""></span>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main role="main" class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.fancybox.min.js') }}" charset="utf-8"></script>
    <script>
        function numberFilter(evt) {
            let charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

    </script>
</body>

</html>
