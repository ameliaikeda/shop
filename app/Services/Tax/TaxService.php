<?php namespace Amelia\Shop\Services\Billing;

interface TaxService {
	/**
	 * Apply relevant taxes to a price.
	 *
	 * @param float $price
	 * @return mixed
	 */
	public function apply($price);
}
