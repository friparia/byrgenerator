<?php namespace Friparia\Byrgenerator;

use Illuminate\Support\ServiceProvider;

class ByrgeneratorServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('friparia/byrgenerator');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

        $this->app->booting(function(){
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Byrgenerator', 'Friparia\Byrgenerator\Facades\Byrgenerator');
        });

        $this->app['byrgenerator'] = $this->app->share(function($app){
            return new Byrgenerator;
        });

        $this->app['command.byrgenerator.init'] = $this->app->share(function($app){
            return new InitCommand($app);
        });

        $this->app['command.byrgenerator.generate'] = $this->app->share(function($app){
            return new GenerateCommand($app);
        });

        $this->commands(
            'command.byrgenerator.init',
            'command.byrgenerator.generate'
        );
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
