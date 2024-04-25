<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Lineitem;
use App\Models\Order;
use App\Models\Product;
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
        $lineItemData = [];
        foreach($cartData as $value){
            $productData = $value->getProductData;
            $price = !empty($productData->sale_price ) ? ($productData->sale_price * $value->quantity) : ($productData->price * $value->quantity);
            $subtotal += $price;
        }
        $tax = round((3/100) * $subtotal);  //point ma naaos bhanera round gareko
        $total_amount = $subtotal + $shipping + $tax;

        $orderData = Order::create([
            'user_id' => auth()->user()->id,
            'sub_total' => $subtotal ?? 0,
            'shipping' => $shipping ?? 0,
            'tax_amount' => $tax ?? 0,
            'tax_rate' => 3 ?? 0,
            'amount' => $total_amount ?? 0,
            'comment' => $commentData ?? "",
            'status' => 'Order placed',
        ]);

        foreach($cartData as $value){
            $productData = $value->getProductData;
            $price = !empty($productData->sale_price ) ? ($productData->sale_price * $value->quantity) : ($productData->price * $value->quantity);
            Lineitem::create([
                'user_id' => auth()->user()->id,
                'order_id' => $orderData->id,
                'product_id' =>$productData->id,
                'quantity' =>$value->quantity ?? 0,
                'price' => $price ?? 0,
                'total_price' =>$price * $value->quantity ?? 0,
            ]);
        }
        //order ko lagi checkout garesi data delete garnu paryo so
        Cart::where('user_id', auth()->user()->id)->delete();
        Comment::where('user_id', auth()->user()->id)->delete();
        return redirect()->back();
    }

    public function addToCart(Request $request){
        $products = Product::all(); //yo chai value user index ma pathauna lai matra use gareko ho
        $user_id = auth()->user()->id;
        // $requestData = $request->except('_token');
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        Cart::create([
            'user_id' => $user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
        return view('user_index', compact('products'));
    }
}
