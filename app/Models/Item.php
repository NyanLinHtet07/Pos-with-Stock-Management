<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name','photo','code','price','menu_id','note','original_price','qty'];

    
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function orders()
    {
        return $this->belongsToMany( Order::class);
    }
}
