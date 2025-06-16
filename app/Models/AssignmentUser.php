<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentUser extends Model
{
    use HasFactory;

    //
    protected $fillable = ['assignment_id','user_id','completed'];
    protected $table = 'assignment_user';


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function assignment():BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }
}
