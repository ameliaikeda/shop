<?php namespace Amelia\Shop\Services\Cart;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Session\Store;
use Amelia\Shop\Product;
use Illuminate\Support\Collection;

class SessionCartService implements CartService {

	/**
	 * Cart contents
	 *
	 * @var string
	 */
	protected $key = "shop:cart:contents";

	/**
	 * Collection to hold the cart
	 *
	 * @var \Illuminate\Support\Collection
	 */
	protected $cart;

	/**
	 * @var \Illuminate\Contracts\Auth\User|null
	 */
	protected $user;

	/**
	 * @var \Illuminate\Session\Store
	 */
	protected $session;

	/**
	 * Go bananas with a cart constructor
	 *
	 * @param \Illuminate\Contracts\Auth\Guard $auth
	 * @param \Illuminate\Session\Store        $session
	 */
	public function __construct(Guard $auth, Store $session) {
		$this->user = $auth->user();
		$this->session = $session;
		$this->load();
	}

	/**
	 * Format an input id and options
	 *
	 * @param       $id
	 * @param array $options
	 * @return array
	 */
	protected function format($id, array $options = array()) {
		return [
			"product_id" => $id,
			"quantity" => 1,
			"options" => $options,
		];
	}

	/**
	 * Generate a row ID
	 *
	 * @param       $id
	 * @param array $options
	 * @return string
	 */
	protected function generate($id, array $options) {
		return hash("sha512", serialize(compact('id', 'options')));
	}

	/**
	 * Add a product to the cart by ID with options and return a row ID
	 *
	 * @param       $id
	 * @param array $options
	 * @return string
	 */
	public function add($id, $options = []) {
		$row = $this->generate($id, $options);

		if (!$this->cart->has($row)) {
			$this->insert($id, $options);
		} else {
			$this->increment($row);
		}

		return $row;
	}

	protected function insert($id, array $options) {
		$row = $this->generate($id, $options);
		$this->cart->put($row, $this->format($id, $options));
		$this->save();
	}

	/**
	 * Remove a product by row ID
	 *
	 * @param string $row
	 * @return mixed
	 */
	public function remove($row) {
		$this->cart->forget($row);
		$this->save();
	}

	/**
	 * Increment a row by row ID
	 *
	 * @param $row
	 * @return bool success
	 *
	 * @throws \App\Services\Cart\CartException
	 */
	public function increment($row) {
		$this->quantity($row, 1);
	}

	/**
	 * Decrement a row by row ID
	 *
	 * @param $row
	 * @return bool success
	 */
	public function decrement($row) {
		$this->quantity($row, -1);
	}

	/**
	 * Change quantity of a row by a given amount
	 *
	 * @param string $row
	 * @param int    $quantity the amount to change by
	 * @return bool
	 *
	 * @throws \App\Services\Cart\CartException
	 */
	public function quantity($row, $quantity) {
		if (!$item = $this->cart->get($row)) {
			throw new CartException("Trying to increment a non-existent row ({$row})");
		}

		$item["quantity"] += $quantity;

		if ($item["quantity"] <= 0) {
			$this->remove($row);
		}

		$this->cart->forget($row);
		$this->cart->put($row, $item);
		$this->save();
	}

	/**
	 * Get all products in the cart
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function get() {
		return $this->cart->all();
	}

	/**
	 * Checkout this cart and create a user with an order.
	 *
	 * @return mixed
	 */
	public function checkout() {
		// TODO: Implement checkout() method.
	}

	/**
	 * Save the current cart.
	 */
	protected function save() {
		$this->session->put($this->key, serialize($this->cart->items()));
	}

	/**
	 * Load the current cart.
	 */
	protected function load() {
		$cart = $this->session->get($this->key) ?: [];
		$this->cart = new Collection($cart);
	}
}