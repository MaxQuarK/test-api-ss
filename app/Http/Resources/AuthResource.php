<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => new RoleResource($this->role),
            'manager' => new UserResource($this->manager),
            'employer' => new UserResource($this->employer),
            'token' => $this->createToken('Exore')->accessToken,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
