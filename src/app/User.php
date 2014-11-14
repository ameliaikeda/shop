<?php namespace Amelia\Shop;

use Illuminate\Auth\UserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\User as UserContract;
use Illuminate\Auth\Passwords\CanResetPasswordTrait;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements UserContract, CanResetPasswordContract {

	use UserTrait, CanResetPasswordTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token', 'admin'];

	/**
	 * Mass-assignable attribute
	 *
	 * @var array
	 */
	protected $fillable = ['email', 'name'];

	/**
	 * Fetch the user's orders.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Relations\HasMany|null
	 */
	public function orders() {
		return $this->hasMany('Order');
	}

	/**
	 * Fetch a list of products a user has ordered
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
	public function products() {
		return $this->hasManyThrough('Product', 'Order');
	}

	/**
	 * Fetch a user's card details
	 *
	 * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasOne|null
	 */
	public function card() {
		return $this->hasOne('Card');
	}

	/**
	 * Fetch a user's address
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function address() {
		return $this->hasOne('Address');
	}
}
