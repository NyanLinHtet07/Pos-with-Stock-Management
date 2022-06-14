<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','total'];

    
    public function expenses()
    {
        return $this->hasMany(Cus_Expense::class, 'exp_id');
    }
}
