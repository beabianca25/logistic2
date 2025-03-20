<?php

use App\Http\Middleware\RoleManager;
use App\Http\Middleware\UsertypeMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'rolemanager' => RoleManager::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();


    use Illuminate\Contracts\Http\Kernel as HttpKernel;
    use Spatie\Permission\Middleware\RoleMiddleware;
    use Spatie\Permission\Middleware\PermissionMiddleware;
    use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
    
    public function boot(HttpKernel $kernel): void
    {
        $kernel->middlewareAliases([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
    }
    
    
    
