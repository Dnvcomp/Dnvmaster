<?php

namespace Dnvmaster\Exceptions;

use Exception;
use http\Env\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if($this->isHttpException($e)) {
            $statusCode = $e->getStatusCode();
            switch($statusCode) {
                case '404' :
                    $object = new \Dnvmaster\Http\Controllers\MasterController(new \Dnvmaster\Repositories\MenusRepository(new \Dnvmaster\Menu()));
                    $navigation = view(env('MASTER').'.navigation')->with('menu', $object->getMenu())->render();
                    \Log::alert('Страница не найдена - ' . $request->url());
                    return response()->view(env('MASTER').'.404',['bar' => 'no', 'title' => 'Страница не найдена','navigation'=> $navigation]);
            }
        }
        return parent::render($request, $e);
    }
}
