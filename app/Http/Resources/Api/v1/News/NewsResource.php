<?php

namespace App\Http\Resources\Api\v1\News;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' =>$this->description,
            'view_count' => $this->view_count,
            'created_at' => date('Y-m-d H:i:s',strtotime($this->created_at)),
        ];
    }
}
