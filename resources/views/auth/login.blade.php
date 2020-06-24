@extends('layouts.visitor')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="login">
        <h2 class="card-header">{{ __('Login') }}</h2>
        @csrf
        <div class="login__group">
            <label for="email" class="login__label">{{ __('E-mail') }}</label>
            <div class="login__group">
                <input type="email" class="login__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >
                @error('email')
                    <span class="login__message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="login__label">{{ __('Wachtwoord') }}</label>
            <div class="login__group">
                <input type="password" class="login__input @error('password') is-invalid @enderror" name="password">
                @error('password')
                    <span class="login__message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="login__checkbox">
                    <input class="form-check-input" type="checkbox" name="remember"{{ old('remember') ? 'checked' : '' }}>

                    <label class="login__remember" for="remember">
                        {{ __('Herinner me') }}
                    </label>
                </div>
        <div class="login__group">
                <button type="submit" class="login__button">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="login__forget" href="{{ route('password.request') }}">
                        {{ __('Wachtwoord vergeten?') }}
                    </a>
                <a class="login__forget" href="{{ route('register') }}">
                    {{ __('Geen account?') }}
                </a>
                @endif
            </div>
    </form>
@endsection
