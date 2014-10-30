<?php namespace Amelia\Shop\Services\Billing;

interface BillingService {

	/**
	 * Bill for a given amount.
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function charge(array $data);
}
