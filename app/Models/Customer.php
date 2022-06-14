<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'source'];


    public function debits()
    {
        return $this->hasMany(CustomerDebit::class, 'customer_id');
    }
}
