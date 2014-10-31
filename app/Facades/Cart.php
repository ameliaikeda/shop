<?php namespace Amelia\Shop\Facades;

use Illuminate\Support\Facades\Facade;

class Cart extends Facade {

	/**
	 * Get the underlying class IoC key
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return "cart";
	}
}
