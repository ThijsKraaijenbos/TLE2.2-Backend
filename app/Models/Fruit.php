<?php

namespace App\Models;

use Database\Factories\FruitFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fruit extends Model
{
    /** @use HasFactory<FruitFactory> */
    protected $fillable = [
        'name',
        'description',
        'price',
        'big_img_file_path',
        'small_img_file_path',
        'weight',
        'serving_size'
    ];

    use HasFactory;




    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    // When there is a 1-to-Many keep in mind that the relationship has to be set in the model where the id is linked to the other table
    // E.g Fruit_id is linked to the assignment table, in the assignment table is fruit id.
    // That means you have to link the relationship here
    public function assignments():HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    // The same goes for this table. the fruit_id is linked to the FunFact table where the fruit_id is

    public function facts():HasMany
    {
        return  $this->hasMany(FunFact::class);
    }

}
