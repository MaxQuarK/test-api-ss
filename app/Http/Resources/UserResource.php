<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => new RoleResource($this->role),
            'manager' => new ManagerResource($this->manager),
            'employer' => new EmployerResource($this->employer),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
