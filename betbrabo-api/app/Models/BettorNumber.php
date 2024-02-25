<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BettorNumber extends Model
{
    use HasFactory;
    protected $table = 'bb_bettors_numbers';
        
    public function bettor()
    {
        return $this->belongsTo(Bettor::class, 'bettors_id');
    }
}
