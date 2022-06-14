<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDebit extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','order_id','cash_amt','debit_amt'] ;

    
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    } 


    public function orders()
    {
        return $this->hasMany(Order_Product::class, 'order_id' , 'order_id');
    }



}
