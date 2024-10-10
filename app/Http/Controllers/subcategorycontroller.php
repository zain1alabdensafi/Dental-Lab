<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sub_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class subcategorycontroller extends Controller
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
            'name'=>'required'
    ]
);
if($data->fails())
{
    return response()->json([
        'message' => $data->errors(),
        'status' => 404
    ]);
}
    $category = Sub_Category::create([
         'name'=>$request['name'],
         'category_id'=>$request['category_id']
    ]);
   return redirect()->back()->with(['success','Category added successfully']);
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
    public function show(string $id)
    {
        $subcategory = Sub_Category::all();
        //return view('Inventory.index', compact('subcategory'));
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
    public function update(Request $request, string $id)
    {
        $category = Category::find($request['category_id']);
        $subcategory = Sub_Category::find($request['subcategory_id']);
        if($category)
        {
            if($subcategory){
            $subcategory->update($request->all());
            $subcategory->save();
            return response()->json([
                'message' => 'subcategroy updated successfully',
                'comment' => $subcategory,
                'status' => 200
            ]);
        }
        else{
            return response()->json([
                'message'=>'subcateogry not found',
                 'status'=>404
                ]);
        }
        }
            return response()->json([
            'message' => 'category not found',
            'status' => 404
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $category = Category::find($request['category_id']);
        $subcategory = Sub_Category::find($request['subcategory_id']);
        if($category)
        {
            if($subcategory){
            $subcategory->delete();
            return response()->json([
                'message' => 'subcategroy deleted successfully',
                'status' => 200
            ]);
        }
        else{
            return response()->json([
                'message'=>'subcateogry not found',
                 'status'=>404
                ]);
        }
        }
            return response()->json([
            'message' => 'category not found',
            'status' => 404
        ]);
    }
}
