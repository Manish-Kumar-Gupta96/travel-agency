<?php

declare(strict_types=1);


/*
|--------------------------------------------------------------------------
| Application Entry Point
|--------------------------------------------------------------------------
|
| All HTTP requests enter through this file.
| This is the Front Controller of the application.
|
*/


use App\Container\Application;


/*
|--------------------------------------------------------------------------
| Load Application
|--------------------------------------------------------------------------
*/

$app = require_once dirname(__DIR__)
    .'/bootstrap/app.php';





/*
|--------------------------------------------------------------------------
| Load Service Providers
|--------------------------------------------------------------------------
*/

$providers = require_once dirname(__DIR__)
    .'/bootstrap/providers.php';


if(
    is_callable($providers)
)
{

    $providers($app);

}





/*
|--------------------------------------------------------------------------
| Run Application
|--------------------------------------------------------------------------
*/

$app->run();
