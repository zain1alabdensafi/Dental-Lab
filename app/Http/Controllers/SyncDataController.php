<?php

namespace App\Http\Controllers;

use App\Models\Bridge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cases;
use App\Models\Image;
use App\Models\Tooth;
use App\Models\Treatment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SyncDataController extends Controller
{   
    public function add_case(Request $request)
    {
        try 
    {
            
            $data = Validator::make($request->all(), [
                'patient_name' => 'required',
                'age' => 'required',
                'gender' => 'required',
                'need_trial' => 'required',
                'repeate' => 'required',
                'notes' => 'required',
                'shade' => 'required',
                'expect_delivery_time' => 'required',
                'images.*' => 'required|image|mimes:jpg,png,gif,jpeg',
            ]);
    
            if ($data->fails()) {
                return response()->json([
                    'message' => $data->errors(),
                    'status' => 404,
                ]);
            }
    
            $images = [];
            if ($request->hasFile('images')) {
                $uploadedImages = $request->file('images');
                foreach ($uploadedImages as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $path = $image->storeAs('public/images/', $imageName);
                    $imageUrl = Storage::url($path);
                    $images[] = $imageUrl;
                }
            }
    
            $tempData = $request->except('images');
            $tempData['image_paths'] = $images;
            $request->session()->put('temp_case_data', $tempData);

            return response()->json([
                'message' => 'Case saved temporarily. Please add the tooth when ready.',
                'status' => 200,
            ]);
    } 
            catch (\Exception $e) {
                return response()->json([
                'message' => 'Error saving case temporarily: ' . $e->getMessage(),
                'status' => 500,
            ]);
            }
    }
    //----------------------------------------------------------------
    
    public function add_teeth(Request $request)
    {
        
        try 
    {
            DB::beginTransaction();
    
            $tempCaseData = $request->session()->get('temp_case_data');
            
            $validator = Validator::make($request->all(), [
                'tooth_number.*' => 'required|array',
                'bridge.*' => 'required|boolean',
            ]);
    
            if ($validator->fails()) {
                DB::rollBack();
                return response()->json(['error' => $validator->errors()], 400);
            }    

            $toothData = $request->input('tooth_number');
            $bridgeData = $request->input('bridge');
            if (count($toothData) !== count($bridgeData)) {
                DB::rollBack();
                return response()->json(['error' => 'The number of tooth numbers and bridge flags must be equal.'], 400);
                }
        $case = Cases::create([
            'user_id' => Auth::user()->id,
            'patient_name' => $tempCaseData['patient_name'],
            'age' => $tempCaseData['age'],
            'gender' => $tempCaseData['gender'],
            'need_trial' => $tempCaseData['need_trial'],
            'repeate' => $tempCaseData['repeate'],
            'notes' => $tempCaseData['notes'],
            'shade' => $tempCaseData['shade'],
            'expect_delivery_time' => $tempCaseData['expect_delivery_time'],
        ]);

            $correctedPaths = array_map(function($path) {
            $path = '//' . ltrim($path, '/'); 
            return str_replace('\/\/', '/', $path); 
                },
             $tempCaseData['image_paths']);
        
            $im = Image::create([
            'case_id' => $case->id, 
            'image' => implode(", ", $correctedPaths)
        ]);
        
    
            $bridgeId = null;
    
            foreach ($toothData as $key => $tooth) 
    {
                $isBridge = $bridgeData[$key];

                $toothNumber = $tooth[0];
                $treatmentId = $tooth[1];
                $materialId = $tooth[2] ?? null;
    
                $treatment = Treatment::find($treatmentId);
                if (!$treatment) 
                {
                    DB::rollBack();
                    return response()->json(['error' => 'Invalid treatment_id: ' . $treatmentId], 400);
                }
    
                if ($isBridge)
             {
                    
                    $prevIndex = $key - 1;
                    $nextIndex = $key + 1;
                    $prevIsBridge = $prevIndex >= 0 && $bridgeData[$prevIndex];
                    $nextIsBridge = $nextIndex < count($bridgeData) && $bridgeData[$nextIndex];
    
                    if ($prevIsBridge || $nextIsBridge) 
                    {
                        if ($bridgeId === null) 
                            {
                            $bridge = Bridge::create([
                                'case_id' => $case->id,
                                'teeth_number' => $toothNumber,
                            ]);
                            $bridgeId = $bridge->id;
                            }
                         else {
                            $bridge = Bridge::find($bridgeId);
                            $bridge->teeth_number .= ',' . $toothNumber;
                            $bridge->save();
                            }
                        $tooth = Tooth::create([
                            'case_id' => $case->id,
                            'tooth_number' => $toothNumber,
                            'treatment_id' => $treatmentId,
                            'material_id' => $materialId,
                            'bridge' => $bridgeId,
                        ]);
                    } 
                        else {
                        DB::rollBack();
                        return response()->json(['error' => 'A tooth marked as a bridge must have another tooth marked as a bridge either before or after it.'], 400);
                           }
                  } 
                else {
                    $tooth = Tooth::create([
                        'case_id' => $case->id,
                        'tooth_number' => $toothNumber,
                        'treatment_id' => $treatmentId,
                        'material_id' => $materialId,
                        'bridge' => 0, 
                    ]);
                    }
            
                    
                DB::commit();
                $request->session()->forget('temp_case_data');
    }
                return response()->json([
                    'message' => 'Data processed successfully',
                    'tooth_data' => Tooth::where('case_id', $case->id)->get(),
                    'bridge_data' => Bridge::where('case_id', $case->id)->get(),
                ]);
}
             catch (\Exception $e) 
             {
                DB::rollBack();
                return response()->json([
                    'message' => 'Error processing teeth data: ' . $e->getMessage(),
                    'status' => 500,
                ]);
            }
        }
        
}





/*

            $tempData['created_at'] = $request->created_at;
        
            $request->session()->put('temp_case_data', $tempData);
            ////////////////////////////////////////////////
    $tempCaseData = $request->session()->get('temp_case_data');

    // التحقق من وقت الجلسة
    $expectDeliveryTime = Carbon::parse($tempCaseData['created_at']);
    $currentTime = Carbon::now();

    if ($currentTime >= $expectDeliveryTime->addHours(2)) {
        return response()->json([
            'message' => 'The session time has expired. Please return to add a new case and then add teeth to complete your case.',
            'status' => 400,
        ]);
    }
        */