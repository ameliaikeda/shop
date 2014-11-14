<?php namespace Amelia\Shop\Contracts;

/**
 * @property \Illuminate\Database\Eloquent\Model|null $card
 * @property \Illuminate\Database\Eloquent\Model|null $address
 * @property \Illuminate\Database\Eloquent\Collection $orders
 * @property \Illuminate\Database\Eloquent\Collection $products
 */
interface Customer {

	/**
	 * Fetch the user's orders.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Relations\HasMany|null
	 */
	public function orders();

	/**
	 * Fetch a list of products a user has ordered
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
	public function products();

	/**
	 * Fetch a user's card details
	 *
	 * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasOne|null
	 */
	public function card();

	/**
	 * Fetch a user's address
	 *
	 * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasOne|null
	 */
	public function address();
}
