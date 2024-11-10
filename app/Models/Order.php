<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'order_number',
        'order_date_created',
        'products',
        'total_price',
    ];

    /**
     * Create a new order.
     *
     * @param array $attributes
     * @return Order
     */
    public static function create(array $attributes): Order
    {
        $order = new self();
        $order->user_id = $attributes['user_id'];
        $order->order_number = $attributes['order_number'];
        $order->order_date_created = $attributes['order_date_created'];
        $order->total_price = $attributes['total_price'];
        $order->save();

        $customerData = $attributes['customer'];
        $customerData['order_id'] = $order->id;

        DB::table('order_customer')->insertGetId($customerData);

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

    /**
     * Get the user that the order belongs to.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the products that belong to the order.
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
    }

    public static function truncate(): void
    {
        static::query()->delete();
    }
}
