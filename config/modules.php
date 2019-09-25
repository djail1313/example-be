<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Module Namespace
    |--------------------------------------------------------------------------
    |
    | Default module namespace.
    |
    */

    'namespace' => 'Islami',

    /*
    |--------------------------------------------------------------------------
    | Module Stubs
    |--------------------------------------------------------------------------
    |
    | Default module stubs.
    |
    */

    'stubs' => [
        'enabled' => false,
        'path' => base_path() . '/vendor/nwidart/laravel-modules/src/Commands/stubs',
        'files' => [
            'routes/web' => 'Interfaces/Web/Http/routes.php',
            'routes/api' => 'Interfaces/Api/Http/routes.php',
            'views/index' => 'Interfaces/Web/Resources/views/index.blade.php',
            'views/master' => 'Interfaces/Web/Resources/views/layouts/master.blade.php',
            'scaffold/config' => 'Infrastructure/Config/config.php',
            'composer' => 'composer.json',
            'assets/js/app' => 'Interfaces/Web/Resources/assets/js/app.js',
            'assets/sass/app' => 'Interfaces/Web/Resources/assets/sass/app.scss',
            'webpack' => 'webpack.mix.js',
            'package' => 'package.json',
        ],
        'replacements' => [
            'routes/web' => ['LOWER_NAME', 'STUDLY_NAME'],
            'routes/api' => ['LOWER_NAME'],
            'webpack' => ['LOWER_NAME'],
            'json' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE'],
            'views/index' => ['LOWER_NAME'],
            'views/master' => ['LOWER_NAME', 'STUDLY_NAME'],
            'scaffold/config' => ['STUDLY_NAME'],
            'composer' => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'VENDOR',
                'AUTHOR_NAME',
                'AUTHOR_EMAIL',
                'MODULE_NAMESPACE',
            ],
        ],
        'gitkeep' => true,
    ],
    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Modules path
        |--------------------------------------------------------------------------
        |
        | This path used for save the generated module. This path also will be added
        | automatically to list of scanned folders.
        |
        */

        'modules' => base_path('Islami'),
        /*
        |--------------------------------------------------------------------------
        | Modules assets path
        |--------------------------------------------------------------------------
        |
        | Here you may update the modules assets path.
        |
        */

        'assets' => public_path('modules'),
        /*
        |--------------------------------------------------------------------------
        | The migrations path
        |--------------------------------------------------------------------------
        |
        | Where you run 'module:publish-migration' command, where do you publish the
        | the migration files?
        |
        */

        'migration' => base_path('database/migrations'),
        /*
        |--------------------------------------------------------------------------
        | Generator path
        |--------------------------------------------------------------------------
        | Customise the paths where the folders will be generated.
        | Set the generate key to false to not generate that folder
        */
        'generator' => [
            'provider' => ['path' => 'Providers', 'generate' => true],
            'domain-model' => ['path' => 'Domain/Model', 'generate' => true],
            'domain-service' => ['path' => 'Domain/Service', 'generate' => true],
            'domain-event' => ['path' => 'Domain/Event', 'generate' => true],
            'shared-domain' => ['path' => 'Shared/Domain/Model', 'generate' => true],
            'shared-exception' => ['path' => 'Shared/Exceptions', 'generate' => true],
            'application' => ['path' => 'Application', 'generate' => true],
            'application-command' => ['path' => 'Application/Commands', 'generate' => true],
            'application-query' => ['path' => 'Application/Queries', 'generate' => true],
            'application-event' => ['path' => 'Application/Events', 'generate' => true],
            'infrastructure-domain' => ['path' => 'Infrastructure/Domain/Model', 'generate' => true],
            'infrastructure-application-query' => ['path' => 'Infrastructure/Queries/Repositories', 'generate' => true],
            'config' => ['path' => 'Infrastructure/Config', 'generate' => true],
            'migration' => ['path' => 'Infrastructure/Persistence/Moloquent/Migrations', 'generate' => true],
            'seeder' => ['path' => 'Infrastructure/Persistence/Moloquent/Seeders', 'generate' => true],
            'factory' => ['path' => 'Infrastructure/Persistence/Moloquent/factories', 'generate' => true],
            'command' => ['path' => 'Interfaces/Console', 'generate' => true],
            'controller' => ['path' => 'Interfaces/Web/Http/Controllers', 'generate' => true],
            'filter' => ['path' => 'Interfaces/Web/Http/Middleware', 'generate' => true],
            'request' => ['path' => 'Interfaces/Web/Http/Requests', 'generate' => true],
            'assets' => ['path' => 'Interfaces/Web/Resources/assets', 'generate' => true],
            'views' => ['path' => 'Interfaces/Web/Resources/views', 'generate' => true],
            'api-controller' => ['path' => 'Interfaces/Api/Http/Controllers', 'generate' => true],
            'api-filter' => ['path' => 'Interfaces/Api/Http/Middleware', 'generate' => true],
            'api-request' => ['path' => 'Interfaces/Api/Http/Requests', 'generate' => true],
            'lang' => ['path' => 'Resources/lang', 'generate' => true],
            'test' => ['path' => 'Tests/Unit', 'generate' => true],
            'test-feature' => ['path' => 'Tests/Feature', 'generate' => true],
            'model' => ['path' => 'Entities', 'generate' => false],
            'repository' => ['path' => 'Repositories', 'generate' => false],
            'event' => ['path' => 'Events', 'generate' => false],
            'listener' => ['path' => 'Listeners', 'generate' => false],
            'policies' => ['path' => 'Policies', 'generate' => false],
            'rules' => ['path' => 'Rules', 'generate' => false],
            'jobs' => ['path' => 'Jobs', 'generate' => false],
            'emails' => ['path' => 'Emails', 'generate' => false],
            'notifications' => ['path' => 'Notifications', 'generate' => false],
            'resource' => ['path' => 'Transformers', 'generate' => false],
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Scan Path
    |--------------------------------------------------------------------------
    |
    | Here you define which folder will be scanned. By default will scan vendor
    | directory. This is useful if you host the package in packagist website.
    |
    */

    'scan' => [
        'enabled' => false,
        'paths' => [
            base_path('vendor/*/*'),
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Composer File Template
    |--------------------------------------------------------------------------
    |
    | Here is the config for composer.json file, generated by this package
    |
    */

    'composer' => [
        'vendor' => 'Bahaso',
        'author' => [
            'name' => 'Developer Bahaso',
            'email' => 'info@bahaso.com',
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Here is the config for setting up caching feature.
    |
    */
    'cache' => [
        'enabled' => true,
        'key' => 'laravel-modules',
        'lifetime' => 60,
    ],
    /*
    |--------------------------------------------------------------------------
    | Choose what laravel-modules will register as custom namespaces.
    | Setting one to false will require you to register that part
    | in your own Service Provider class.
    |--------------------------------------------------------------------------
    */
    'register' => [
        'translations' => true,
        /**
         * load files on boot or register method
         *
         * Note: boot not compatible with asgardcms
         *
         * @example boot|register
         */
        'files' => 'register',
    ],
];
