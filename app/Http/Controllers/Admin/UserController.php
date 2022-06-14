<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Role;
use App\Models\Customer;
use App\Models\CustomerDebit;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\Cus_Expense;
use DB;


class UserController extends Controller
{
    public function __construct(){
        $this -> middleware('isMain');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $users = User::with('role') 
                -> when($request -> get('find')??'' , function($query, $find) {
                    $query -> where('name' , 'like', "%{$find}%");
                })
                -> paginate();
        $roles = Role::all();

        return Inertia::render('Main/User/Index', [
            'users' => $users,
            'roles' => $roles,
            'search' => $request -> get('find'),
        ]);

    }

   public function updateRole(Request $request, $id)
   {
       $request -> validate ([
           'role_id' => 'required',
       ]);

       $user = User::find($id);
       $user -> update($request -> only('role_id'));

       return redirect()->back();
   }


   //start customer

   // cutomer
   public function customer( Request $request)
   {
       $customers = Customer::when($request -> get('find') ?? '', function($query ,$find)
       {
           $query -> where('name', 'like', "%{$find}%");
       })
       ->orderBy('id', 'desc')
        ->paginate();

       return Inertia::render('Main/User/Customer', [
           'customers' => $customers,
           'search' => $request -> get('find'),
       ]);
   }

   //upload new customer

   public function customerStore( Request $request)
   {
       $request -> validate ([
           'name' => 'required',
           'source' => 'nullable',
       ]);

       $customer = Customer::create( $request ->only('name', 'source'));

       return redirect()->back();
   }

   //view customer debit
   public function customerDebit($id)
   {
       $customerDebits = CustomerDebit::with('customer','order','orders')
                            ->where('customer_id' , $id)
                            ->orderBy('id', 'desc')
                            ->paginate();

    return Inertia::render('Main/User/CustomerDebit' , [
        'customerDebits' => $customerDebits,
    ]);
   }

   //delete customer Debit
   public function customerDebitDestroy($id)
   {
       $debit = customerDebit::find($id);
       $debit -> delete();
       return redirect()->back();
   }



    // for user daily expenes

    public function expense($id)
    {
        $userExpenses = Expense::with('expenses') 
                            -> where( 'user_id' , $id) 
                            ->orderBy('id','desc') 
                            ->limit(50)
                            ->get();
                            //->paginate();
        
        return Inertia::render('Main/User/Expense', [
            'userExpenses' => $userExpenses ,
        ]);
    } 
    
    public function expenseStore( Request $request)
    {
        $request -> validate([
            'total' => 'required',
        ]);
            $expenses = Expense::create ([
                "user_id" => Auth::user()->id,
                "total" => $request -> total,
            ]);

            $exp_id = DB::getPdo() ->lastInsertId();

            foreach(json_decode($request -> items, true) as $item)
            {
                $userExp = new Cus_Expense;
                $userExp -> exp_id = $exp_id;
                $userExp -> name = $item['name'];
                $userExp -> exp = $item['exp'];

                $userExp -> save();
            }
            
            return redirect()->back();
    
    }

    public function expenseDelete($id)
    {
        $exp = Expense::find($id);
        $exp -> delete();

        return redirect()->back();
    }

    //end for user expense


    //for delete User not a customer

    public function destroy($id) {
        $user = User::find($id);
        $user -> delete();
        return redirect()->back();
    }
}
