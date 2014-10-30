<?php namespace Amelia\Shop\Repositories;

interface CustomerRepository {

	/**
	 * Get the customer in question, or the first of a collection of customers.
	 *
	 * @return \App\Contracts\Customer|null
	 */
	public function get();
}