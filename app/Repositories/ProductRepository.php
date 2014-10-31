<?php namespace Amelia\Shop\Repositories;

interface ProductRepository extends Repository {

	/**
	 * Get a product by slug
	 *
	 * @param int $slug
	 * @return mixed
	 */
	public function get($slug);

	/**
	 * Filter products using a given array of input
	 *
	 * @param array $input
	 * @return mixed
	 */
	public function filter(array $input);
}