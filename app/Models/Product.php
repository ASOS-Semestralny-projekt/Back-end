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

    public static function where(string $column, $value)
    {
        return static::query()->where($column, $value);
    }

    public static function find($productId)
    {
        return static::query()->find($productId);
    }
}
