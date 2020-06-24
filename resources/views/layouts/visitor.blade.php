<!doctype html>
<html lang="{{ config('app.local') }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/style.css')  }}">
        <title>{{ config('app.name')  }}</title>
    </head>
    <body class="body">
        <nav class="navigation">
            <a href="{{ route('home') }}" class="navigation__link">Home</a>
            <a href="{{ route('categories.index') }}" class="navigation__link">Producten</a>
            <div class="navigation__link navigation__link--right dropdown dropdown--auth">
                @guest
                    <a class="navigation__link" href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a class="navigation__link" href="{{ route('register') }}">Registreer</a>
                    @endif
                @else
                    <div class="navigation__link">
                            <a class="dropdown__button dropdown__button--auth" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        <div class="dropdown__content dropdown__content" >
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="navigation__link navigation__link--auth">
                                    Uitloggen
                                </button>
                                <a href="{{ route('editProfileRequest') }}" class="navigation__link navigation__link--auth">Profiel wijzigen</a>
                                <a href="{{ route('changePasswordRequest') }}" class="navigation__link navigation__link--auth">Wachtwoord wijzigen</a>
                            </form>
                        </div>
                    </div>
                @endguest
                <a href="{{ route('cart.index') }}" class="navigation__link">
                    @if( session()->get("cart"))
                        {{ session()->get("cart")->totalQty}}
                    @endif
                        <i class="fa fa-shopping-cart"></i>
                </a>
            </div>
        </nav>
        <main class="main">
            @include('inc.message')
            @yield('main')
            @yield('content')
        </main>
    </body>
    <footer class="footer">
        &copy;Cantine Choupi
    </footer>
    <script src="https://use.fontawesome.com/5ea4205658.js"></script>
</html>
