<?php namespace Amelia\Shop;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

	protected $fillable = [];

	/**
	 * Get the order's products
	 *
	 * @return $this
	 */
	public function products() {
		return $this->belongsToMany('Product')->withPivot('quantity');
	}

	/**
	 * Get the customer that placed the order
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function customer() {
		return $this->belongsTo('User');
	}

	/**
	 * Fetch the card used for this order
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function card() {
		return $this->belongsTo('Card');
	}

}
