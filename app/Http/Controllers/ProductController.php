<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Product;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('getBrands')->get();
        // echo"<pre>";
        // print_r($products);
        // exit;
        return view('admin.product_list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brands::all();
        return view('admin.product_add', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'color' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
            'product_code' => 'required|min:5',
            'gender' => 'required|in:Male,Female,Children,Unisex',
            'function' => 'nullable|string|max:50',
            'stock' =>'required|numeric',
            'description' => 'required|string|max:500',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestdata = $request->except(['_token', 'add_product']);
        $imgName = 'lv_' .rand() . '.' .$request->image->extension();
        $request->image->move(public_path('products/'), $imgName);
        $requestdata['image'] = $imgName;
        $product = Product::create($requestdata);
        return redirect()->route('product.index');
        // echo "<pre>";
        // print_r($requestdata);
        // exit;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brands::all();
        return view('admin.product_edit', compact(['product', 'brands']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'color' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
            'product_code' => 'required|min:5',
            'gender' => 'required|in:Male,Female,Children,Unisex',
            'function' => 'nullable|string|max:50',
            'stock' =>'required|numeric',
            'description' => 'required|string|max:500',
        ]);
        $requestdata = $request->except('_token', '_method', 'update_product');
        $product->update($requestdata);
        return redirect()->route('product.index');
        // echo "<pre>";
        // print_r($request->all());
        // exit;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }

    public function productImageUpdate(Request $request, Product $product){
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestdata = $request->only('image');
        if(!empty($product)){
            $imgName = 'lv_' .rand() . '.' .$request->image->extension();
            $request->image->move(public_path('products/'), $imgName);
            $requestdata['image'] = $imgName;
            $existingImage = $product->image;
            $product->update($requestdata);
        }

        $imageExists = public_path("products/$existingImage");
        if(fileExists($imageExists)){
            unlink("products/$existingImage");
        }
        return redirect()->route('product.index');
        // echo "<pre>";
        // print_r($request->all());
        // exit;
    }
}
