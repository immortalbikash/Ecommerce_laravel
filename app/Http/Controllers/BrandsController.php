<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;

use function PHPUnit\Framework\fileExists;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brandList = Brands::all();
        return view('admin.brands_list', compact('brandList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add_brands');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:30|string',
            'description' => 'nullable|string|max:100',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestData = $request->except('_token', 'add');
        // $imgName = 'lv_' .rand() . '.' . $request->image->extension();
        $imgName = Str::snake($request->name) . '.' . $request->image->extension();
        $request->image->move(public_path('brands/'), $imgName);
        $requestData['image'] = $imgName;
        $store = Brands::create($requestData);
        return redirect()->route('brand.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Brands $brand)
    {
        // return view('admin.brand_edit', compact('brands'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brands $brand)
    {
        return view('admin.brand_edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brands $brand)
    {
        // echo"<pre>";
        // print_r($request->all());
        // exit;
        $this->validate($request, [
            'name' => 'required|max:30|string',
            'description' => 'nullable|string|max:100',
        ]);
        $brand->name = $request->name ?? $brand->name;
        $brand->description = $request->description ?? $brand->description;
        // $requestData = $request->except(['_token', '_method', 'update']);
        $brand->save();
        return redirect()->route('brand.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brands $brand)
    {
        $brand->delete();
        return redirect()->route('brand.index');
    }

    public function changeBrandImage(Request $request, $id){
        $brand = Brands::find($id);
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestData = $request->except(['_token', 'update']);
        if(!empty($brand)){
            $imgName = $brand->name . '.' . $request->image->extension();
            $request->image->move(public_path('brands/'), $imgName);
            $requestData['image'] = $imgName;
            $existingProfile = $brand->image;
            $brand->update($requestData);

            $profileExists = public_path("brands/$existingProfile");
            if(fileExists($profileExists)){
                unlink("brands/$existingProfile");
            }

            return redirect()->route('brand.index');
        }
        // echo "<pre>";
        // print_r($request->all());
        // exit;
    }

    // public function changeBrandStatus(Request $request){

    // }
}
