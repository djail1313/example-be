<?php

namespace Islami\Products\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Islami\Products\Application\Queries\Product\Specification\ProductFilterSpecification;
use Islami\Products\Domain\Model\ProductRepository;
use Islami\Products\Application\Queries\Product\ProductRepository as QueryProductRepository;
use Islami\Products\Infrastructure\Domain\Model\Product\MoloquentProductRepository;
use Islami\Products\Infrastructure\Queries\Product\MoloquentProductRepository as QueryMoloquentProductRepository;
use Islami\Products\Infrastructure\Queries\Product\Specification\MoloquentProductFilterSpecification;

class ProductsServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->registerDependencyInjections();
        $this->loadMigrationsFrom(__DIR__ . '/../Infrastructure/Persistence/Moloquent/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Infrastructure/Config/config.php' => config_path('products.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Infrastructure/Config/config.php', 'products'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/products');

        $sourcePath = __DIR__.'/../Interfaces/Web/Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/products';
        }, \Config::get('view.paths')), [$sourcePath]), 'products');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/products');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'products');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'products');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(__DIR__ . '/../Infrastructure/Persistence/Moloquent/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    public function registerDependencyInjections()
    {
        // Domain
        $this->app->bind(ProductRepository::class, MoloquentProductRepository::class);

        // Query
        $this->app->bind(QueryProductRepository::class, QueryMoloquentProductRepository::class);
        $this->app->bind(ProductFilterSpecification::class, MoloquentProductFilterSpecification::class);
    }
}
