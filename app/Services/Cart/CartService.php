<?php namespace Amelia\Shop\Services\Cart;

use Amelia\Shop\Contracts\Customer;
use Amelia\Shop\Contracts\Product;

interface CartService {

	/**
	 * Add a product to the cart by ID with options and return a row ID
	 *
	 * @param       $id
	 * @param array $options
	 * @return string
	 */
	public function add($id, $options = []);

	/**
	 * Remove a product by row ID
	 *
	 * @param string $row
	 * @return void
	 */
	public function remove($row);

	/**
	 * Increment a row by row ID
	 *
	 * @param $row
	 * @return void
	 */
	public function increment($row);

	/**
	 * Decrement a row by row ID
	 *
	 * @param $row
	 * @return void
	 */
	public function decrement($row);

	/**
	 * Change quantity of a row by a given amount
	 *
	 * @param string $row
	 * @param int    $quantity the amount to change by
	 * @return void
	 *
	 * @throws \App\Services\Cart\CartException
	 */
	public function quantity($row, $quantity);

	/**
	 * Get all products in the cart
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function get();

	/**
	 * Checkout this cart and create a user with an order.
	 *
	 * @return mixed
	 */
	public function checkout();
}
