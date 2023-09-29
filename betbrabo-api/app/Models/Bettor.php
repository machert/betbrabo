<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bettor extends Model
{
    use HasFactory;
    protected $table = 'bb_bettors';

        
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
    public function bet()
    {
        return $this->belongsTo(Bet::class, 'bets_id');
    }
}
