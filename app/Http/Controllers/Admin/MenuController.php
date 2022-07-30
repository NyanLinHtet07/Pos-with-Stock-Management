<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Menu;
use App\Models\Item;

use App\Exports\MenusExport;
use App\Imports\MenusImport;

use Maatwebsite\Excel\Facades\Excel;

class MenuController extends Controller
{
    public function __construct () {
        $this -> middleware('isMain');
    }
    public function index( Request $request)
    {
       
            $menus = Menu::when($request -> get('find') ?? '', function($query, $find){
                $query -> where('name','like', "%{$find}%");
            })
             ->orderBy('id', 'desc')
             ->paginate();


             return Inertia::render('Main/Menu/Menu', [     
                 'menus'  => $menus,
                 'search' => $request-> get('find')
        ]);
    }

    public function export() 
    {
        return Excel::download(new MenusExport, 'menus.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new MenusImport, request()->file('file'));
        
        return redirect()->route('menu.index')->with('success');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate ([
            'name' => 'required',
        ]);

        $menu = Menu::create ($request -> only('name'));

        return redirect()->route('menu.index') -> with('success', 'လုပ်ဆောင်ချက်အောင်မြင်ပါသည်');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menuShow = Menu::find($id);
        return Inertia::render('Main/Menu/Show' , compact('menuShow'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        $request -> validate ([
            'name' => 'required',
        ]);

        $menu = Menu::find($id);
        $menu -> update($request -> only('name'));

        return redirect()->route('menu.index')-> with('message' , 'Post Updated Successfully'); 
    }

    
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu -> delete();

        $item = Item::where( 'menu_id' , $id);
        $item -> delete();
       
        return redirect()->route('menu.index');
    }
}
