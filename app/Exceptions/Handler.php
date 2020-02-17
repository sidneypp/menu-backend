<?php

namespace App\Exceptions;

use App\Models\Error;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

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
     *
     * @throws \Exception
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            $error = (new Error())
                ->withShortMessage('data_invalid')
                ->withMessage($exception->validator->errors()->first());

            return response($error, Response::HTTP_BAD_REQUEST);
        }

        if ($exception instanceof ModelNotFoundException) {
            $id = Arr::first($exception->getIds());
            $model = Arr::last(explode("\\", $exception->getModel()));

            $replace = ['model' => $model, 'id' => $id];
            $messages = trans('messages.record_not_found', $replace);

            $error = (new Error())
                ->withShortMessage('record_not_found')
                ->withMessage($messages);

            return response($error, Response::HTTP_NOT_FOUND);
        }

        return parent::render($request, $exception);
    }
}
