<?php

namespace App\Http\Traits;


trait ExceptionTrait
{
    public function badFormat()
    {
        return response()->json(['bad format' => ["message" => "json in request required"]], 403);
    }

    public function errorMessage($message)
    {
        return response()->json(['error' => ["message" => $message]], 403);
    }

    public function errorPremissionMessage($message)
    {
        return response()->json(['error' => ["message" => $message]], 416);
    }
}
