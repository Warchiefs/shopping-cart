<?php

namespace Warchiefs\ShoppingCart\Controllers;

use ShoppingCart\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
	/**
	 * Need auth for use shopping cart
	 *
	 * ShoppingCartController constructor.
	 */
    public function __construct()
    {
	    $this->middleware(config('shopping_cart.middleware'));
    }

	/**
	 * Get current user's shopping cart
	 *
	 * @param bool $code
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function get($code = false)
    {
		return response()->json((new ShoppingCart())->getCart());
    }

	/**
	 * Clear current users's shopping cart
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function clear()
    {
	    return response()->json((new ShoppingCart())->clear());
    }

	/**
	 * Add good to current users's shopping cart
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function add(Request $request)
    {
	    $this->validate($request, [
		    'good_id' => 'required'
	    ]);

	    return response()->json((new ShoppingCart())->add($request->get('good_id')));
    }

	/**
	 * Remove good from current user's shopping cart
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function remove(Request $request)
    {
	    $this->validate($request, [
		    'good_id' => 'required'
	    ]);

	    return response()->json((new ShoppingCart())->remove($request->get('good_id')));
    }
}
