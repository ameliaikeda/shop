<?php namespace Amelia\Shop\Contracts;

/**
 * @property string $token
 * @property
 */
interface Card {

	/**
	 * Fetch a user from a card
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user();
}
