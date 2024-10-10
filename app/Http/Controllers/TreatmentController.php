<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function delete_treatment(Request $request)
    {
        $treatment_id = $request->input('treatment_id');
        $treatment = Treatment::find($treatment_id);
        if($treatment)
        {
            $treatment->delete();
            $treatment->save();
            return redirect()->back()->with(['success' => 'success']);
        }
        return redirect()->back()->with(['error' => 'treatment not found']);
    }
    //----------------------------------------------------------------

    public function all_treatment()
    {
        $treatment = Treatment::all();
        return redirect()->back()->with('',['All Treatment' => $treatment]);
    }
    //----------------------------------------------------------------
}
