<?php namespace Amelia\Shop;

use Amelia\Shop\Contracts\Product as ProductContract;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements ProductContract {

	protected $fillable = [];

	/**
	 * Polymorphic join for options to attach to a Product
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function options() {
		return $this->morphMany('Option', 'option');
	}
}
