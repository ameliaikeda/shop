<?php namespace Amelia\Shop\Services\Billing;

use Illuminate\Contracts\Config\Repository;
use Stripe;
use Stripe_Charge;

class StripeBillingService implements BillingService {

	/**
	 * Tax to apply to billing, etc.
	 *
	 * @var \App\Services\Billing\TaxService
	 */
	protected $tax;

	/**
	 * Initialize with a tax service and the current user.
	 *
	 * @param \App\Services\Billing\TaxService        $taxService
	 * @param \Illuminate\Contracts\Config\Repository $config
	 */
	public function __construct(TaxService $taxService, Repository $config) {
		$this->tax = $taxService;
		$this->config = $config;
		Stripe::setApiKey($config->get("services.stripe.secret"));
	}

	/**
	 * Bill a card for a given amount.
	 *
	 * @param array $data
	 * @return mixed|\Stripe_Charge
	 */
	public function charge(array $data) {
		$result = Stripe_Charge::create([
			"card" => $this->tax->apply($data["token"]),
			"amount" => $data["amount"],
			"currency" => $this->config->get("shop.currency"),
			"description" => $data["order"],
		]);

		return $result;
	}
}