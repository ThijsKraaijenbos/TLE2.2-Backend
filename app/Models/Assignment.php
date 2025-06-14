<?php

namespace App\Models;

use Database\Factories\AssignmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Assignment extends Model
{
    protected $fillable = ['name','fruit_id'];

    /** @use HasFactory<AssignmentFactory> */
    use HasFactory;

    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class,'assignment_user')->withPivot('completed');

    }

    public function fruit():BelongsTo
    {
        return $this->belongsTo(Fruit::class);
    }
}
