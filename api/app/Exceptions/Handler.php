<?php

namespace App\Exceptions;

use Error;
use TypeError;
use Throwable;
use ErrorException;
use LogicException;
use ReflectionException;
use BadMethodCallException;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Psy\Exception\FatalErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class Handler extends ExceptionHandler
{
    use ApiResponser;

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

    public function render($request, Throwable $e)
    {
        if ($e instanceof NotFoundHttpException ||
            $e instanceof ModelNotFoundException ||
            $e instanceof NotFoundResourceException
        ) {
            return $this->errorResponse('Não encontrado', Response::HTTP_NOT_FOUND);
        }        

        if ($e instanceof AuthorizationException) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof AuthenticationException) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof ValidationException) {
            $errors = [
                'message' => 'Dados inválidos',
                'errors' => $e->validator->errors()
            ];
            
            return $this->errorsResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof HttpException) {
            $code = $e->getStatusCode();

            return $this->errorResponse(Response::$statusTexts[$code], $code);
        }

        if($e instanceof Error) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        if ($e instanceof ReflectionException ||
            $e instanceof QueryException ||
            $e instanceof BadMethodCallException ||
            $e instanceof FatalErrorException ||
            $e instanceof ErrorException ||
            $e instanceof LogicException ||
            $e instanceof RelationNotFoundException ||
            $e instanceof TypeError
        ) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if (env('APP_DEBUG', false)) {
            return parent::render($request, $e);
        }

        return $this->errorResponse('Erro inesperado', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
