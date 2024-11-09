<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\ValidationException;


class ValidOrder implements ValidationRule
{
    protected float $totalPrice;

    public function __construct($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * Determine if the validation rule passes.
     * Is used for oder validation.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * @return void
     *
     * @throws ValidationException
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($value as $product) {
            if (!isset($product['id'])) {
                throw ValidationException::withMessages([
                    $attribute => 'Product ID is required.'
                ])->status(409);
            }

            $productId = $product['id'];

            if (!Product::find($productId)) {
                throw ValidationException::withMessages([
                    $attribute => 'The product does not exist.'
                ])->status(409);
            }

            $productModel = Product::find($productId);

            if ($productModel->price != $product['price']) {
                throw ValidationException::withMessages([
                    $attribute => 'The price of the product does not match the price in the database.'
                ])->status(409);
            }

            if ($productModel->stock < $product['quantity']) {
                throw ValidationException::withMessages([
                    $attribute => 'The quantity of the product is not sufficient.'
                ])->status(409);
            }
    }
        $this->validateTotalPrice($value);
    }

    /**
     * Validate the total price of the order.
     * Sum of the prices of the products in the order must match the total price.
     *
     * @param array $value
     * @return void
     *@throws ValidationException
     */
    protected function validateTotalPrice(array $value): void
    {
        $sumOfPrices = array_reduce($value, function ($sum, $product) {
            return $sum + ($product['price'] * $product['quantity']);
        }, 0);

        if ($sumOfPrices != $this->totalPrice) {
            throw ValidationException::withMessages([
                'total_price' => 'The total price does not match the sum of the product prices.'
            ])->status(409);
        }
    }
}
