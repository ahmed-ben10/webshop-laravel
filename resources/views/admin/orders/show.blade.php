@extends('layouts.admin')

@section('main')
    <section class="order-show">
        <h2 class="order-show__heading">Bestelling details</h2>
        <h3 class="order-show__underheading"> Details</h3>
        <table class="details">
            <tr class="details__row">
                <th class="details__heading">Naam: </th>
                <td class="details__data">{{ $order->customer->firstname }} {{ $order->customer->preprovision }} {{ $order->customer->lastname }}</td>
            </tr>
            <tr class="details__row">
                <th class="details__heading">Adres: </th>
                <td class="details__data">{{ $order->customer->address }} , {{ $order->customer->postal_code }} </td>
            </tr>
            <tr class="details__row">
                <th class="details__heading">Telefoonnummer: </th>
                <td class="details__data">{{ $order->customer->telefoonnummer }}</td>
            </tr>
            <tr class="details__row">
                <th class="details__heading">Status: </th>
                <td class="details__data">{{ $order->status }}</td>
            </tr>
            <tr class="details__row">
                <th class="details__heading">Betaalwijze: </th>
                <td class="details__data">{{ $order->paymethod }}</td>
            </tr>
        </table>
        <h3 class="order-show__underheading"> Product(en)</h3>
        <table class="order-product">
            <tr class="order-product__row">
                <th class="order-product__heading">Product</th>
                <th class="order-product__heading">Aantal</th>
                <th class="order-product__heading">Prijs</th>
                <th class="order-product__heading">Subtotaal</th>
            </tr>
            @foreach($order->orders_products as $product)
                <tr class="order-product__row">
                    <td class="order-product__data">{{ $product->product->name }}</td>
                    <td class="order-product__data">{{ $product->quantity }}</td>
                    <td class="order-product__data">&euro;{{ $product->product->price }}</td>
                    <td class="order-product__data">&euro;{{ $product->product->price * $product->quantity }}</td>
                </tr>
            @endforeach
            <tr  class="order-product__row">
                <td class="order-product__data"></td>
                <td class="order-product__data"></td>
                <th  class="order-product__heading">Totaal:</th>
                <td class="order-product__data"> &euro;{{ $order->totalPrice }}</td>
            </tr>
        </table>
        @if($order->comment)
            <div class="order-show__comment">
                <h3> Opmerking</h3>
                <p>
                    {{ $order->comment }}
                </p>
            </div>
        @endif
    </section>
@endsection
