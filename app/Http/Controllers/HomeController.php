<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $startDate = Carbon::now()->firstOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        // $products = Product::whereBetween('created_at', [$startDate, $endDate])->inRandomOrder()->limit(4)->get()->toArray();
        $products = Product::all()->take(12);
        return view('user_index', compact('products'));
    }

    public function productInfo(Request $request, Product $id){ //$id ma product ko all data aucha ....$id matra gareko bhaye id matra aucha

        //for related products
        $related_product_name = $id->function;
        // $related_products = Product::where('name', 'Fastrack Watch')->get()->take(4);
        $related_products = Product::where('function', $related_product_name)->get()->take(4);
        // echo "<pre>";
        // print_r($related_products);
        // exit;
        return view('product_info', compact('id', 'related_products'));
    }

    public function productList(Request $request){
        $requestData = $request->all();
        // $brands = Brands::all();
        // we need id and name of brand so we do following code
        $brands = Brands::select('id', 'name')->get();
        $products = Product::query();
        if(isset($requestData['gender']) && !empty($requestData['gender'])){
            $products = $products->where('gender', $requestData['gender']);
        }
        if(isset($requestData['price']) && !empty($requestData['price'])){
            if($requestData['price'] == 'less_than-1500'){
                $products = $products->where('price', '<', 1500);
            }
            else if($requestData['price'] == 'between_1500_5k'){
                $products = $products->whereBetween('price', [1500, 5000]); //price between 1500 to 5000
            }
            else if($requestData['price'] == 'between_5k_10k'){
                $products = $products->whereBetween('price', [5000, 10000]);
            }
            else if($requestData['price'] == 'between_10k_30k'){
                $products = $products->whereBetween('price', [10000, 30000]);
            }
            else if($requestData['price'] == 'greater_than_30k'){
                $products = $products->where('price', '>', 30000);
            }
        }
        if(isset($requestData['color']) && !empty($requestData['color'])){
            $products = $products->where('color', $requestData['color']);
        }
        if(isset($requestData['function']) && !empty($requestData['function'])){
            $products = $products->where('function', $requestData['function']);
        }
        if(isset($requestData['brand']) && !empty($requestData['brand'])){
            $products = $products->where('brand_id', $requestData['brand']);
        }
        if(isset($requestData['sort_by']) && !empty($requestData['sort_by'])){
            if($requestData['sort_by'] == 'lower_to_higher'){
                $products = $products->orderBy('price', 'ASC'); //showing price low to higher
            }
            elseif($requestData['sort_by'] == 'higher_to_lower'){
                $products = $products->orderBy('price', 'DESC');
            }
            elseif($requestData['sort_by'] == 'model_a_z'){
                $products = $products->orderBy('price', 'ASC');
            }
            elseif($requestData['sort_by'] == 'model_z_a'){
                $products = $products->orderBy('price', 'DESC');
            }
        }
        $products = $products->paginate(12);
        return view('product_list', compact('products', 'brands'));
    }

}
