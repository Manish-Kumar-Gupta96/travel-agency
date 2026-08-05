<?php

declare(strict_types=1);

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

use App\Container\Application;
use App\Container\Container;
use App\Exceptions\ExceptionHandler;
use App\Http\Request;
use App\Routing\Router;
use App\Auth\AuthManager;
use App\Auth\UserProvider;
use App\Auth\PasswordHasher;
use App\Auth\TokenManager;
use App\Authorization\Gate;
use App\Authorization\PermissionManager;
use App\Authorization\RoleManager;
use App\Storage\StorageManager;
use App\Storage\FileUploader;
use App\Storage\ImageProcessor;

require_once dirname(__DIR__) . '/vendor/autoload.php';

if (file_exists(dirname(__DIR__) . '/.env')) {
    \Dotenv\Dotenv::createImmutable(dirname(__DIR__))->safeLoad();
}

/*
|--------------------------------------------------------------------------
| Create Application
|--------------------------------------------------------------------------
*/

$app = new Application();

$container = $app->container();

/*
|--------------------------------------------------------------------------
| Core Services
|--------------------------------------------------------------------------
*/

$container->singleton(
    Container::class,
    fn () => $container
);

$container->singleton(
    Application::class,
    fn () => $app
);

$container->singleton(
    Request::class,
    fn () => Request::capture()
);

$container->singleton(
    Router::class,
    Router::class
);

$container->singleton(
    ExceptionHandler::class,
    ExceptionHandler::class
);

// Load Routes
$router = $container->make(Router::class);
(require dirname(__DIR__) . '/routes/web.php')($router);
(require dirname(__DIR__) . '/routes/api.php')($router);
(require dirname(__DIR__) . '/routes/admin.php')($router);

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

$container->singleton(
    AuthManager::class,
    AuthManager::class
);

$container->singleton(
    UserProvider::class,
    UserProvider::class
);

$container->singleton(
    PasswordHasher::class,
    PasswordHasher::class
);

$container->singleton(
    TokenManager::class,
    TokenManager::class
);

/*
|--------------------------------------------------------------------------
| Authorization
|--------------------------------------------------------------------------
*/

$container->singleton(
    Gate::class,
    Gate::class
);

$container->singleton(
    PermissionManager::class,
    PermissionManager::class
);

$container->singleton(
    RoleManager::class,
    RoleManager::class
);

/*
|--------------------------------------------------------------------------
| Storage
|--------------------------------------------------------------------------
*/

$container->singleton(
    StorageManager::class,
    StorageManager::class
);

$container->singleton(
    FileUploader::class,
    FileUploader::class
);

$container->singleton(
    ImageProcessor::class,
    ImageProcessor::class
);

/*
|--------------------------------------------------------------------------
| Timezone
|--------------------------------------------------------------------------
*/

date_default_timezone_set(
    $_ENV['APP_TIMEZONE']
        ?? 'UTC'
);

/*
|--------------------------------------------------------------------------
| Start Session
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
|--------------------------------------------------------------------------
| Return Application
|--------------------------------------------------------------------------
*/

return $app;
