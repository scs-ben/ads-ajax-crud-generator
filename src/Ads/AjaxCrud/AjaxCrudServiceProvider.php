<?php namespace Ads\AjaxCrud;

use Statistic;
use Illuminate\Support\ServiceProvider;

class AjaxCrudServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		// Publish the config file
		$this->publishes([
				__DIR__.'/config/ajaxCrud.php' => config_path('ajaxCrud.php'),
		]);
		
		// Publish partial files to storage path
		$this->publishes([
				__DIR__.'/views/partials/modals/' => base_path('resources/views/partials/modals'),
				__DIR__.'/storage/crudStubs/' => storage_path('app/crudStubs'),
				__DIR__.'/Commands/' => app_path('Console/Commands'),
		]);
	}
	
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
		    __DIR__.'/config/ajaxCrud.php', 'ajaxCrud'
		);
		
		// Publish partial files to storage path
		$this->publishes([
				__DIR__.'/views/partials/modals/' => base_path('resources/views/partials/modals'),
				__DIR__.'/storage/crudStubs/' => storage_path('crudStubs'),
				__DIR__.'/Commands/' => app_path('Console/Commands'),
		]);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
// 	public function provides()
// 	{
// 		return [];
// 	}

}
