<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBranch extends Model
{
    protected $table = 'user_branches';
    
    protected $fillable = [
        'user_id',
        'branch'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 