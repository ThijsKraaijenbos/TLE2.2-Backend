<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StreakResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);

        return [
            'id' => $this->id,

            // The streak BELONGS TO a user.
            // Each time a relationship has a BELONGS to you need to define the
            // relationship in the resource to access the user table.

            // Keep in mind when using the whenLoaded('') you have the call the relationship
            // in the controller.
            'user' => new UserResource($this->whenLoaded('user')),

            'start_date'=>$this->start_date,
            'last_completed_date'=>$this->last_completed_date,
            'current_streak'=>$this->current_streak,
            'longest_streak'=>$this->longest_streak,
        ];
    }
}
