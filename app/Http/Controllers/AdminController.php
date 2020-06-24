<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderPutRequest;
use Axlon\PostalCodeValidation\Rules\PostalCode;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin']);
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function orders(Request $request){
        $orders = Order::all();
        $filter = $request->status? $request->status:'';
        if ($filter != '' && $filter != 'All'){
            $orders = Order::where('status', $filter)->get();
        }
        return view('admin.orders.index')->with('orders',$orders)->with('filter', $filter);
    }

    public function ordersShow($id){
        $order = Order::find($id);
        return view('admin.orders.show')->with('order',$order);
    }

    public function map(Order $order){
        $routeHttp = 'https://api.tomtom.com/routing/1/calculateRoute/';
        $currentLong = '52.041710';
        $currentLat = '4.335480';
        $endLong = '52.0502213';
        $endLat = '4.3312135';
        $key = 'FFcG3oHKzkmOEuGdBs9AWut3A34AR0on';
        $url = Http::get($routeHttp . $currentLong.','.$currentLat.':'.$endLong.','.$endLat.'/json?key='. $key);
        $route = $url->json();
        $routeSummary = $route["routes"][0]["summary"];
        $routeLegs = $route["routes"][0]["legs"][0]["points"];
        return view('admin.orders.map')->with('routeSummary',$routeSummary)->with('route',$routeLegs)->with('order',$order);
    }

    public function ordersDelete(Order $order){
        $order->delete();
        return redirect()->route('orders');
    }

    public function ordersUpdate($id){
        $order = Order::find($id);
        return view('admin.orders.update')->with('order', $order);
    }

    public function ordersStatus($id, $status){
        $order = Order::find($id);
        switch ($status){
            case 'Bereiden':
            case 'Oven':
            case 'Onderweg':
            case 'Bezorgd':
                $order->status = $status;
                $order->save();
                break;
            default:
                break;
        }
        return redirect()->route('orders');
    }

    public function orderUpdateForm(Request $request, $id, OrderPutRequest $orderPutRequest){
        $orderPutRequest->validated();

        $order = Order::find($id);
        $order->delivery_time = $request->bezorgtijd;
        $order->save();

        $customer = $order->customer;
        $customer->firstname = $request->input('voornaam');
        $customer->preprovision = $request->input('tussenvoegsel') == null? null:$request->input('tussenvoegsel');
        $customer->lastname = $request->input('achternaam');
        $customer->address = $request->input('adres');
        $customer->postal_code = $request->input('postcode');
        $customer->telefoonnummer = $request->input('telefoonnummer');
        $customer->save();

        return redirect()->route('orders');
    }

    public function products(){
        return view('admin.products');
    }
}
