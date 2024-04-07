<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $primarykey = 'id';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    //has many relation
    public function getProductData(){
        return $this->hasOne(Product::class, 'id', 'product_id');   //one row have one data
    }
}
