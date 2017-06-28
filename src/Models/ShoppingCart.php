<?php

namespace Warchiefs\ShoppingCart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ShoppingCart extends Model
{
	public $table = 'shopping_carts';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $guarded = [
		'id'
	];

	/**
	 * Cart content of current user
	 *
	 * @var \App\ShoppingCart
	 */
	private $cart_content;

	/**
	 * ShoppingCart constructor.
	 */
	public function __construct($user_id = null)
	{
		$this->cart_content = ShoppingCart::where('user_id', ($user_id) ? $user_id : Auth::user()->id)->first();
	}

	/**
	 * User relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\User', 'id', 'user_id');
	}

	/**
	 * Goods relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function goods()
	{
		return $this->belongsToMany(config('shopping_cart.goods_entity'), 'shopping_cart_content', 'cart_id', 'good_id');
	}

	/**
	 * Get shopping cart for current user
	 * Return array with total price, goods amount and array of goods
	 *
	 * @param bool $code
	 *
	 * @return array
	 */
	public function getCart($code = false)
	{
		$total_price = $this->cart_content->goods()->sum(config('shopping_cart.goods_price_collumn'));

		if($code) {
			$code = ShoppingCartCode::where('code', $code)->first();

			switch ($code->type) {
				case 'percent':
					$total_price -= ($total_price * $code->amount) / 100;
					break;
				case 'fixed':
					$total_price -= $code->amount;
					break;
			}
		}

		if($total_price < 0) {
			$total_price = 0;
		}

		$cart = [
			'total_price' => $total_price,
			'total_amount' => count($this->cart_content->goods),
			'content' => $this->cart_content->goods->toArray()
		];

		return $cart;
	}

	/**
	 * Add good to shopping cart
	 *
	 * @param $good_id
	 *
	 * @return array
	 */
	public function add($good_id)
	{
		$this->cart_content->goods()->attach($good_id);

		return $this->getCart();
	}

	/**
	 * Clear shopping cart
	 *
	 * @return array
	 */
	public function clear()
	{
		$this->cart_content->goods()->detach();

		return $this->getCart();
	}

	/**
	 * Remove item from shopping cart
	 *
	 * @param $good_id
	 *
	 * @return array
	 */
	public function remove($good_id)
	{
		$this->cart_content->goods()->detach($good_id);

		return $this->getCart();
	}

}
