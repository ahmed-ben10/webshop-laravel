@extends('layouts.visitor')

@section('content')
    <form method="POST" action="{{ route('editProfile') }}" class="login">
        <h2 class="card-header">{{ __('Profiel wijzigen') }}</h2>
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="login__group">
            <label for="name" class="login__label">{{ __('Voornaam') }}</label>
            <div class="login__group">
                <input type="text" class="login__input @error('voornaam') is-invalid @enderror" name="voornaam"
                       value="{{ $customer->firstname}}" >
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
                       value="{{ $customer->preprovision}}">
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
                       value="{{ $customer->lastname}}" >
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
                       value="{{ $customer->address}}" >
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
                       value="{{ $customer->postal_code}}" >
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
                       value="{{ $customer->telefoonnummer}}" >
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
                       value="{{ $user->email }}">

                @error('email')
                <span class="login__message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="login__group">
            <button type="submit" class="login__button">
                {{ __('Wijzig') }}
            </button>
        </div>
    </form>
@endsection
