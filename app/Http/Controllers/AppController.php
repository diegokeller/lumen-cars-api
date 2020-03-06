<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

abstract class AppController extends Controller {

    protected function handleException($e){

        $message = 'Erro desconhecido.';

        if($e instanceof \ErrorException){
            throw $e;
        }
        
        if($e instanceof QueryException){
            $message = 'Erro de acesso ao banco de dados.';
        }

        return response()->json([
            'message' => $message,
            'exception' => $e->getMessage(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

}