@extends('layouts.visitor')

@section('content')
    <section class="pay">
        <div class="price">
            <h2 class="price__heading">Te betalen: </h2>
            <p class="price__number">&euro;{{$cart->totalPrice}}</p>
        </div>
        <h1>
            Kies uw betaalwijze
        </h1>
        {!! Form::open(['route' =>'savePaymethod', 'method'=>'POST', 'class'=>'payment']) !!}
            <div class="payment__group">
                {{ Form::radio('paymethod', 'Ideal', ['class' => 'payment__radio']) }}
                <img src="https://www.ideal.nl/img/statisch/mobiel/iDEAL_1024x1024.gif" alt="Ideal" class="payment__image">
                {{ Form::label('paymethod', 'Ideal', ['class' => 'payment__label'])}}
            </div>
            <div class="payment__group">
                {{ Form::radio('paymethod', 'Mastercard/Visa', ['class' => 'payment__radio']) }}
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" alt="visa-and-mastercard" class="payment__image">
                {{ Form::label('paymethod', 'Mastercard/Visa', ['class' => 'payment__label'])}}
            </div>
            <div class="payment__group">
                {{ Form::radio('paymethod', 'Pinnen', ['class' => 'payment__radio']) }}
                <img src="https://schoonmaakjournaal.nl/wp-content/uploads/2015/04/pin-logo-1.jpg" alt="Pinnen" class="payment__image">
                {{ Form::label('paymethod', 'Pinnen', ['class' => 'payment__label'])}}
            </div>
            <div class="payment__group">
                {{ Form::radio('paymethod', 'Contant', ['class' => 'payment__radio']) }}
                <img src="https://www.casinometideal.info/wp-content/uploads/2019/07/contant-betalen.png" alt="Contant" class="payment__image">
                {{ Form::label('paymethod', 'Contant', ['class' => 'payment__label'])}}
            </div>
            {{ Form::submit('Betaal',['class'=>'payment__button']) }}
        {!! Form::close() !!}
    </section>
@endsection

