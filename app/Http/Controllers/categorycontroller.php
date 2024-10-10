<?php

namespace App\Http\Controllers;

use App\Models\Category;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Validator;

class categorycontroller extends Controller
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
        $category = Category::create([
             'name'=>$request['name']
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
        $category = Category::all();
        //return view('Inventory.index', compact('category'));
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
        $category = Category::find($request['category_id']);
        if($category)
        {
                 $category->update($request->all());
                 $category->save();
                 return Response()->json(['updated succsesfully']);
        }
        else{
        return Response()->json(['category not found ']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request['category_id']);
        if($category)
        {
                 $category->delete();
                 return 'deleted successfully';
        }
        else{
        return Response()->json(['category not found ']);
        }
    }
}
