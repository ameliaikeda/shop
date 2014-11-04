<?php namespace Amelia\Shop\Repositories;

use Amelia\Shop\Shipping;

class EloquentShippingRepository implements ShippingRepository {

	/**
	 * Get an item by primary key
	 *
	 * @param int $id
	 * @return mixed
	 */
	public function get($id) {
		return $this->findById($id);
	}

	/**
	 * Create a new item from attributes and return + save it
	 *
	 * @param array $attributes
	 * @return mixed
	 */
	public function create(array $attributes) {
		return Shipping::create($attributes);
	}

	/**
	 * Create a new instance without saving it
	 *
	 * @param array $attributes
	 * @return mixed
	 */
	public function newInstance(array $attributes) {
		return Shipping::newInstance($attributes);
	}

	/**
	 * Find an item by a given attribute condition
	 *
	 * @param array $conditions
	 * @return mixed
	 */
	public function find(array $conditions) {
		return Shipping::find($conditions);
	}

	/**
	 * Find an item by ID
	 *
	 * @param $id
	 * @return mixed
	 */
	public function findById($id) {
		return Shipping::find($id);
	}

	/**
	 * Return all items
	 *
	 * @return mixed
	 */
	public function all() {
		return Shipping::all();
	}

	/**
	 * Paginate the contents of ->all()
	 *
	 * @param $amount
	 * @return mixed
	 */
	public function paginate($amount) {
		return Shipping::all()->paginate($amount);
	}

	/**
	 * Delete the given item
	 *
	 * @param $id
	 * @return mixed
	 */
	public function delete($id) {
		$shipping = $this->findById($id);
		return $shipping->delete();
	}

	/**
	 * Update the given item with an array of attributes
	 *
	 * @param       $id
	 * @param array $attributes
	 * @return mixed
	 */
	public function update($id, array $attributes) {
		$shipping = $this->findById($id);
		return $shipping->update($attributes);
	}
}