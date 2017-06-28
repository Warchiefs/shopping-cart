<?php

namespace Warchiefs\ShoppingCart\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartCode extends Model
{
	public $table = 'shopping_cart_codes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'code', 'type', 'amount'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $guarded = [
		'id'
	];
}
