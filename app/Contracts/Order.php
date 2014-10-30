<?php namespace Amelia\Shop\Contracts;


/**
 * @property \App\Contracts\Customer        $customer
 * @property \Illuminate\Support\Collection $products
 * @property \App\Contracts\Card            $card
 */
interface Order {
	/**
	 * Get the order's products
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function products();

	/**
	 * Get the customer that placed the order
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function customer();

	/**
	 * Fetch the card used for this order
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function card();

	/**
	 * Save a model
	 *
	 * @return $this
	 */
	public function save();
}
