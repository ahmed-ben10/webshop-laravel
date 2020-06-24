@extends('layouts.admin')

@section('main')
    <div class="orders-container">
        <form action="{{ route('orders') }}" method="get" class="filter">
            <label for="status" class="filter__label">Status</label>
            <select name="status" class="filter__select">
                <option value="All" @if($filter == '' || 'All')  selected="selected"@endif>Alles</option>
                <option value="Bereiden" @if($filter == 'Bereiden')  selected="selected"@endif>Bereiden</option>
                <option value="Oven" @if($filter == 'Oven')  selected="selected"@endif>In de oven</option>
                <option value="Onderweg" @if($filter == 'Onderweg')  selected="selected"@endif>Onderweg</option>
                <option value="Bezorgd" @if($filter == 'Bezorgd')  selected="selected"@endif>Bezorgd</option>
            </select>
            <button type="submit" class="filter__button">Filter</button>
        </form>
        @if(count($orders))
            <table class="order">
                <tr class="order__row">
                    <th class="order__heading">
                        Status
                    </th>
                    <th class="order__heading">
                        Adres
                    </th>
                    <th class="order__heading">
                        Datum
                    </th>
                    <th class="order__heading">
                        Bezorgd hebben in
                    </th>
                    <th class="order__heading"></th>
                </tr>
                @foreach($orders as $order)
                    <tr class="order__row">
                        <td class="order__data">
                            <div class="dropdown">
                                <button class="dropdown__button dropdown__button--table">
                                    {{$order->status}} <i class="fa fa-caret-down"></i>
                                </button>
                                <div class="dropdown__content dropdown__content--table">
                                    @if($order->status != 'Bereiden')
                                        <a href="{{ route('ordersStatus', ['status'=>'Bereiden', 'id' => $order->id]) }}" class="dropdown__link">
                                        Bereiden
                                    </a>
                                    @endif
                                    @if($order->status != 'Oven')
                                        <a href="{{ route('ordersStatus', ['status'=>'Oven', 'id' => $order->id]) }}" class="dropdown__link">
                                        In de oven
                                    </a>
                                    @endif
                                    @if($order->status != 'Onderweg')
                                        <a href="{{ route('ordersStatus', ['status'=>'Onderweg', 'id' => $order->id]) }}" class="dropdown__link">
                                        Onderweg
                                    </a>
                                    @endif
                                    @if(($order->status != 'Bezorgd'))
                                        <a href="{{ route('ordersStatus', ['status'=>'Bezorgd', 'id' => $order->id]) }}" class="dropdown__link">
                                        Bezorgd
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="order__data">
                            {{ $order->customer->address }}
                        </td>
                        <td class="order__data">
                            {{ date('d-m-Y', strtotime($order->customer->created_at)) }}
                        </td>
                        <td class="order__data">
                            @if(($order->status != 'Bezorgd'))
                                @if($order->timer($order->delivery_time) < 0)
                                {{ $order->timer($order->delivery_time) *-1 }} min laat
                            @else
                                {{ $order->timer($order->delivery_time) }} min
                            @endif
                            @else
                                <p>-</p>
                            @endif
                        </td>
                        <td class="order__data">
                            <div class="dropdown">
                                <button class="dropdown__button dropdown__button--table">
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <div class="dropdown__content dropdown__content--table">
                                    <a href="{{ route('ordersShow', $order->id) }}" class="dropdown__link">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('ordersUpdate', $order->id) }}" class="dropdown__link">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('ordersDelete', $order->id) }}" class="dropdown__link">
                                        <i class="fa fa-times-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>Er zijn geen orders gevonden</p>
        @endif
    </div>
@endsection
