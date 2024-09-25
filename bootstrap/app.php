<?php

use App\Shared\OnExecuteServiceAwaitResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: 'api',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Exception $e, Request $request) {
            if (!$e instanceof ValidationException) {
                return OnExecuteServiceAwaitResponse::error(
                    message: $e->getMessage(),
                    code: $e->getCode(),
                    error: 'Internal Server Error ' . $e->getCode() . ' en la linea ' . $e->getLine() . ' del archivo ' . $e->getFile()
                );
            } else {
                return OnExecuteServiceAwaitResponse::error(
                    message: $e->getMessage(),
                    code: Response::HTTP_BAD_REQUEST,
                    error: 'Unprocessable Entity'
                );
            }
        });
    })->create();
