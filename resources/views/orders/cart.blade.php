@extends('layouts.visitor')

@section('content')
    <section class="cart-container">
        @if($cartItems)
            @foreach($cartItems as $cartItem)
                <div class="cart">
                    <img src="{{$cartItem['product']->image_url}}" alt="{{$cartItem['product']->name}}" class="cart__image">
                    <div class="cart__body">
                        <div class="cart__header">
                            <h2 class="cart__heading">
                                {{$cartItem['product']->name}}
                            </h2>
                            <small>
                                {{$cartItem['product']->description}}
                            </small>
                        </div>
                        <div class="cart__quantity">
                            <div class="dropdown">
                                <button class="dropdown__button">
                                    {{$cartItem['quantity']}} item(s)
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <div class="dropdown__content">
                                    <a href="{{ route('orderCount',['id'=>$cartItem['product']['id'], 'quantity'=>$cartItem['quantity']+1]) }}" class="dropdown__link">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <a href="{{ route('orderCount',['id'=>$cartItem['product']['id'], 'quantity'=>$cartItem['quantity']-1]) }}" class="dropdown__link">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                    {!! Form::open(['route' =>['cart.destroy', $cartItem['product']['id']], 'method'=>'POST', 'class' => 'dropdown__link']) !!}
                                        <button type="submit" class="dropdown__item">
                                            <i class="fa fa-times-circle"></i>
                                        </button>
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                        <div class="cart__price">
                            &euro;{{$cartItem['product']->price}}
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="cart-container__checkout">
                <div class="cart-container__total">
                    Totaal: &euro;{{ $cart->totalPrice }}
                </div>
                <a class="cart-container__button" href="{{ route('orderNextStep')}}">
                    Volgende
                </a>
            </div>
        @else
            <p class="cart-container__empty">De winkelwagen is momenteel leeg. Klik <a href="{{ route('categories.index') }}">hier</a> om iets te bestellen.</p>
        @endif
    </section>
@endsection

