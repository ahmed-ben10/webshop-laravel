@extends('layouts.visitor')

@section('content')
    <section class="change-password">
        <form method="POST" action="{{ route('changePassword') }}" class="login">
            <h2 class="card-header">{{ __('Wachtwoord wijzigen') }}</h2>
            @csrf
            <input name="_method" type="hidden" value="PUT">
            <div class="login__group">
                <label for="name" class="login__label">{{ __('Wachtwoord') }}</label>
                <div class="login__group">
                    <input type="password" class="login__input @error('current-password') is-invalid @enderror" name="current-password"
                           value="{{ old('current-password') }}" >
                    @error('current-password')
                    <span class="login__message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="login__group">
                <label for="password" class="login__label">{{ __('Nieuwe wachtwoord') }}</label>
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
                       class="login__group">{{ __('Herhaal nieuwe wachtwoord') }}</label>
                <div class="login__group">
                    <input type="password" class="login__input" name="password_confirmation">
                </div>
            </div>
            <div class="login__group">
                <button type="submit" class="login__button">
                    {{ __('Wijzig wachtwoord') }}
                </button>
            </div>
        </form>
    </section>
@endsection
