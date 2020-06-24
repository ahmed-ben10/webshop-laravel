<!doctype html>
<html lang="{{ config('app.local') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css')  }}">
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/maps/maps.css'>
    <link rel='stylesheet' type='text/css' href='../assets/ui-library/index.css'/>
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/maps/css-styles/routing.css'/>
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/2.2.0//SearchBox.css'/>
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/2.2.0//SearchBox-web.js'></script>
    <title>{{ config('app.name')  }}</title>
</head>
<body class="body">
<nav class="navigation">
    <a href="{{ route('dashboard') }}" class="navigation__link">Home</a>
    <a href="{{ route('orders') }}" class="navigation__link">Bestellingen</a>
    <a href="{{ route('products') }}" class="navigation__link">Producten</a>
    <div class="navigation__link navigation__link--right dropdown dropdown--auth">
        @auth
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
        @endauth
    </div>
</nav>
<main class="main">
    @include('inc.message')
    @yield('main')
</main>
</body>
<footer class="footer">
    &copy;Cantine Choupi
</footer>
<script src="https://use.fontawesome.com/5ea4205658.js"></script>
</html>
