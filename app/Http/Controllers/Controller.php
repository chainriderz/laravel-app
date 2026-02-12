<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function success($data = null, $message = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    protected function error($message, $code = 400, $errors = null, $data = null)
    {
        return response()->json([
            'success' 	=> false,
            'message' 	=> $message,
            'errors'	=> $errors,
            'data'    	=> $data,
        ], $code);
    }
}
