<?php namespace Amelia\Shop\Repositories;

use Illuminate\Contracts\Auth\Guard as Authenticator;

class EloquentCustomerRepository implements CustomerRepository {

	public function __construct(Authenticator $auth) {
		$this->customer = $auth->user();
	}

	/**
	 * Get the customer in question, or the first of a collection of customers.
	 *
	 * @return \Amelia\Shop\Contracts\Customer|null
	 */
	public function get() {
		return $this->customer;
	}

}