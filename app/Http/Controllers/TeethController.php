<?php

namespace App\Http\Controllers;

use App\Models\Bridge;
use App\Models\Tooth;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeethController extends Controller
{
    public function add_teeth(Request $request)
{
    $caseId = $request->input('case_id');
    
    
    $toothData = $request->input('tooth_number');
    $bridgeData = $request->input('bridge');

    $validator = Validator::make($request->all(), [
        'case_id' => 'required|numeric',
        'tooth_number.*' => 'required|array',
        'bridge.*' => 'required|boolean',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

 
    if (count($toothData) !== count($bridgeData)) {
        return response()->json(['error' => 'The number of tooth numbers and bridge flags must be equal.'], 400);
    }

    $bridgeId = null;

    foreach ($toothData as $key => $toothArray) {
        $isBridge = $bridgeData[$key];
        $toothNumber = $toothArray[0];
        $treatmentId = $toothArray[1];
        $materialId = $toothArray[2] ?? null;

        $treatment = Treatment::find($treatmentId);
        if (!$treatment) {
            return response()->json(['error' => 'Invalid treatment_id: ' . $treatmentId], 400);
        }

        if ($isBridge) {
            // Check if the previous or next tooth in the array is also marked as a bridge
            $prevIndex = $key - 1;
            $nextIndex = $key + 1;
            $prevIsBridge = $prevIndex >= 0 && $bridgeData[$prevIndex];
            $nextIsBridge = $nextIndex < count($bridgeData) && $bridgeData[$nextIndex];

            if ($prevIsBridge || $nextIsBridge) {
                if ($bridgeId === null) {
                    $bridge = Bridge::create([
                        'case_id' => $case_id,
                        'teeth_number' => $toothNumber,
                    ]);
                    $bridgeId = $bridge->id;
                } else {
                    $bridge = Bridge::find($bridgeId);
                    $bridge->teeth_number .= ',' . $toothNumber;
                    $bridge->save();
                }
                $tooth = Tooth::Create([
                    'case_id' => $case_id,
                    'tooth_number' => $toothNumber,
                    'treatment_id' => $treatmentId,
                    'material_id' => $materialId,
                    'bridge' => $bridgeId,
                ]);
            } else {
                return response()->json(['error' => 'A tooth marked as a bridge must have another tooth marked as a bridge either before or after it.'], 400);
            }
        } else {
            $tooth = Tooth::Create([
                'case_id' => $case_id,
                'tooth_number' => $toothNumber,
                'treatment_id' => $treatmentId,
                'material_id' => $materialId,
                'bridge' => 0,
            ]);
        }
    }

    return response()->json([
        'message' => 'Data processed successfully',
        'tooth_data' => Tooth::where('case_id', $case_id)->get(),
        'bridge_data' => Bridge::where('case_id', $case_id)->get()
    ]);
}
}