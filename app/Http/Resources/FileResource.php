<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'web_path' => $this->web_path,
            'local_path' => $this->local_path,
            'size' => $this->size,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
