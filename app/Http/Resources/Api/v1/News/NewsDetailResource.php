<?php

namespace App\Http\Resources\Api\v1\News;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);

    }
}
