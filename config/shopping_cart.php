<?php
return [

	/*
	 * Middleware for use shopping cart
	 */
	'middleware' => 'auth',

	/*
	 * Goods integration settings
	 */
	'goods_entity'                  => 'App\Good',
	'goods_primary_collumn'         => 'id',
	'goods_price_collumn'           => 'price'



];