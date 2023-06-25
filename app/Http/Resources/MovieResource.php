<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'release_year' => $this->release_year,
            'director_name' => $this->director_name,
            'actor_details'=> new ActorResource($this->whenLoaded('actor')),
        ];
    }
}
