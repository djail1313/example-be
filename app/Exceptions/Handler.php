<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Islami\Shared\Exceptions\DomainException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $response = $this->handleDomainException($request, $exception);

        if ($response)
            return $response;

        return parent::render($request, $exception);
    }

    public function handleDomainException($request, Exception $exception)
    {
        if ($request->wantsJson() || $request->ajax())
            if ($exception instanceof DomainException)
                return response()->api(
                    $exception->getData(),
                    $exception->getHttpCode(),
                    $exception->getMessage(),
                    false,
                    $exception->getErrors()
                );
    }
}
