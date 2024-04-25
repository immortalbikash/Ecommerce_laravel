<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lineitem extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'lineitems';

    protected $fillable = [
        'user_id',
        'order_id',
        'product_id',
        'quantity',
        'price',
        'total_price',
    ];

    public function customerData(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function productData(){
        return $this->hasOne(Product::class, 'id', 'product_id')->select('id', 'name'); //only want id and name
    }

    public function orderData(){
        return $this->hasOne(Order::class, 'id', 'order_id')->select('id', 'status');
    }
}
