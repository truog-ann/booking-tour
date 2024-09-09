<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseJson extends Controller
{
    //
    public function responseSuccess($data = [], $message = "Success")
    {
        return response()->json([
            'message' => $message,
            'status' => 200,
            'data' => $data

        ]);
    }
    public function responseFailed($message = "Failed")
    {
        return response()->json([
            'data' => [],
            'message' => $message,
            'status' => 400
        ]);
    }
}
