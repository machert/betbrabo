<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BetPrize extends Model
{
    use HasFactory;
    protected $table = 'bb_bet_prizes';

    
    public function bet()
    {
        return $this->belongsTo(Bet::class, 'bets_id');
    }
}
