<?php

namespace App\Http\Resources;

//use App\Models\Fruit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'id' => $this->id,
            'name' => $this->name,
            'fruit_id'=>$this->fruit_id,

            // This one is flexible and can be used to return any other data and specified with which column u want to return
            // $this->fruit gives all of it fruit columns $this->fruit->only(['name']) gives only name column < you can add multiple columns to this
            'fruit' => $this->fruit,
            // This one allows you to return the whole object of fruit and its columns . Not flexible :<
//            'fruits' => new FruitResource($this->fruit)
        ];
    }
}
