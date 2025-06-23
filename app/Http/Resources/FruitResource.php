<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FruitResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'big_img_file_path' => $this->big_img_file_path,
            'small_img_file_path' => $this->small_img_file_path,
            'weight' => $this->weight,
            'size' => $this->serving_size,
            'fun_facts' => $this->whenLoaded('facts'),
            'users' => $this->whenLoaded(relationship: 'users', value: function () {
                return $this->users->map(
                    function ($user) {
                        return new FruitUserResource($user->pivot);
                    });
            })
        ];

    }
}
