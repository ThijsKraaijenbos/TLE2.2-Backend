<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FruitUser extends Model
{
    //
    use HasFactory;

    protected $fillable = ['user_id','fruit_id','has_eaten_before','like'];
    protected $table = 'fruit_user';

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function fruit():BelongsTo
    {
        return $this->belongsTo(Fruit::class);
    }
}
