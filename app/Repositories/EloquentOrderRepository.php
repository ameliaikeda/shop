<?php namespace Amelia\Shop\Repositories;

use Amelia\Shop\Order as O;
use Amelia\Shop\Contracts\Order;
use Illuminate\Contracts\Auth\Guard as Authenticator;

class EloquentOrderRepository implements OrderRepository {

	/**
	 * @var \Illuminate\Contracts\Auth\User|null
	 */
	protected $customer;

	/**
	 * @var \Illuminate\Support\Collection|static
	 */
	protected $orders;

	/**
	 * Inject the eloquent model for orders and the authenticator for the current user.
	 *
	 * @param \Illuminate\Contracts\Auth\Guard $auth
	 */
	public function __construct(Authenticator $auth) {
		$this->customer = $auth->user();
		$this->orders = O::findOrFail($this->customer->id, ["user_id"]);
	}

	/**
	 * Get a customer's orders
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function get() {
		return $this->orders;
	}

	/**
	 * Add an order to the repository
	 *
	 * @param \Amelia\Shop\Contracts\Order $order
	 * @return mixed
	 */
	public function add(Order $order) {
		// TODO: Implement add() method.
	}

	/**
	 * Cancel an order.
	 *
	 * @param \Amelia\Shop\Contracts\Order $order
	 * @return mixed
	 */
	public function cancel(Order $order) {
		// TODO: Implement cancel() method.
	}
}
