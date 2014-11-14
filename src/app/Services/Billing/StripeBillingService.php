<?php namespace Amelia\Shop\Services\Billing;

use Amelia\Shop\Exceptions\BillingException;
use Amelia\Shop\Services\Billing\Tax\TaxService;
use Amelia\Shop\Services\Shipping\ShippingService;
use Illuminate\Contracts\Config\Repository;
use Stripe;
use Stripe_Charge;

class StripeBillingService implements BillingService {

	/**
	 * Tax to apply to billing, etc.
	 *
	 * @var \Amelia\Shop\Services\Billing\TaxService
	 */
	protected $tax;

	/**
	 * Shipping cost calculation
	 *
	 * @var \Amelia\Shop\Services\Shipping\ShippingService
	 */
	protected $shipping;

	/**
	 * Initialize with a tax service and the current user.
	 *
	 * @param \Amelia\Shop\Services\Billing\Tax\TaxService   $taxService
	 * @param \Amelia\Shop\Services\Shipping\ShippingService $shippingService
	 * @param \Illuminate\Contracts\Config\Repository        $config
	 */
	public function __construct(TaxService $taxService, ShippingService $shippingService, Repository $config) {
		$this->tax = $taxService;
		$this->shipping = $shippingService;
		$this->config = $config;
		Stripe::setApiKey($config->get("services.stripe.secret"));
	}

	/**
	 * Bill a card for a given amount.
	 *
	 * @param array $data
	 * @return mixed|\Stripe_Charge
	 *
	 * @throws \Amelia\Shop\Exceptions\BillingException
	 */
	public function charge(array $data) {
		if (! isset($data["amount"]))
			throw new BillingException("[amount] is required when attempting to charge");

		$subtotal = $this->shipping->apply($data);
		$total = $this->tax->apply($subtotal);

		$result = Stripe_Charge::create([
			"card" => $data["token"],
			"amount" => $total,
			"currency" => $this->config->get("shop.currency"),
			"description" => $data["order"],
		]);

		return $result;
	}
}