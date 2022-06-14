<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cus_Expense extends Model
{
    use HasFactory;

    
    public function userExps()
    {
        return $this->belongsTo(Expense::class , 'exp_id');
    }
    
}
