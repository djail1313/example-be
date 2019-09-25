<?php


namespace Islami\Shared\Providers;


use Illuminate\Support\ServiceProvider;
use Islami\Shared\Bus\Event\DomainSerializer;
use Islami\Shared\Bus\Event\EventStoreRepository;
use Islami\Shared\Bus\Event\PayloadSerializer;
use Islami\Shared\Infrastructure\Application\Command\Middleware\CommandBusMiddleware;
use Islami\Shared\Infrastructure\Bus\Event\JsonDomainSerializer;
use Islami\Shared\Infrastructure\Bus\Event\JsonPayloadSerializer;
use Islami\Shared\Infrastructure\Persistence\Bus\Event\EventStore\MoloquentEventStoreRepository;
use Islami\Shared\Infrastructure\Persistence\Moloquent\MoloquentTransactionManager;
use Islami\Shared\Infrastructure\Persistence\Moloquent\Mongodb\Connection;
use Islami\Shared\Infrastructure\Persistence\Moloquent\Mongodb\Eloquent\Model;
use Islami\Shared\Infrastructure\Persistence\TransactionManager;
use Jenssegers\Mongodb\Queue\MongoConnector;

class SharedServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->registerBusMiddleware();
        $this->registerDependencyInjection();
        $this->registerCustomMoloquent();
        $this->enableQueryLog();
        $this->registerConfig();
        $this->loadMigrationsFrom(__DIR__ . '/../Infrastructure/Persistence/Moloquent/Migrations');

    }

    public function register()
    {

        $this->app->resolving('db', function ($db) {
            $db->extend('mongodb', function ($config, $name) {
                $config['name'] = $name;

                return new Connection($config);
            });
        });

        $this->app->resolving('queue', function ($queue) {
            $queue->addConnector('mongodb', function () {
                return new MongoConnector($this->app['db']);
            });
        });

    }
    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Infrastructure/Config/config.php' => config_path('shared.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Infrastructure/Config/config.php', 'shared'
        );
    }

    private function registerBusMiddleware()
    {
        \Bus::pipeThrough([CommandBusMiddleware::class]);
    }

    private function registerDependencyInjection()
    {
        $this->app->bind(TransactionManager::class, MoloquentTransactionManager::class);
        $this->app->bind(DomainSerializer::class, JsonDomainSerializer::class);
        $this->app->bind(PayloadSerializer::class, JsonPayloadSerializer::class);
        $this->app->bind(EventStoreRepository::class, MoloquentEventStoreRepository::class);
    }

    private function registerCustomMoloquent()
    {
        Model::setConnectionResolver($this->app['db']);
        Model::setEventDispatcher($this->app['events']);
    }

    private function enableQueryLog()
    {
        \DB::enableQueryLog();
    }
}
