<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'order_date_created',
        'products',
        'total_price',
    ];

    public static function create(array $attributes)
    {
        $order = new self();
        $order->user_id = $attributes['user_id'];
        $order->order_number = $attributes['order_number'];
        $order->order_date_created = $attributes['order_date_created'];
        $order->total_price = $attributes['total_price'];
        $order->save();

        if (isset($attributes['products'])) {
            foreach ($attributes['products'] as $product) {
                $order->products()->attach($product['id'], [
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                ]);
            }
        }
        return $order;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
    }
}
