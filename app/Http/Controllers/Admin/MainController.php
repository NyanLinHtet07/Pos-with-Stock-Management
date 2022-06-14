<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_Product;
use App\Models\Expense;
use App\Models\Result;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $dates = Order::selectRaw ('id, total_amt, DATE(created_at) as created_date')
        //             ->orderByRaw('created_date', 'desc')
        //             ->get()
        //             ->groupBy('created_date'); 
                    
        // for daily setup
        
       // $price = Order::sum('total_amt');
        $price = DB::table('orders') 
               
                -> select( DB::raw('orders.*') , DB::raw('sum(orders.total_amt) as totalAmount'))
                ->where('orders.user_id' , Auth::user()->id)
                ->whereRaw( 'DATE(created_at) = CURDATE()' )
                ->groupBy('id')
                ->get();
        $salePrice = $price -> sum('totalAmount');


        //for original amount
        $orgPrice = DB::table('orders')
                    ->where('user_id', Auth::user()->id)
                    ->select( DB::raw('orders.*'), DB::raw('sum(totalorg_amt) as totalOrgAmt'))
                    ->whereRaw('DATE(created_at) = CURDATE()')
                    ->groupBy('id')
                    ->get();
        $saleOrgPrice = $orgPrice -> sum('totalOrgAmt');


        $org = DB::table('orders') -> sum('totalorg_amt');

        $profit = $salePrice - $saleOrgPrice ;

        //for expense

        $expense = DB::table('expenses')
                    ->where('user_id', Auth::user()->id)
                    ->select(DB::raw('expenses.*'), DB::raw('sum(total) as totalAmt'))
                    ->whereRaw('DATE(created_at) = CURDATE()')
                    ->groupBy('id')
                    ->get();
        $userExpense = $expense -> sum('totalAmt');
        
        $dailyResult = $profit - $userExpense;

        //add expenses in select .* 

        //end

        //for weekaly result

    

        $weeklyReport = DB::table('orders')
                        ->where('user_id' , Auth::user()->id)
                        //->join('expenses' , 'orders.user_id' ,'=' , 'expenses.user_id')
                        ->select( DB::raw('orders.*' ),
                            DB::raw('sum(total_amt) as weekTotal'),
                            DB::raw('sum(totalorg_amt) as weekTotalOrg'))
                           // DB::raw('sum(total) as weekExpense'))
                        ->where('created_at', '>', Carbon::now() -> startOfWeek())
                        ->where('created_at' , '<', Carbon::now() -> endOfWeek())
                        ->groupBy('id')
                        ->get();

        $weeklyExp = DB::table('expenses')
                        ->where('user_id' , Auth::user()->id)
                        ->select( DB::raw('expenses.*'),
                            DB::raw('sum(total) as weekExpense'))
                        ->where('created_at', '>' ,Carbon::now() ->startOfWeek())
                        ->where('created_at' , '<' , Carbon::now() ->endOfWeek())
                        ->groupBy('id')
                        ->get();

            $weeklySale = $weeklyReport ->sum('weekTotal');
            $weeklyOrigin = $weeklyReport -> sum('weekTotalOrg');
            $weeklyProfit =$weeklySale - $weeklyOrigin ;
            $weeklyExpense = $weeklyExp -> sum('weekExpense');
            $weeklyResult = $weeklyProfit - $weeklyExpense;

        
        // group by Monthly

        $monthly = DB::table('orders')
                ->where('user_id' , Auth::user() ->id)
                ->select( DB::raw('orders .*') ,
                         DB::raw('sum(total_amt) as sale'),
                         DB::raw('sum(totalorg_amt) as saleOrg'))
                ->whereRaw( 'month(created_at) = MONTH(NOW())')
                ->groupBy('id')
                //->orderBy('dates' , 'desc')
                ->get();
        
        $monthlyExp = DB::table('expenses')
                            ->where('user_id' , Auth::user() ->id)
                            ->select( DB::raw('expenses .*'),
                            DB::raw('sum(total) as totalExp'))
                            ->whereRaw('month(created_at) = MONTH( NOW())')
                            ->groupBy('id')
                            ->get();
        

        $month = $monthly -> sum('sale');
        $monthlyOrg = $monthly ->sum('saleOrg');
        $monthlyExpense = $monthlyExp -> sum('totalExp');
        $monthlyProfit = $month - $monthlyOrg ;
        $monthlyReport = $monthlyProfit - $monthlyExpense ;
      

                    




        
                    

        return Inertia::render('Main/Index', [
            'salePrice' => $salePrice,
            // 'dates' => $dates,
            // 'price' => $price,
            'profit' => $profit,
            'userExpense' => $userExpense,
            'dailyResult' => $dailyResult,

            //for weakly report
            'weeklySale' => $weeklySale,
            'weeklyProfit' => $weeklyProfit,
            'weeklyExpense' => $weeklyExpense,
            'weeklyResult' => $weeklyResult,
            'month' => $month,
            'monthlyProfit' => $monthlyProfit,
            'monthlyExpense' => $monthlyExpense,
            'monthlyReport' => $monthlyReport
        ]);
        

    }

    public function report()
    {

        //for monthly report datas array

        $monthlyReport = DB::table('orders')
                ->where('user_id' , Auth::user() ->id)
                ->select ( 
                    DB::raw('sum(total_amt) as sums'),
                    DB::raw('sum(totalorg_amt) as sumTotalOrg'),
                    DB::raw("DATE(created_at) as m"),
                  
                )
            ->whereMonth('created_at' , Carbon::now() ->month)
            ->groupBy('m') 
            ->get() ;
        
        
        $monthlyExpenseReport = DB::table('expenses')
                     ->where('user_id' , Auth::user() ->id)
                    ->select(
                        //DB::raw('expenses. *') ,
                        DB::raw('sum(total) as totalExp'),
                        DB::raw(' DATE(created_at) as month'),
                        
                    )

                    ->whereMonth('created_at' , Carbon::now() -> month)
                  
                    ->groupBy('month')
                    ->get();

        ///// end

        //for lasrt Month report datas array 

        $lastMonth = DB::table('orders')
                    ->where('user_id' , Auth::user() ->id)
                    ->select(
                        DB::raw('sum(total_amt) as lastMonthSale'),
                        DB::raw('sum(totalorg_amt) as lastMonthProfit'),
                        DB::raw('DATE(created_at) as lastMonthDate'),
                    )

                    ->whereMonth('created_at' , Carbon::now() ->subMonth() ->month)
                    ->groupBy('lastMonthDate')
                    ->get();
        
        $lastMonthExpense = DB::table('expenses')
                             ->where('user_id' , Auth::user() ->id)
                             ->select(
                                DB::raw('sum(total) as lastMonthExp' ),
                                DB::raw('Date(created_at) as lastMonth'),
                            )

                            ->whereMonth('created_at' , Carbon::now() ->subMonth() ->month)

                            ->groupBy('lastMonth')

                            ->get();



        //for total Data
        $lastMonthSale = $lastMonth -> sum('lastMonthSale');
        $lastMonthOrg = $lastMonth ->sum('lastMonthProfit');
        $lastExp = $lastMonthExpense -> sum('lastMonthExp');
        $lastMonthProfit = $lastMonthSale - $lastMonthOrg ;
        $lastMonthTotal = $lastMonthProfit - $lastExp ;       

        //end

                    
                       
        
         // group by Monthly

         $monthly = DB::table('orders')
         ->where('user_id' , Auth::user() ->id)
         ->select( DB::raw('orders .*') ,
                  DB::raw('sum(total_amt) as sale'),
                  DB::raw('sum(totalorg_amt) as saleOrg'))
         ->whereRaw( 'month(created_at) = MONTH(NOW())')
         ->groupBy('id')
         //->orderBy('dates' , 'desc')
         ->get();
 
        $monthlyExp = DB::table('expenses')
                            ->where('user_id' , Auth::user() ->id)
                            ->select( DB::raw('expenses .*'),
                            DB::raw('sum(total) as totalExp'))
                            ->whereRaw('month(created_at) = MONTH( NOW())')
                            ->groupBy('id')
                            ->get();
        

        $monthlySale = $monthly -> sum('sale');
        $monthlyOrg = $monthly ->sum('saleOrg');
        $monthlyExpense = $monthlyExp -> sum('totalExp');
        $monthlyProfit = $monthlySale - $monthlyOrg ;
        $monthlyTotal = $monthlyProfit - $monthlyExpense ;
        
        //end

       
                                
        
                      
                            

      


        return Inertia::render('Main/User/Report' ,[
            'monthlyReport' => $monthlyReport,
            'monthlyExpenseReport' => $monthlyExpenseReport,

            'monthlySale' => $monthlySale,
            'monthlyExpense' => $monthlyExpense,
            'monthlyProfit' => $monthlyProfit,
            'monthlyTotal' => $monthlyTotal, 

            'lastMonth' => $lastMonth,
            'lastMonthExpense' => $lastMonthExpense,

            'lastMonthSale' => $lastMonthSale,
            'lastExp' => $lastExp,
            'lastMonthProfit' => $lastMonthProfit,
            'lastMonthTotal' => $lastMonthTotal,
        ]);
    }

    public function reportYear() 
    {
        //for yearlyReport

        $yearly = DB::table('orders')
                    ->where('user_id' , Auth::user() ->id)
                    -> select(
                        DB::raw('sum(total_amt) as monthlySale'),
                        DB::raw('sum(totalorg_amt) as monthlyOrg'),
                        DB::raw("MONTH(created_at) as month"),
                    )

                    ->whereYear('created_at' , Carbon::now() -> year)
                    ->groupBy('month')
                    ->get();

        $yearlyExpense = DB::table('expenses')
                            ->where('user_id' , Auth::user() ->id)
                            -> select(
                                DB::raw('sum(total) as monthlyExp'),
                                DB::raw("MONTH(created_at) as monthly"),
                            )

                            ->whereYear('created_at' , Carbon::now() -> year)
                            ->groupBy('monthly')
                            ->get();


        
        // last year report 

        $lastyear = DB::table('orders')
        ->where('user_id' , Auth::user() ->id)
        -> select(
            DB::raw('sum(total_amt) as lastmonthSale'),
            DB::raw('sum(totalorg_amt) as lastmonthOrg'),
            DB::raw("MONTH(created_at) as lastmonth"),
        )

        ->whereYear('created_at', now()->year -1  )
        ->groupBy('lastmonth')
        ->get();

        $lastyearExpense = DB::table('expenses')
        ->where('user_id' , Auth::user() ->id)
        -> select(
                    DB::raw('sum(total) as lastmonthExp'),
                    DB::raw("MONTH(created_at) as lastmonthly"),
                )

         ->whereYear('created_at', now()->year -1  )
         ->groupBy('lastmonthly')
         ->get();

        
        
        

        $yearlySale = $yearly -> sum('monthlySale');
        $yearlyOrg = $yearly -> sum('monthlyOrg');
        $yearlyExp = $yearlyExpense -> sum('monthlyExp');
        $yearlyProfit = $yearlySale - $yearlyOrg;
        $yearlyTotal = $yearlyProfit - $yearlyExp;

        $lastyearSale = $lastyear -> sum('lastmonthSale');
        $lastyearOrg = $lastyear -> sum('lastmonthOrg');
        $lastyearExp = $lastyearExpense -> sum('lastmonthExp');
        $lastyearProfit = $lastyearSale - $lastyearOrg;
        $lastyearTotal = $lastyearProfit - $lastyearExp;

        return Inertia::render('Main/User/ReportYear' , [
            'yearly' => $yearly,
            'yearlyExpense' => $yearlyExpense,
            'yearlySale' => $yearlySale,
            'yearlyExp' => $yearlyExp,
            'yearlyProfit' => $yearlyProfit,
            'yearlyTotal' => $yearlyTotal,

            'lastyear' => $lastyear,
            'lastyearExpense' => $lastyearExpense,
            'lastyearSale' => $lastyearSale,
            'lastyearExp' => $lastyearExp,
            'lastyearProfit' => $lastyearProfit,
            'lastyearTotal' => $lastyearTotal
        ]);



    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $request -> validate([
            //'user_id' => 'required',
            'salePrice' => 'required',
            'profit' =>'required',
            'expense' => 'required',
            'dailyResult' => 'required',
        ]);

        $result = Result::create([
            'user_id' => Auth::user()->id,
            'salePrice' =>$request -> salePrice,
            'profit' =>$request -> profit,
            'expense' => $request -> expense,
            'dailyResult' => $request -> dailyResult,
        ]);

        return redirect()->back();
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
