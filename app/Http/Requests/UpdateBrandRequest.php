<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Brand;

class UpdateBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }


    /**
    * Find the target Brand
    *
    * @return Instance of Brand
    */
    public function brand()
    {
      return Brand::findOrFail($this->route('brand'));
    }

    /**
    * Save a target Brand
    *
    * @return Instance of Brand
    */
    public function save()
    {
      return tap($this->brand())->update($this->validated());
    }
}
