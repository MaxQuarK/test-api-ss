<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class EmployerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => new RoleResource($this->role),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
