@extends('layouts.visitor')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="login">
        <h2 class="card-header">{{ __('Registreer') }}</h2>
        @csrf
        <div class="login__group">
            <label for="name" class="login__label">{{ __('Voornaam') }}</label>
            <div class="login__group">
                <input type="text" class="login__input @error('voornaam') is-invalid @enderror" name="voornaam"
                       value="{{ old('voornaam') }}" >
                @error('voornaam')
                <span class="login__message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="login__group">
            <label for="tussenvoegsel" class="login__label">{{ __('Tussenvoegsel') }}</label>
            <div class="login__group">
                <input type="text" class="login__input @error('tussenvoegsel') is-invalid @enderror" name="tussenvoegsel"
                       value="{{ old('tussenvoegsel') }}">
                @error('tussenvoegsel')
                <span class="login__message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="login__group">
            <label for="achternaam" class="login__label">{{ __('Achternaam') }}</label>
            <div class="login__group">
                <input type="text" class="login__input @error('achternaam') is-invalid @enderror" name="achternaam"
                       value="{{ old('achternaam') }}" >
                @error('achternaam')
                <span class="login__message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="login__group">
            <label for="adres" class="login__label">{{ __('Adres') }}</label>
            <div class="login__group">
                <input type="text" class="login__input @error('adres') is-invalid @enderror" name="adres"
                       value="{{ old('adres') }}" >
                @error('adres')
                <span class="login__message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="login__group">
            <label for="postcode" class="login__label">{{ __('Postcode') }}</label>
            <div class="login__group">
                <input type="text" class="login__input @error('postcode') is-invalid @enderror" name="postcode"
                       value="{{ old('postcode') }}" >
                @error('postcode')
                <span class="login__message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="login__group">
            <label for="telefoonnummer" class="login__label">{{ __('Telefoonnummer') }}</label>
            <div class="login__group">
                <input type="text" class="login__input @error('Telefoonnummer') is-invalid @enderror" name="telefoonnummer"
                       value="{{ old('telefoonnummer') }}" >
                @error('telefoonnummer')
                <span class="login__message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="login__group">
            <label for="email" class="login__label">{{ __('E-mail') }}</label>
            <div class="login__group">
                <input type="email" class="login__input @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}">

                @error('email')
                <span class="login__message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="login__group">
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
        <div class="login__group">
            <label for="password-confirm"
                   class="login__group">{{ __('Herhaal wachtwoord') }}</label>
            <div class="login__group">
                <input type="password" class="login__input" name="password_confirmation">
            </div>
        </div>
        <div class="login__group">
            <button type="submit" class="login__button">
                {{ __('Register') }}
            </button>
        </div>
    </form>
@endsection
