<?php

namespace App\Exceptions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use symfony\Component\HttpFoundation\Response;

 trait ExceptionTrait
 {

     public function apiException($request,$e)
     {
         if ($this->isModel($e)) {
             return $this->ModelResponse($e);


         }

         if ($this->isHttp($e)) {
             return $this->HttpResponse($e);

         }
         return parent::render($request, $exception);
     }
         protected function isModel($e)
         {
             return $e instanceof ModelNotFoundException;
         }

         protected function isHttp($e)
         {
             return $e instanceof NotFoundHttpException;
         }

         protected function ModelResponse($e)
         {
             return response()->json([
                 'errors' => 'model product not found'
             ], 401);
         }

         public function HttpResponse($e)
         {
             return response()->json([
                 'errors' => 'Incorrect route'
             ], 401);
         }
     }
