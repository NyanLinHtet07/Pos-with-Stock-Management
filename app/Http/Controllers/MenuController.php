<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Menu;



class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return dd('hello');
       // return Inertia::render("Menu");
        return Inertia::render('Menu', [
            'menus' => Menu::orderBy('id', 'desc')->get()
        ]);
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

        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      

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

    
    public function destroy(Menu $menu)
    {
        $menu -> delete();
       
        return redirect()->route('menu.index');
    }
}
