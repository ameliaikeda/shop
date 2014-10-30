<?php namespace Amelia\Shop\Facades;

use Illuminate\Support\Facades;

class Cart extends Facade {

	/**
	 * Get the underlying class IoC key
	 *
	 * @return string
	 */
	public function getFacadeAccessor() {
		return "cart";
	}
}
