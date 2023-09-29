<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // }); 
        
        $this->renderable(function (\Exception $e, $request){
            if($request->is('api/*')){

                if($e instanceof NotFoundHttpException){
                    return response()->json(
                        [
                            'title' => 'NotFoundHttpException',
                            'message' => $e->getMessage(),
                            'details' => 'Object not found',
                            'timestamp' => now(),
                        ], 
                        Response::HTTP_NOT_FOUND);
                }
                elseif($e instanceof ValidationException) {
                    return response()->json(
                        [
                            'title' => 'ValidationException',
                            'details' => $e->validator->getMessageBag(),
                            'message' => 'Validation failed',
                            'timestamp' => now(),
                        ],
                        Response::HTTP_UNPROCESSABLE_ENTITY
                    );
                }
                
                elseif($e instanceof QueryException) {
                    return response()->json(
                        [
                            'title' => 'QueryException',
                            'details' => $e->getMessage(),
                            'message' => 'Query failed',
                            'timestamp' => now(),
                        ],
                        Response::HTTP_UNPROCESSABLE_ENTITY
                    );
                }
                elseif($e instanceof ModelNotFoundException){
                    
                    return response()->json(
                        [
                            'title' => 'ModelNotFoundException',
                            'details' => 'Entry for '.str_replace('App', '', $e->getModel()).' not found',
                            'message' => 'Model not found',
                            'timestamp' => now(),
                        ], 
                        Response::HTTP_NOT_FOUND);
                }elseif($e instanceof BadRequestException){
                    
                    return response()->json(
                        [
                            'title' => 'BadRequestException',
                            'details' => $e->getMessage(),
                            'message' => 'Bad Request',
                            'timestamp' => now(),
                        ], 
                        Response::HTTP_NOT_FOUND);
                }elseif($e instanceof InternalErrorException){
                    return response()->json(
                        [
                            'title' => 'InternalErrorException',
                            'details' => $e->getMessage(),
                            'message' => 'Model not found',
                            'timestamp' => now(),
                        ], 
                        Response::HTTP_INTERNAL_SERVER_ERROR);
                }else{
                    return response()->json(
                        [
                            'title' => '',
                            'message' => $e->getMessage(),
                            'details' => $e->getFile().'|'.$e->getLine(),
                            'timestamp' => now(),
                        ], 
                        $e->getCode());
                }
            }
        });
        
    }
}
