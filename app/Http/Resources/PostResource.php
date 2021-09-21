<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
//            'file' => new FileResource($this->file),
            'category' => CategoryResource::collection($this->category),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
