<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);

        return view('orders.cart', ['cart'=>$cart,'cartItems' => $cart->items, 'totalPrice' => $cart->totalPrice]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $product = Product::find($id);

        $oldCart = $request->session()->has('cart')? $request->session()->get('cart'): null;
        $cart = new Cart($oldCart);
        $cart->addToCart($product, $product->id);
        $cart->calculateTotalPrice();

        $request->session()->put('cart',$cart);
        $request->session()->flash('success','Toegevoegd aan de winkelwagen');

        return  redirect()->route('categories.show', $product->category->name);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){
        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);
        $cart->deleteItem($id);
        $request->session()->put('cart',$cart);

        return redirect()->route('cart.index');
    }

    // Wijzigt het aantal producten in de winkelwagen

    public function orderCount(Request $request, $id, $quantity){
        if( $quantity == 0 ) {
            $oldCart = $request->session()->get('cart');
            $cart = new Cart($oldCart);
            $cart->deleteItem($id);
            $request->session()->put('cart',$cart);
        } else {
            $oldCart = $request->session()->get('cart');
            $cart = new Cart($oldCart);
            $cart->changeQuantity($id, $quantity);

            $request->session()->put('cart',$cart);
        }

        return redirect()->route('cart.index');
    }
}
