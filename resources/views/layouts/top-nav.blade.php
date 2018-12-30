<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Paypal for Laravel 5
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li><a class="nav-link" href="{{ url('/') }}">Products</a></li>
                <li><a class="nav-link" href="{{ url('/') }}">Sales</a></li>
                <li><a class="nav-link" href="{{ url('/') }}">News</a></li>
                <li><a class="nav-link" href="{{ url('/') }}">About Us</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                @if (! Cart::isEmpty())
                    <li class="navbar-text">
                        <span class="badge badge-pill badge-secondary">{{ Cart::getTotalQuantity() }}</span> Items &nbsp;&nbsp;
                        Total: {{ number_format(Cart::getTotal(), 2, ',', '.') }} &euro; &nbsp;&nbsp;
                    </li>
                    <li><a class="nav-link" href="{{ url('/cart') }}">
                            View Cart &nbsp;&nbsp;
                        </a>
                    </li>
                @endif

                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
