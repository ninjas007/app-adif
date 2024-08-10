<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    public function user_award()
    {
        return $this->hasOne(UserAward::class, 'award_id', 'id');
    }

    public function usersAward()
    {
        return $this->hasMany(UserAward::class, 'award_id', 'id');
    }
}
