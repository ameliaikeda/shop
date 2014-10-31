<?php namespace Amelia\Shop\Http\Requests\Products;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			"slug" => "sometimes|required|alpha_dash|unique:products,slug|max:190",
			"name" => "sometimes|required|max:190",
			"description" => "sometimes|required",
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @param \Illuminate\Contracts\Auth\Guard $auth
	 * @return bool
	 */
	public function authorize(Guard $auth) {
		$user = $auth->user();
		return $user and $user->admin and $user->permissions->update;
	}

}
