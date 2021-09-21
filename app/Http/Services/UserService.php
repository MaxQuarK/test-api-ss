<?php


namespace App\Http\Services;

use App\Http\Resources\AuthResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use App\Http\Traits\ExceptionTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserService
{
    use AuthorizesRequests, ValidatesRequests, ExceptionTrait;

    protected $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    public function registration($request)
    {
        $request->validated();
        $role = $request->input('manager');

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        if ($role == 1) {
            $data['role_id'] = 1;
        }
        $request->replace($data);
        $user = User::create($request->json()->all());
        return new AuthResource($user);
    }

    public function login()
    {
        $requestLogin = request('email');
        if (isset($requestLogin)) {
            if (Auth::attempt(['email' => $requestLogin, 'password' => request('password')])) {
                $user = Auth::user();
                return new AuthResource($user);
            } else {
                return $this->errorMessage("Wrong password information");
            }
        } else {
            return $this->errorMessage("Error data input");
        }
    }

    public function create($request)
    {
        $request->validated();

        if (Gate::allows('create_user', $this->user)) {
            try {
                $data = $request->all();
                $data['password'] = bcrypt($request->password);
                $request->replace($data);
                $user = User::create($request->json()->all());
                $user->manager_id = $this->user->id;
                $user->role_id = 2;
                $user->save();
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
            $user->createToken('Exore-test')->accessToken;
            return new UserResource($user);
        } else {
            return $this->errorPremissionMessage("Error premissions");
        }
    }

    public function showAll($filter)
    {
        if (Gate::allows('show', $this->user)) {
            $allEmployers = $this->user->employer;
            if (isset($allEmployers)) {
                $allPosts = $allEmployers->post->filter($filter)->paginate(10);
            }
        } else if (!Gate::allows('show', $this->user)) {
            $allPosts = Post::filter($filter)->paginate(10);
        } else {
            return $this->errorPremissionMessage("Error premissions");
        }
        if (isset($allPosts)) {
            return PostResource::collection($allPosts);
        } else {
            return $this->errorPremissionMessage("Error premissions");
        }
    }


}
