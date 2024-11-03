<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'category_id',
        'category_name',
        'img_path',
        'short_description',
        'long_description',
        'price',
        'stock'
    ];

    public static function create(array $array): Product
    {
        $product = new self();
        $product->fill($array);
        $product->save();

        return $product;
    }
}
