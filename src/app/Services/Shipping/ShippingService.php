<?php namespace Amelia\Shop\Services\Shipping;

interface ShippingService {

	/**
	 * Apply shipping prices to an array of data (items, offers)
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function apply(array $data);
}
