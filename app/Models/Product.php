<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    protected $hidden = [
        'created_at',
        'updated_at'
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

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
    }

    public static function truncate()
    {
        return static::query()->delete();
    }
}
