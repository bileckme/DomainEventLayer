<?php namespace Domain\EventLayer;

use Illuminate\Support\ServiceProvider;

/**
 * Class DomainApiServiceProvider
 * @package Domain\Api
 */
class DomainEventLayerServiceProvider extends ServiceProvider
{

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
        $this->package('domain/eventlayer');
        $this->setConnection();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['eventlayer'];
    }

    /**
     * Gets Laravel Application instance
     * @return \Illuminate\Foundation\Application
     */
    protected function getApp()
    {
        return $this->app;
    }

    /**
     * Sets database connection
     */
    protected function setConnection()
    {
        $connection = $this->app['config']->get('api::database.default');

        if ($connection !== 'default'){
            $wardrobeConfig = $this->app['config']->get('api::database.connections.'.$connection);
        } else {
            $connection = $this->app['config']->get('database.default');
            $wardrobeConfig = $this->app['config']->get('database.connections.'.$connection);
        }
        $this->app['config']->set('database.connections.api', $wardrobeConfig);
        $this->app['config']->set('database.default', 'api');
    }
}
