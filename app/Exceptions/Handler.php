<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /* public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            if (strpos($exception->getMessage(), 'Series')) {
                $id = strrchr($exception->getMessage(),' ');
                return response()->json(['message' => "series with id{$id} not found"], 404);
            }
            if (strpos($exception->getMessage(), 'Season')) {
                $id = strrchr($exception->getMessage(),' ');
                return response()->json(['message' => "season with id{$id} not found"], 404);
            }
            if (strpos($exception->getMessage(), 'Episode')) {
                $id = strrchr($exception->getMessage(),' ');
                return response()->json(['message' => "episode with id{$id} not found"], 404);
            }
            return response()->json(['message' => $exception->getMessage()], 404);
        }
    } */
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
