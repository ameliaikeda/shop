<?php namespace Amelia\Shop\Services\Shipping;

use Amelia\Shop\Repositories\ShippingRepository;

class EloquentShippingService implements ShippingService {

	public function __construct(ShippingRepository $shipping) {
	    $this->shipping = $shipping;
	}

	/**
	 * Apply shipping prices to an array of data (items, offers)
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function apply(array $data) {
		// TODO: Implement apply() method.
	}
}