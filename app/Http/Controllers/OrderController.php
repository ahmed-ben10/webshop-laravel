<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\PaymethodStoreRequest;
use Illuminate\Http\Request;
use App\Cart;
use App\Customer;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\Order_Product;
use Axlon\PostalCodeValidation\Rules\PostalCode;

class OrderController extends Controller
{
    public function forgertSession(Request $request){
        $request->session()->forget('cart');
        $request->session()->flash('success','Session is gereset!');

        return redirect()->route('home');
    }

    public function orderNextStep(){
        $customer = null;
        if (Auth::guest()){
            $customer = new Customer();

        } else{
            $user = Auth::user();
            $customer = Customer::where('user_id',$user->id)->first();
        }
            return view('orders.next')->with('customer',$customer);
    }

    public function saveCustomer(Request $request, CustomerStoreRequest $customerStoreRequest){
        $customerStoreRequest->validated();

        //Making Customer object to store it in a Session
        $customer = null;
        if (Auth::guest()){
            $customer = new Customer();

        } else{
            $user = Auth::user();
            $customer = Customer::where('user_id',$user->id)->first();
        }
        $customer->firstname = $request->input('voornaam');
        $customer->preprovision = $request->input('tussenvoegsel') == null? null:$request->input('tussenvoegsel');
        $customer->lastname = $request->input('achternaam');
        $customer->address = $request->input('adres');
        $customer->postal_code = $request->input('postcode');
        $customer->telefoonnummer = $request->input('telefoonnummer');

        //Making order object to store it in a Session
        $order = new Order();
        $order->delivery_time = date("H:i", strtotime( $request->input('bezorgtijd')));
        $order->status = "Bereiden";
        $order->comment = $request->input('opmerking');

        $request->session()->put('customer',$customer);
        $request->session()->put('order',$order);

        return  redirect()->route('orderPay');
    }

    public function orderPay(Request $request){
        $oldCart = $request->session()->get('cart');
        $customer = $request->session()->get('customer');

        $cart = new Cart($oldCart);

        return view('orders.pay')->with('customer',$customer)->with('cart',$cart);
    }

    public function savePaymethod(Request $request, PaymethodStoreRequest $paymethodStoreRequest){
        $paymethodStoreRequest->validated();

        $order = $request->session()->get('order');
        $order->paymethod = $request->input('paymethod');

        $request->session()->put('order',$order);

        return redirect()->route('makeOrder');
    }

    public function makeOrder(Request $request){
        //get cart
        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);

        //save customer
        $customer = $request->session()->get('customer');
        $customer->save();

        //save order
        $order = $request->session()->get('order');
        $order->customer_id = $customer->id;
        $order->totalPrice = $cart->totalPrice;
        $order->save();

        //save the ordered products
        foreach ($cart->items as $item) {
            $order_product = new Order_Product();
            $order_product->order_id = $order->id;
            $order_product->quantity = $item['quantity'];
            $order_product->product_id = $item['product']->id;
            $order_product->save();
        }

        //save to the database
        $request->session()->forget('order');
        $request->session()->forget('customer');
        $request->session()->forget('cart');

        return redirect()->route('thankYou');
    }

    public function thankYou(){
        return view('orders.thankYou');
    }
}
