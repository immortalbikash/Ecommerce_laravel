<?php

namespace App\Http\Controllers;

use App\Models\Lineitem;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::with('customerData')->get();
        // echo "<pre>";
        // print_r($orders);
        // exit;
        return view('admin.orders_list', compact('orders'));
    }

    public function changeOrderStatus(Request $request, $id){
        // echo "<pre>";
        // print_r($request->status);
        // exit;
        Order::where('id', $id)->update(['status' => $request->status ]);
        return redirect()->back();
    }

    public function getLineItems(Request $request, $id){
        // $datas = Lineitem::where('user_id', $id)->get();
        $order_data = Order::with('lineitemsData')->where('id', $id)->first();
        // echo "<pre>";
        // print_r($order_data);
        // exit;

        return view('admin.lineitem_list', compact('order_data'));
    }
}
