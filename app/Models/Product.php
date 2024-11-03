<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'quantity',
        'image'
    ];

    public static function create(array $array): Product
    {
        $product = new self();
        $product->fill($array);
        $product->save();

        return $product;
    }
}
