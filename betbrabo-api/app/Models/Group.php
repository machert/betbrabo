<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    
    protected $table = 'bb_groups';
    
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'bb_users_groups', 'groups_id', 'users_id');
    }
    
}
