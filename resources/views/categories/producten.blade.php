@extends('layouts.visitor')

@section('main')
    <section class="category">
        @if($categories)
            @foreach($categories as $category)
                @if($category->category_id == null)
                    <a class="category__link  @if($category->id == $id ?? '' ?? '') category__link--current @endif" href="{{ route('categories.show',$category->name)  }}">{{ $category->name }}</a>
                @endif
            @endforeach
         @endif
    </section>
@endsection

@section('content')
    @if(count($subCategories) > 0)
        <section class="category">
            @foreach($subCategories as $category)
            <a class="category__link  @if($category->id == $id ?? '' ?? '') category__link--current @endif" href="{{ route('categories.show',$category->name)  }}">{{ $category->name }}</a>
        @endforeach
        </section>
    @endif
    <div class="products-container">
        @if(count($products) > 0)
            @foreach($products as $product)
                <div class="product">
                    <div class="product__body">
                        <h2 class="product__title">
                            {{$product->name}}
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
        @else
            <p>Klik een categorie aan om producten te zien.</p>
        @endif
    </div>
    @if(count($products) > 0)
        <a href="{{ route('categories.index') }}" class="product__back"><i class="fa fa-arrow-circle-left"></i></a>
    @endif
@endsection
