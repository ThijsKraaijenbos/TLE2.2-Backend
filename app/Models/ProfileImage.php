<?php

namespace App\Models;

use Database\Factories\ProfileImageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProfileImage extends Model
{

    protected $fillable = [
        'name',
        'file_path'
    ];
    /** @use HasFactory<ProfileImageFactory> */
    use HasFactory;



    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }
}
