<?php namespace Amelia\Shop\Repositories;

interface Repository {

	/**
	 * Get an item by primary key
	 *
	 * @param int $id
	 * @return mixed
	 */
	public function get($id);

	/**
	 * Create a new item from attributes and return + save it
	 *
	 * @param array $attributes
	 * @return mixed
	 */
	public function create(array $attributes);

	/**
	 * Create a new instance without saving it
	 *
	 * @param array $attributes
	 * @return mixed
	 */
	public function newInstance(array $attributes);

	/**
	 * Find an item by a given attribute condition
	 *
	 * @param array $conditions
	 * @return mixed
	 */
	public function find(array $conditions);

	/**
	 * Find an item by ID
	 *
	 * @param $id
	 * @return mixed
	 */
	public function findById($id);

	/**
	 * Return all items
	 *
	 * @return mixed
	 */
	public function all();

	/**
	 * Paginate the contents of ->all()
	 *
	 * @param $amount
	 * @return mixed
	 */
	public function paginate($amount);

	/**
	 * Delete the given item
	 *
	 * @param $id
	 * @return mixed
	 */
	public function delete($id);

	/**
	 * Update the given item with an array of attributes
	 *
	 * @param       $id
	 * @param array $attributes
	 * @return mixed
	 */
	public function update($id, array $attributes);
}
