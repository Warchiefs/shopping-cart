# shopping-cart
Simple shopping cart module for Laravel 5.4

# Config
<code>
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
</code>

# Use example

Get current user's shopping cart
<code>
    (new ShoppingCart())->getCart();
</code>

Clear current user's shopping cart
<code>
    (new ShoppingCart())->clear();
</code>

Add good to current user's shopping cart
<code>
    (new ShoppingCart())->add($good_id);
</code>

Remove good from current user's shopping cart
<code>
    (new ShoppingCart())->remove($good_id);
</code>
