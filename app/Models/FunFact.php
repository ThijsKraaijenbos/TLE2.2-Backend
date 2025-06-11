<?php

namespace App\Models;

use Database\Factories\FunFactFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FunFact extends Model
{

    protected $fillable = [
        'fruit_id',
        'fruit_fact',
    ];
    /** @use HasFactory<FunFactFactory> */
    use HasFactory;
    public function fruit():BelongsTo
    {
        return $this->belongsTo(Fruit::class);
    }
}
