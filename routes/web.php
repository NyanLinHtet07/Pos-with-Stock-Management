<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;



// Route::get('/', function () {
//     return Inertia::render('Welcome');
// });

Route::get('/' , [HomeController::class, 'index']) ;






// Route::get('/test', [TestController::class, 'index']) -> name('test.index');

Route::prefix('main') -> middleware('auth','isAccess')-> group(function () {
   

    Route::get('/', [MainController::class , 'index']) -> name('dashboard');
    Route::get('/report' , [MainController::class,'report']) -> name('report') ;
    Route::get('/report/year' , [MainController::class, 'reportYear']) -> name('reportYear');
    //Route::get('/report/{id}' , [MainController::class, 'reportMonth']) -> name('reportMonth');

    //store final result to database

    Route::post('/result' , [MainController::class, 'store']);


    //for item menu 

    Route::get('/menu', [ MenuController::class,'index' ]) ->name('menu.index');
    Route::post('/menu', [MenuController::class,'store']); 
    // Route::get('/menu/{menu}', [MenuController::class, 'show']) -> name('menu.show');
    Route::put('/menu/edit/{id}',[MenuController::class,'update']);
    Route::delete('menu/{id}', [MenuController::class, 'destroy']);
    Route::get('menu/export/', [MenuController::class, 'export']) -> name('menu.export');

   //for items ...

   Route::get('/{id}/item', [ItemController::class, 'index']);
   Route::post('/item', [ItemController::class, 'store']);
   Route::put('/item/edit/{id}' , [ItemController::class, 'update']);
   Route::delete('/item/{id}' , [ItemController ::class, 'destroy']);
   Route::get('/item/export/', [ItemController::class, 'export']) -> name('item.export');

   //for User Role 
   Route::get('/users' , [UserController::class, 'index']) -> name('user.index');
   Route::put('/users/{id}/roles/update', [UserController:: class, 'updateRole']);
   Route::delete('/users/{id}', [UserController::class, 'destroy']);

   //for Sale Feature
   Route::get('/sales' , [SaleController::class, 'index']) -> name('sale.index');
   Route::get('sales/history' , [SaleController::class, 'history']) -> name('sale.history');
   Route::get('/sales/{id}', [SaleController::class, 'historyDetail']);
   Route::post('/submit', [SaleController::class, 'submit']);

   //for customer

   Route::get('/customer' , [UserController::class, 'customer'] ) ->name('customer.index');
   Route::post('/customer', [UserController::class, 'customerStore']);
   Route::get('/customer/{id}/debit', [UserController::class, 'customerDebit']);
   Route::delete('/customer/debit/{id}' , [UserController::class,'customerDebitDestroy']);

   //for expense 

   Route::get('/expense/{id}' , [UserController::class, 'expense']) -> name('expense.index');
   Route::post('/expenses', [UserController::class,'expenseStore']);
   Route::delete('/expenses/{id}', [UserController::class, 'expenseDelete']);
 
   
}); 

Route::prefix('branch')-> middleware('auth','isAccess')->group(function () {
    Route::get('/' , [BranchController::class, 'index']) -> name('branch.index') ;
    Route::get('/report' , [BranchController::class,'report']) -> name('branch.report') ;
    Route::get('/report/year' , [BranchController::class, 'reportYear']) -> name('branch.reportYear');
    Route::get('/sales', [BranchController::class, 'sales']) -> name('branch.sale');
    Route::get('/sales/history/{id}', [BranchController::class, 'history']) -> name('branch.history'); 
});








require __DIR__.'/auth.php';
