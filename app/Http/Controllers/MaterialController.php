<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function delete_material(Request $request)
    {
        $material_id = $request->input('material_id');
        $material = Material::find($material_id);
        if($material)
        {
            $material->delete();
            $material->save();
            return redirect()->back()->with(['message' => 'Material deleted successfully']);
        }
        return redirect()->back()->with(['message'=>'Material not found']);
    }
    //----------------------------------------------------------------

    public function all_material()
    {
        $material = Material::all();
        return redirect()->back()->with(['All Materials' => $material]);
    }
    //----------------------------------------------------------------
}
