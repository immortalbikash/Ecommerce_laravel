<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $cartData = Cart::with('getProductData')->where('user_id', $user->id)->get();
        $subtotal = 0;
        $shipping = 50;
        foreach($cartData as $value){
            $productData = $value->getProductData;
            $price = !empty($productData->sale_price ) ? ($productData->sale_price * $value->quantity) : ($productData->price * $value->quantity);
            $subtotal += $price;
        }
        $tax = round((3/100) * $subtotal);  //point ma naaos bhanera round gareko
        $total_amount = $subtotal + $shipping + $tax;
        return view('cart', compact('user', 'cartData', 'subtotal', 'shipping', 'tax', 'total_amount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        echo "<pre>";
        // print_r($request->all());
        print_r('we entered in create function');
        exit;

        //we are in 28min manage cart functionally
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function storeOrder(Request $request){
        $cartData = Cart::with('getProductData')->where('user_id', auth()->user()->id)->get();
        $commentData = Comment::where('user_id', auth()->user()->id)->value('comment');
        $subtotal = 0;
        $shipping = 50;
        foreach($cartData as $value){
            $productData = $value->getProductData;
            $price = !empty($productData->sale_price ) ? ($productData->sale_price * $value->quantity) : ($productData->price * $value->quantity);
            $subtotal += $price;
        }
        $tax = round((3/100) * $subtotal);  //point ma naaos bhanera round gareko
        $total_amount = $subtotal + $shipping + $tax;

        $orderData = [
            'user_id' => auth()->user()->id,
            'sub_total' => $subtotal ?? 0,
            'shipping' => $shipping ?? 0,
            'tax_amount' => $tax ?? 0,
            'tax_rate' => 3 ?? 0,
            'amount' => $total_amount ?? 0,
            'comment' => $commentData ?? null,
            'status' => 'Order placed',
        ];
    }
}
