<?php namespace Amelia\Shop\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            "id" => "required|exists.products",

        ];
    }
}