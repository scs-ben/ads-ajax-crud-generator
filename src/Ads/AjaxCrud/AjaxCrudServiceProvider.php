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
			__DIR__.'/config/ajaxCrud.php' => config_path('ajaxCrud.php')
		], 'config');
		
		// Publish partial files to storage path
		$this->publishes([
			__DIR__.'/views/partials/modals/' => base_path('resources/views/partials/modals')
		], 'assets');
		
		$this->publishes([
			__DIR__.'/storage/crudStubs/' => storage_path('app/crudStubs')
		], 'partials');
			
		$this->publishes([
			__DIR__.'/Commands/' => app_path('Console/Commands')
		], 'commands');
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
