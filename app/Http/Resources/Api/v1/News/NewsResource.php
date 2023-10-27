<?php

namespace App\Http\Resources\Api\v1\News;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return parent::toArray($request);

    }
}
