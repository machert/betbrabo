<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;
    protected $table = 'bb_users_groups';

    
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    
    public function group()
    {
        return $this->belongsTo(Group::class, 'groups_id');
    }
}
