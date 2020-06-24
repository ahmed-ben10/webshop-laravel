@extends('layouts.admin')

@section('main')
    <section class="order-update">
        <h2 class="order-update__heading">Wijzig bestelling</h2>
        {!! Form::open(['route' =>['orderUpdateForm', $order->id], 'method'=>'POST', 'class'=>'order-form']) !!}
                <div class="order-form__upper">
                    <div class="order-form__group">
                        {{ Form::label('voornaam', 'Voornaam:', array('class' => 'order-form__label')) }}
                        {{ Form::text('voornaam', $order->customer->firstname, array('class' => 'order-form__input')) }}
                        {!! $errors->first('voornaam', '<p class="alert--danger">:message</p>') !!}
                    </div>
                    <div class="order-form__group">
                        {{ Form::label('tussenvoegsel', 'Tussenvoegsel:', array('class' => 'order-form__label')) }}
                        {{ Form::text('tussenvoegsel', $order->customer->preprovision, array('class' => 'order-form__input')) }}
                    </div>
                    <div class="order-form__group">
                        {{ Form::label('achternaam', 'Achternaam:', array('class' => 'order-form__label')) }}
                        {{ Form::text('achternaam', $order->customer->lastname, array('class' => 'order-form__input')) }}
                        {!! $errors->first('achternaam', '<p class="alert--danger">:message</p>') !!}
                    </div>
                </div>
                <div class="order-form__bottom">
                    <div class="order-form__group">
                        {{ Form::label('adres', 'Adres:', array('class' => 'order-form__label')) }}
                        {{ Form::text('adres', $order->customer->address, array('class' => 'order-form__input')) }}
                        {!! $errors->first('adres', '<p class="alert--danger">:message</p>') !!}
                    </div>
                    <div class="order-form__group">
                        {{ Form::label('postcode', 'Postcode:', array('class' => 'order-form__label')) }}
                        {{ Form::text('postcode', $order->customer->postal_code, array('class' => 'order-form__input')) }}
                        {!! $errors->first('postcode', '<p class="alert--danger">:message</p>') !!}
                    </div>
                    <div class="order-form__group">
                        {{ Form::label('telefoonnummer', 'Telefoonnummer:', array('class' => 'order-form__label')) }}
                        {{ Form::text('telefoonnummer', $order->customer->telefoonnummer, array('class' => 'order-form__input')) }}
                        {!! $errors->first('telefoonnummer', '<p class="alert--danger">:message</p>') !!}
                    </div>
                    <div class="order-form__group">
                        {{ Form::label('bezorgtijd', 'Bezorgtijd:', array('class' => 'order-form__label')) }}
                        {{ Form::time('bezorgtijd', date('H:i', strtotime($order->delivery_time)), array('class' => 'order-form__input')) }}
                        {!! $errors->first('bezorgtijd', '<p class="alert--danger">:message</p>') !!}
                    </div>
                </div>
                <div class="order-form__group">
                    {{ Form::label('opmerking', 'Opmerking:', array('class' => 'order-form__label')) }}
                    {{ Form::textarea('opmerking', $order->comment, array('class' => 'order-form__input')) }}
                </div>
                {{ Form::hidden('_method', 'PUT') }}
                {{ Form::submit('Betaal',['class'=>'payment__button']) }}
        {!! Form::close() !!}    </section>
@endsection
