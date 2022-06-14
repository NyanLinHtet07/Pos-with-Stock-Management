<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Order_Product;
use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerDebit;
use Illuminate\Support\Facades\Redirect;


use DB;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        

        return Inertia::render('Main/User/Sale', [
            'items' => $items,
           
            'search' => $request -> get('find'),

            'customers' => $customers,
        ]);
    }

    public function history()
    {
       
        $users = User::all();
        return Inertia::render('Main/User/SaleHistory' , [
            'users' => $users,
        ]);
    }

    public function historyDetail($id)
    {
        $datas = Order::with('orders','user')
       
                    ->where('user_id', $id )
                    ->take(100)
                    ->latest()
                   ->get();
                
        
       
        return Inertia::render('Main/User/SaleHistoryDetail', [
        'datas' => $datas,
        ]);
    }

    

    public function submit(Request $request)
    {
        // $request -> validate([
        //     'total_qty' => 'required',
        //     'total_amt' => 'required',
        //     'totalorg_amt' => 'required',
        // ]);

        $order = Order::create ([
            "user_id" => Auth::user()->id,
            "total_qty" => $request ->qty,
            "total_amt" => $request ->total ,
            "totalorg_amt" =>$request ->totalOrg,

        ]);

        $order_id = DB::getPdo()->lastInsertId();

        foreach( json_decode($request -> cartItem, true) as $item )
        {
            $productOrder = new Order_Product;
            $productOrder -> order_id = $order_id;
            $productOrder -> name = $item['name'];
            $productOrder -> price = $item['price'];
            $productOrder -> quantity = $item['quantity'];
            $productOrder -> subtotal = $item['price'] * $item['quantity'];

            $productOrder -> save();
        }

        // update real item quantity for stock system
        
        foreach ( json_decode($request -> cartItem, true) as $item)
        {
            $itemQty =  item::find($item['id']);
            $itemQty -> update([
                'qty' => $itemQty['qty'] - $item['quantity'] 
            ]);
           
        }

        if( ! $request -> cus_id)
        {
            return Redirect::route('sale.index');
        }

        else {

            // $request -> validate ([
            //     'customer_id' => 'required',
            //     'order_id' => 'required',
            //     'cash_amt' => 'nullable',
            //     'debit_amt' => 'nullable',
            // ]);

            $customerDebit = CustomerDebit::create([
                "customer_id" => $request->cus_id,
                "order_id" => $order_id,
                "cash_amt" => $request ->cash,
                "debit_amt" => $request ->debut,
            ]);

            return Redirect::route('sale.index');
        }
        

        

       


    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
