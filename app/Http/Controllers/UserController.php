<?php

namespace App\Http\Controllers;

use App\Http\Filters\PostFilter;
use App\Http\Requests\AuthRequest;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function create(AuthRequest $request)
    {
        $userService = new UserService(Auth::user());
        return $userService->create($request);
    }

    public function showAll(PostFilter $filter)
    {
        $userService = new UserService(Auth::user());
        return $userService->showAll($filter);
    }
}
