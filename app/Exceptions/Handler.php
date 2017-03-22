<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // the below code is for Whoops support. Since Whoops can open some security holes we want to only have it
        // enabled in the debug environment. We also don't want Whoops to handle 404 and Validation related exceptions.
        if (config('app.debug') && ! ($e instanceof ValidationException) && ! ($e instanceof HttpResponseException)) {
            return $this->renderExceptionWithWhoops($e);
        }

        // this line allows you to redirect to a route or even back to the current page
        // if there is a CSRF Token Mismatch
        if ($e instanceof TokenMismatchException) {
            return redirect()->route('homepage');
        }

        // let's add some support if a Model is not found
        // for example, if you were to run a query for User #10000 and that user didn't exist we can return a 404 error
        if ($e instanceof ModelNotFoundException) {
            return response()->view('errors.404', [], 404);
        }

        // Let's return a default error page instead of the ugly Laravel error page when we have fatal exceptions
        if ($e instanceof \Symfony\Component\Debug\Exception\FatalErrorException) {
            return response()->view('errors.500', [], 500);
        }

        // finally we are back to the original default error handling provided by Laravel
        if ($this->isHttpException($e)) {
            switch ($e->getStatusCode()) {
                // not found
                case 404:
                    return response()->view('errors.404', [], 404);
                    break;
                // internal error
                case 500:
                    return response()->view('errors.500', [], 500);
                    break;

                default:
                    return $this->renderHttpException($e);
                    break;
            }
        } else {
            return parent::render($request, $e);
        }
    }

    /**
     * Render an exception using Whoops.
     *
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    protected function renderExceptionWithWhoops(Exception $e)
    {
        if (config('app.debug')) {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());

            return new \Illuminate\Http\Response(
                $whoops->handleException($e),
                $e->getStatusCode(),
                $e->getHeaders()
            );
        }
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
