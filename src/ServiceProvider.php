<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ShoppingProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load routes
		$this->loadRoutesFrom(__DIR__.'/routes.php');

		$this->loadMigrationsFrom(__DIR__.'/Migrations');

		// publish config
		$this->publishes([
			__DIR__.'/../config/shopping_cart.php' => config_path('shopping_cart.php'),
		]);


	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
