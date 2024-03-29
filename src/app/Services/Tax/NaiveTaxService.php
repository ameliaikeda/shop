<?php namespace Amelia\Shop\Services\Billing\Tax;

class NaiveTaxService implements TaxService {

	/**
	 * Apply relevant taxes to a price.
	 *
	 * @param float $price
	 * @return mixed
	 */
	public function apply($price) {
		return $price; // we don't care about tax.
	}
}
