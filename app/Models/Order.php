<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $fillable = ['user_id', 'total_qty', 'total_amt', 'totalorg_amt'];
   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
   public function orders()
   {
       return $this -> hasMany( Order_Product::class, 'order_id');
   }
}
