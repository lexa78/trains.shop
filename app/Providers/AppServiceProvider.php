<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Validator::extend('alpha_spaces', function($attribute, $value)
		{
			return preg_match('/^[\pL\s]+$/u', $value);
		});
		Validator::extend('alpha_spaces_numbers', function($attribute, $value)
		{
			return preg_match('/^[\pL\s\d.,:\-\/]+$/u', $value);
		});
		Validator::extend('alpha_spaces_numbers_etc', function($attribute, $value)
		{
			return preg_match('/^[\pL\s\d.,:();\-\/]+$/u', $value);
		});

		Validator::extend('chars_numbers_spaces', function($attribute, $value)
		{
			return preg_match('/^[\pL\s\d]+$/u', $value);
		});
		Validator::extend('chars_numbers_spaces_dot', function($attribute, $value)
		{
			return preg_match('/^[\pL\s\d.]+$/u', $value);
		});
		Validator::extend('chars_numbers_spaces_dot_numberSymbol', function($attribute, $value)
		{
			return preg_match('/^[\pL\s\d.№]+$/u', $value);
		});
		Validator::extend('only_numbers_like_string', function($attribute, $value)
		{
			return preg_match('/^[\d]+$/u', $value);
		});
		Validator::extend('numbers_brackets_defis_spaces', function($attribute, $value)
		{
			return preg_match('/^[\d\s\-()]+$/u', $value);
		});

	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
