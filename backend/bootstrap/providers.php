<?php

declare(strict_types=1);

use App\Container\Application;

/*
|--------------------------------------------------------------------------
| Framework Service Providers
|--------------------------------------------------------------------------
|
| Register all application service providers here.
| Providers are loaded in the order listed below.
|
*/

return static function (Application $app): void {

    $providers = [

        /*
        |--------------------------------------------------------------------------
        | Core Framework Providers
        |--------------------------------------------------------------------------
        */

        // App\Providers\ConfigServiceProvider::class,
        // App\Providers\EventServiceProvider::class,
        // App\Providers\RoutingServiceProvider::class,
        // App\Providers\DatabaseServiceProvider::class,
        // App\Providers\CacheServiceProvider::class,

        /*
        |--------------------------------------------------------------------------
        | Authentication
        |--------------------------------------------------------------------------
        */

        // App\Providers\AuthServiceProvider::class,

        /*
        |--------------------------------------------------------------------------
        | Authorization
        |--------------------------------------------------------------------------
        */

        // App\Providers\GateServiceProvider::class,

        /*
        |--------------------------------------------------------------------------
        | Storage
        |--------------------------------------------------------------------------
        */

        // App\Providers\StorageServiceProvider::class,

        /*
        |--------------------------------------------------------------------------
        | Mail
        |--------------------------------------------------------------------------
        */

        // App\Providers\MailServiceProvider::class,

        /*
        |--------------------------------------------------------------------------
        | Queue
        |--------------------------------------------------------------------------
        */

        // App\Providers\QueueServiceProvider::class,

        /*
        |--------------------------------------------------------------------------
        | Event & Broadcasting
        |--------------------------------------------------------------------------
        */

        // App\Providers\BroadcastServiceProvider::class,

        /*
        |--------------------------------------------------------------------------
        | Application Providers
        |--------------------------------------------------------------------------
        */

        // App\Providers\AppServiceProvider::class,

    ];

    foreach ($providers as $provider) {

        $app->register($provider);

    }

};
