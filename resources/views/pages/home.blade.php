@extends('layouts.visitor')

@section('content')
    <div class="products-container">
        @foreach($categories as $category)
            @foreach($category->products as $product)
                <div class="product">
                    <div class="product__body">
                        <h2 class="product__title">
                            {{$product->category->name}}  {{$product->name}}
                        </h2>
                        <small class="product__description">{{ $product->description  }}</small>
                        <p class="product__price">
                            &euro; {{ $product->price }}
                        </p>
                        <a href="{{ route('cart.edit',$product->id) }}" class="product__order">Order</a>
                    </div>
                    <img src="{{ $product->image_url }}" class="product__image" alt="">
                </div>
            @endforeach
        @endforeach
    </div>
@endsection
