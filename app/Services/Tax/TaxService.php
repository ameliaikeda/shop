<?php namespace Amelia\Shop\Services\Billing\Tax;

interface TaxService {
	/**
	 * Apply relevant taxes to a price.
	 *
	 * @param float $price
	 * @return mixed
	 */
	public function apply($price);
}
