<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use App\Notifications\CaseStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class CaseController extends Controller
{

    public function add_case(Request $request)
    {
    //Validate
    $data = Validator::make($request->all(),
    [
        'patient_name' => 'required',
        'age' => 'required',
        'gender' => 'required',
        'need_trial'=> 'required',
         'repeate' => 'required',
        'shade' => 'required',
        'expect_delivery_time' => 'required',
        
    ]);
    if($data->fails())
    {
        return response()->json([
            'message' =>$data->errors(),
            'status'=>404
        ]);
    }

    $case = Cases::create([
        'user_id' => Auth::user()->id,
        'patient_name' => $request['patient_name'],
        'age' => $request['age'],
        'gender' => $request['gender'],
        'need_trial' => $request['need_trial'],
        'repeate' => $request['repeate'],
        'notes' => $request['notes'],
        'shade' => $request['shade'],
        'expect_delivery_time' => $request['expect_delivery_time']
    ]);
    
    $images = [];
    if ($request->hasFile('images')) 
    {
    $uploadedImages = $request->file('images');
    foreach ($uploadedImages as $image) 
    {
        $imageName = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('public/images/', $imageName);
        $imageUrl = Storage::url($path);    
        $images[] = $imageUrl;
    }
    }
    $imagesString = implode(", ", $images);

    $im = Image::create([
        'case_id' => $case->id,
        'image' => $imagesString
    ]);

    return response()->json([
        'message' =>'Case created successfully',
        'case' =>$case,
        'image' => $im->image,
        'status' =>200
    ]);
    }
    // ----------------------------------------------------------------

    public function all_cases()
    {
     $case= Cases::query()
     ->select('cases.id','cases.patient_name','cases.created_at','cases.updated_at','status','confirm_delivery')
     ->join('users','users.id','=','cases.user_id')
     ->where('users.id','=',Auth::user()->id)
     ->get();
     return response()->json([
        'All_Cases' =>$case,
        'status' =>200
     ]);
    }
    //----------------------------------------------------------------

    public function case_details(Request $request)
    {
    $id = $request->input('case_id');
    $case = Cases::find($id);
    if ($case) {
        $caseDetails = Cases::query()
        ->select('cases.*','teeth.treatment_id','teeth.material_id','teeth.tooth_number','teeth.bridge','bridges.teeth_number') 
        ->join('teeth','teeth.case_id','cases.id')
        ->join('treatments','treatments.id','teeth.treatment_id')
        ->join('materials','materials.id','teeth.material_id')
        ->join('bridges','bridges.case_id','cases.id')
        ->where('cases.id', $id)->get();

        $comments = Comment::where('case_id', $id)->first();
        if ($comments) {
            $caseDetails->push([
                'comments' =>$comments->comment,
                'created_at' =>$comments->created_at,
                'updated_at' =>$comments->updated_at
            ]);
        }

        $images = Image::where('case_id', $id)->first();
        if ($images) {
            $images->image = array_map(function($image) 
            {
                return trim($image, "\"");
            },
            explode(", ", $images->image));
            if (!empty($images->image[0])) {
                $caseDetails->push([
                'image' => $images->image,
                'created_at' =>$images->created_at,
                'updated_at' =>$images->updated_at
                ]);
            }
        }

        return response()->json([
            'case_details' => $caseDetails,
            'status' => 200
        ]);
    } else {
        return response()->json([
            'message' => 'Could not find this case',
            'status' => 404
        ]);
    }
    }
    //----------------------------------------------------------------

    public function delete_case(Request $request)
    {
    $id = $request->input('case_id');
    $case = Cases::query()->where('cases.user_id','=',Auth::user()->id)->find($id);
    if ($case) {
        if($case->status ==0){
        $case->tooth()->delete();
        $case->delete();
        return response()->json([
            'message' => 'Case Deleted successfully',
            'status' => 200
        ]);
    } else {
        return response()->json([
            'message' => 'can not delete case because status is Done',
            'status' => 400
        ]);
        }
    }
        return response()->json([
        'message' => 'Case not found',
        'status'=>404
        ]);
    }
    //----------------------------------------------------------------

    

    public function search_case(Request $request)
    {
        $patient_name = $request->input('patient_name');
        $patient = Cases::query()->where('patient_name','like','%'.$patient_name.'%')->first();
        if($patient){
        if($patient->user_id == Auth::user()->id)
        {
            return response()->json([
                'case' => $patient->only('patient_name','age','gender','confirm_delivery','status')
            ]);
        }
        return response()->json([
        'message'=> 'User not found',
        'status'=>404
        ]);
    }
    return response()->json([
        'message'=> 'Patient not found'
    ]);
}


    //----------------------------------------------------------------
    //***************************************************************
    //***************************   Admin   *************************
    //***************************************************************
    //***************************************************************
    //----------------------------------------------------------------

    
    public function add_case_admin(Request $request)
    {
        
        //Validate
        $data = Validator::make($request->all(),
        [
            'user_id' => 'required',
            'patient_name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'expect_delivery_time' => 'required',
        ]);
        if($data->fails())
        {
            return response()->json([
                'message' =>$data->errors(),
                'status'=>404
            ]);
        }
        $user = User::find($request['user_id']);
        if($user){
        $case = Cases::create([
            'user_id' => $request['user_id'],
            'patient_name' => $request['patient_name'],
            'age' => $request['age'],
            'gender' => $request['gender'],
            'need_trial' => $request['need_trial'],
            'repeate' => $request['repeate'],
            'notes' => $request['notes'],
            'shade' => $request['shade'],
            'expect_delivery_time' => $request['expect_delivery_time']
        ]);
        
        $images = [];
        if ($request->hasFile('images')) 
        {
        $uploadedImages = $request->file('images');
        foreach ($uploadedImages as $image) 
        {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/images/', $imageName);
            $imageUrl = Storage::url($path);    
            $images[] = $imageUrl;
        }
        }
        $imagesString = implode(", ", $images);
    
        
        session(['case_id' => $case->id]);
        return redirect()->route('teeth');
        
    }
    return 'user not found';
    }
    //----------------------------------------------------------------
    
    public function status_admin(Request $request)
    {
        $user_id= $request->input('user_id');
        $id = $request->input('case_id');
        $user = User::find($user_id);
        if ($user) {
        $case = Cases::query()->where('cases.user_id','=',$user_id)->find($id);
        if($case)
        {
            $case->status=$request['status'];
            $case->save();
            $user->notify(new CaseStatusNotification());
            return 'done';
        }
        else
        {
            return 'false';
        }
    }
    return 'user not found';
    }
    //----------------------------------------------------------------
    
    public function show_cases_admin()
    {
        $case = Cases::query()
        ->select('users.first_name','cases.id','cases.patient_name','cases.created_at','cases.updated_at')
        ->join('users','users.id','=','cases.user_id')
        ->get();
        return view('Cases.index', compact('case'));
    }
    //----------------------------------------------------------------
    
    public function delete_case_user(Request $request)
    {
        //dd($request);
        try {
            $id = $request->input('id');
            $case = Cases::find($id);
    
            if (!$case) {
                return redirect()->back()->with('error', 'Case not found');
            }
    
            $user_id = $case->user_id;
            $user = User::find($user_id);
    
            if ($user) {
                // حذف الأسنان التابعة للحالة
                $case->tooth()->delete();
                // حذف الحالة
                $case->delete();
                return redirect()->back()->with('success', 'Case deleted successfully');
            } else {
                return redirect()->back()->with('error', 'User not found');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

    //----------------------------------------------------------------
    
    public function show_case_details_admin(Request $request)
    {
        
        $case_id = $request->input('case_id');
        $case = Cases::find($case_id);
        $user = User::find($case->user_id);
        if($user){            
        if ($case) {
         $caseDetails = Cases::query()
        ->select('users.id','cases.*','teeth.treatment_id','teeth.material_id','teeth.tooth_number','teeth.bridge','bridges.teeth_number') 
        ->join('users','users.id','cases.user_id')
        ->join('teeth','teeth.case_id','cases.id')
        ->join('treatments','treatments.id','teeth.treatment_id')
        ->join('materials','materials.id','teeth.material_id')
        ->join('bridges','bridges.case_id','cases.id')
        ->where('cases.id', $case_id)
        ->where('users.id',$user->id)
        ->first();
        if($caseDetails) {
            $toothNumber = $caseDetails->tooth_number;
            // استخدام $toothNumber في الإجراءات اللاحقة
        

        $comments = Comment::where('case_id', $case_id)->first();
        if ($comments) {
            $caseDetails->push([
                'comments' =>$comments->comment,
                'created_at' =>$comments->created_at,
                'updated_at' =>$comments->updated_at
            ]);
        }

        $images = Image::where('case_id', $case_id)->first();
        if ($images) {
            $images->image = array_map(function($image) 
            {
                return trim($image, "\"");
            },
            explode(", ", $images->image));
            if (!empty($images->image[0])) {
                $caseDetails->push([
                'image' => $images->image,
                'created_at' =>$images->created_at,
                'updated_at' =>$images->updated_at
                ]);
            }
        }
        // dd($caseDetails);

        return view('Cases.details', compact('caseDetails'));
    }
        else {
         return 0;
        }
    } else {
        return redirect()->back();
    }
    }
    return 'User not found';
    }
    //----------------------------------------------------------------

    public function confirm_delivery_admin(Request $request)
    {
        $user_id = $request->input('user_id');
        $user =User::find($user_id);
        if ($user) {
        $case=Cases::find($request['id']);
        if($case)
        {
            if($case->status==1){
            $case->confirm_delivery=$request['confirm_delivery'];
            $case->save();
            return response()->json([
                'message'=>'Confirmed delivery',
                'status'=>200
            ]);
        }
        else{
            return response()->json([
                'message'=>'Case Status is not Done yet'
            ]);
        }
        }
        else
        {
            return Response()->json(['messsage'=>'case not found']);
        }
    }
    return 'user not found';
    }
    //----------------------------------------------------------------

    public function search_case_admin(Request $request)
    {
        $user_id = $request->input('user_id');
        $patient_name = $request->input('patient_name');
        $patient = Cases::query()->where('patient_name','like','%'.$patient_name.'%')->first();
        if($patient->user_id == $user_id)
        {
            return response()->json([
                'case' => $patient->only('patient_name','age','gender','confirm_delivery','status')
            ]);
        }
        return response()->json([
        'message'=> 'patient not found',
        'status'=>404
        ]);
    }
}