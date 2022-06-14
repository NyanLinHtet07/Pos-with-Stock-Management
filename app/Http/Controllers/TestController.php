<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Order_Product;
use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerDebit;


use DB;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index( Request $request)
    {
        $items = Item::with('menu')
                -> when( $request -> get('find') ?? '', function($query , $find) {
                    $query -> where ('name','like',"%{$find}%")
                           -> orWhere('code', 'like', "%{$find}%");
                          
                }) 
                ->take(20)
                ->latest()
                ->get();
                //-> paginate(10);
        
        $customers = Customer::all();
        

        return Inertia::render('Test/Test', [
            'items' => $items,
           
            'search' => $request -> get('find'),

            'customers' => $customers,
        ]);
    }
}  
