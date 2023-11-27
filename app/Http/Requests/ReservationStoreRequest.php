<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ReservationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $product = Product::find($this->get('product_id'));

        $rules = [
            'product_id' => 'required|exists:App\Models\Product,id',
        ];
        
        if($product) {
            $rules['quantity'] = 'required|integer|between:1,' . $product->quantity;
        } else {
            $rules['quantity'] = 'required|integer';
        }
        
        return $rules;
    }
}
