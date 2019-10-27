<?php

namespace App\Http\Requests;

use App\Category;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => 'required',
        ];
    }

    /**
    * Find the target Category
    *
    * @return Instance of Category
    */
    public function category()
    {
      return Category::findOrFail($this->route('category'));
    }

    /**
    * Save a target Category
    *
    * @return Instance of Category
    */
    public function save()
    {
      return tap($this->category())->update($this->validated());
    }
}
