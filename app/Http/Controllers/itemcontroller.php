<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sub_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class itemcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
        $data = Validator::make($request->all(),[
            'subcategory_id'=>'required',
            'name'=>'required',
            'quantity'=>'required'
    ]);
if($data->fails())
{
    return response()->json([
        'message' => $data->errors(),
        'status' => 404
    ]);
}
else{
    $ite= Item::create([
        'subcategory_id'=>$request['subcategory_id'],
         'name'=>$request['name'],
         'quantity'=>$request['quantity']
    ]);
    return redirect()->back()->with(['success','Item created successfully']);
}
   }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $item = Item::all();
        return view('Inventory.index', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        
        $item = Item::find($request['id']);
            if($item){
            $item->update($request->all());
            $item->save();
            return redirect()->back()->with(['success','Item updated successfully']);
        }
        else{
            return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $item = Item::find($request['id']);
            if($item){
                $item->delete();
            return redirect()->back()->with(['success','item deleted successfully']);
        }
        else{
            return 'Not Found Item';
        }
    }
}
