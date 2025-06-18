<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FruitUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'fruit_id' => $this->fruit_id,
            'user_id' => $this->user_id,
            'has_eaten_before' => $this->has_eaten_before,
            'like' => $this->like,
        ];
    }
}
