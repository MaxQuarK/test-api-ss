<?php
namespace App\Http\Services;


use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Http\Traits\ExceptionTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostService
{
    use AuthorizesRequests, ValidatesRequests, ExceptionTrait;

    protected $user;
    protected $post;

    public function __construct(User $user = null, Post $post = null)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function create($request)
    {
        $request->validated();

        if (Gate::allows('create', Auth::user())) {
            try {
                $post = Post::create($request->json()->all());
                $post->user_id = $this->user->id;
                $post->save();
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
            $allMyPosts = $this->user->post()->paginate(10);
            if ($allMyPosts != null) {
                return PostResource::collection($allMyPosts);
            } else {
                return $this->errorMessage("Error finding posts");
            }
        } else {
            return $this->errorPremissionMessage("Error premissions");
        }
    }

    public function showAll($filter)
    {
        if (Gate::allows('show', $this->user)) {
            $allEmployers = $this->user->employer;
            if (isset($allEmployers)) {
                $allPosts = collect();
                foreach ($allEmployers as $employer) {
                    $getPosts = $employer->post()->filter($filter)->get();
                    $allPosts = $allPosts->merge($getPosts);
                }
            }
        } else if (!(Gate::allows('show', $this->user))) {
            $allPosts = Post::filter($filter)->where('user_id', '=', $this->user->id)->paginate(10);
        } else {
            return $this->errorPremissionMessage("Error premissions");
        }
        if (!empty($allPosts)) {
            return PostResource::collection($allPosts);
        } else {
            return $this->errorMessage("Error finding posts");
        }
    }

    public function edit($request)
    {
        $creator = $this->post->user_id;
        if (Gate::allows('show', $this->user)) {
            if (($this->user->employer->where('id', '=', $creator)->count()) >= 1) {
                $this->post->update($request->json()->all());
                return new PostResource($this->post);
            } else {
                return $this->errorMessage("Error finding posts");
            }
        } else {
            if ($creator == $this->user->id) {
                $this->post->update($request->json()->all());
                return new PostResource($this->post);
            } else {
                return $this->errorMessage("Error finding posts");
            }
        }
    }

    public function destroy()
    {
        $creator = $this->post->user_id;
        if (Gate::allows('delete', $this->user)) {
            if (($this->user->employer->where('id', '=', $creator)->count()) >= 1) {
                $this->post->delete();
            } else {
                return $this->errorMessage("Error delete empty source");
            }
        } else {
            if ($creator == $this->user->id) {
                $this->post->delete();
            } else {
                return $this->errorMessage("Error delete not your source");
            }
        }
        return response()->json('Success');
    }


}
