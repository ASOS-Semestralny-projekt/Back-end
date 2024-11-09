<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Create a new product.
     *
     * @param array $array
     * @return Product
     */
    public static function create(array $array): Product
    {
        $product = new self();
        $product->fill($array);
        $product->save();

        return $product;
    }

    /**
     * Find a product by its attribute value.
     *
     * @param string $column
     * @param mixed $value
     * @return Product
     */
    public static function where(string $column, mixed $value): Product
    {
        return static::query()->where($column, $value);
    }

    /**
     * Find a product by its ID.
     *
     * @param int $productId
     * @return Product
     */
    public static function find(int $productId): Product
    {
        return static::query()->find($productId);
    }

    /**
     * Get the orders that include this product.
     *
     * This defines a many-to-many relationship between the Product and Order models.
     * The pivot table contains additional columns: 'quantity' and 'price'.
     *
     * @return BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
    }
}
