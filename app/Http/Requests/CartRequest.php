<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Product;
class CartRequest extends FormRequest
{
    public $product;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->product = Product::with(['category', 'brand'])->find($this->get('id', 0));
        return $this->product;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'id' => 'required',
        'quantity' => 'required_if:storing,1|min:0' . ($this->product->validate_stock ? "|max:{$this->product->stock}" : '')
      ];
    }
}
