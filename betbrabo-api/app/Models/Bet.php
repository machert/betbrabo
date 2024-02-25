<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    use HasFactory;
    protected $table = 'bb_bets';

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    

    
}
