<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductQuantityRule implements ValidationRule
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value == 0) {
            $fail('Product out of stock.');
        }

        if($value > $this->product->quantity) {
            $fail('Quantity requested exceeds product quantity.');
        }
    }
}
