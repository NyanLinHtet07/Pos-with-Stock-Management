<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Menu;
use App\Models\Item;

use App\Exports\ItemsExport;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    public function __construct()
    {
        $this-> middleware('isMain');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ,$id)
    {
      
        $menu = Menu::find($id);

        $items = Item::with('menu')
                 ->where('menu_id', $id)
                 -> when($request -> get('find') ?? '' , function($query, $find){
                        $query -> where('name','like',"%{$find}%")
                               -> orWhere('code', 'like', "%{$find}%");
                    
                        })
                 ->orderBy('id', 'desc')
                 -> paginate();
    
       

        return Inertia::render('Main/Item/Item' , [
            'menu' => $menu,
            'items' => $items,
            'search' => $request -> get('find')
        ]); 
    }

    public function export() 
    {
        return Excel::download(new ItemsExport, 'items.xlsx');
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
        
        $request -> validate ([
            'name' => 'required',
            'photo' => 'nullable',
            'code' => 'nullable',
            'price' => 'required',
            'menu_id' => 'required',
            'note' => 'nullable',
            'original_price' => 'nullable',
            'qty' => 'nullable',
        ]);

        if(! $request ->note )
        {
            $note = 'none' ;
        }
        else {
            $note = $request->note;
        }
        if( $request -> photo) {
            $file = $request -> photo;
            $filename = Uniqid().'_'.$file -> getClientOriginalName();
            $file -> move(public_path().'/upload/items/photo', $filename);
        }
        else {
            $filename = null;
        }
       

        $item = Item::create([
            'name' => $request -> name,
            'photo' => $filename,
            'code' => $request -> code,
            'price' => $request -> price,
            'menu_id' => $request -> menu_id, 
            'note'=> $note,
            'original_price' => $request -> original_price,
            'qty' => $request -> qty,
        ]);

        return redirect()->back() -> with('success', 'လုပ်ဆောင်ချက်အောင်မြင်ပါသည်');
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
        $request -> validate([
            'name' => 'nullable' ,
            'photo' => 'nullable',
            'code' => 'nullable',
            'price' => 'nullable',
            'menu_id' => 'nullable',
            'note' => 'nullable',
            'original_price' => 'nullable',
            'qty' => 'nullable',
        ]);

        $item = Item::find($id);

        $item -> update($request -> only('name','photo','code', 'price', 'menu_id', 'note','original_price', 'qty'));

        return redirect()->back();
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
        return redirect() -> back();
    }
}
