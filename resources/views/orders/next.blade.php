@extends('layouts.visitor')

@section('content')
    <div class="next">
        <h1 class="next__heading">
            Vul uw gegevens in
        </h1>
        {{ Form::model($customer, ['route' => array('saveCustomer'),'class'=>'customer-form']) }}
        <div class="customer-form__group">
            {{ Form::label('voornaam', 'Voornaam:', array('class' => 'customer-form__label')) }}
            {{ Form::text('voornaam', $customer->firstname, array('class' => 'customer-form__input')) }}
            {!! $errors->first('voornaam', '<p class="alert--danger">:message</p>') !!}
        </div>
        <div class="customer-form__group">
            {{ Form::label('tussenvoegsel', 'Tussenvoegsel:', array('class' => 'customer-form__label')) }}
            {{ Form::text('tussenvoegsel', $customer->preprovision, array('class' => 'customer-form__input')) }}
        </div>
        <div class="customer-form__group">
            {{ Form::label('achternaam', 'Achternaam:', array('class' => 'customer-form__label')) }}
            {{ Form::text('achternaam', $customer->lastname, array('class' => 'customer-form__input')) }}
            {!! $errors->first('achternaam', '<p class="alert--danger">:message</p>') !!}
        </div>
        <div class="customer-form__group">
            {{ Form::label('adres', 'Adres:', array('class' => 'customer-form__label')) }}
            {{ Form::text('adres', $customer->address, array('class' => 'customer-form__input')) }}
            {!! $errors->first('adres', '<p class="alert--danger">:message</p>') !!}
        </div>
        <div class="customer-form__group">
            {{ Form::label('postcode', 'Postcode:', array('class' => 'customer-form__label')) }}
            {{ Form::text('postcode', $customer->postal_code, array('class' => 'customer-form__input')) }}
            {!! $errors->first('postcode', '<p class="alert--danger">:message</p>') !!}
        </div>
        <div class="customer-form__group">
            {{ Form::label('telefoonnummer', 'Telefoonnummer:', array('class' => 'customer-form__label')) }}
            {{ Form::text('telefoonnummer', $customer->telefoonnummer, array('class' => 'customer-form__input')) }}
            {!! $errors->first('telefoonnummer', '<p class="alert--danger">:message</p>') !!}
        </div>
        <div class="customer-form__group">
            {{ Form::label('bezorgtijd', 'Bezorgtijd:', array('class' => 'customer-form__label')) }}
            {{ Form::time('bezorgtijd', null, array('class' => 'customer-form__input')) }}
            {!! $errors->first('bezorgtijd', '<p class="alert--danger">:message</p>') !!}
        </div>
        <div class="customer-form__group">
            {{ Form::label('opmerking', 'Opmerking:', array('class' => 'customer-form__label')) }}
            {{ Form::textarea('opmerking', null, array('class' => 'customer-form__input')) }}
        </div>
        {{ Form::submit('Volgende', array('class'=>'customer-form__button')) }}
        {{ Form::close() }}
    </div>
@endsection

