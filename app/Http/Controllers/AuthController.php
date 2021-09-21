<?php


namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Services\UserService;

class AuthController extends Controller
{
    public function registration(AuthRequest $request)
    {
        $userService = new UserService();
        return $userService->registration($request);
    }

    public function login()
    {
        $userService = new UserService();
        return $userService->login();
    }
}
