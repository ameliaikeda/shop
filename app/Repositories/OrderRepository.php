<?php namespace Amelia\Shop\Repositories;

use Amelia\Shop\Contracts\Order;

interface OrderRepository {

	/**
	 * Get a customer's orders
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function get();

	/**
	 * Add an order to the repository
	 *
	 * @param \App\Contracts\Order $order
	 * @return mixed
	 */
	public function add(Order $order);

	/**
	 * Cancel an order.
	 *
	 * @param \App\Contracts\Order $order
	 * @return mixed
	 */
	public function cancel(Order $order);
}
