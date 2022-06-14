<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::all();

        return $item;
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
            'photo' => 'nullable',
            'code' => 'nullable',
            'price' => 'required',
            'menu_id' => 'required', 
            'note' => 'nullable',
        ]);

        $item = Item::create($request->only('name','photo','code','price','menu_id','note'));

        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);

        return $item;
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
        $request -> validate([
            'name' => 'nullable' ,
            'photo' => 'nullable',
            'code' => 'nullable',
            'price' => 'nullable',
            'menu_id' => 'nullable',
            'note' => 'nullable'
        ]);

        $item = Item::find($id);

        $item -> update($request -> only('name','photo','code', 'price', 'menu_id', 'note'));

        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
         $item -> delete();
         return $item;
    }
}
