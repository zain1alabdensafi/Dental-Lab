<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\EmailVerificationNotification;
use App\Notifications\LoginNotification;

class UserController extends Controller
{
    
    public function register(Request $request)
    {
        //Check if request email is created already
        if(User::query()->where('email', '=', $request['email'])->first())
        {
            return response()->json(['message' => 'This email already exists for you, please go to login or change your email address']);
        }

        //Validate
        $data = Validator::make($request->all(),[
            'first_name' => 'required|min:3|max:15',
            'last_name' => 'required|min:2|max:15',
            'phone_number' => 'required|min:10|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);
        if($data->fails())
        {
            return response()->json
            ([
                'message' =>$data->errors(),
                'status'=>404
            ]);
        }
        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),    
        ]);
        $token = $user->createToken('authToken')->plainTextToken;
//        $user->notify(new LoginNotification());
        return response()->json([
            'token' => $token,
            'status' =>200
        ]);
    }

    //----------------------------------------------------------------
    public function login(Request $request)
    {
        //Check if the email address is exist
        $user = User::query();
        if ($user->where('email', '=', $request['email'])->exists()) {
            //Check if the pawword is correct
            if (!Auth::attempt($request->only('email', 'password'))) {
                return Response()->json(['message' => 'password invalid', 'token' => null]);
            }
            //Check if the user is verified 
            $user = User::where('email', $request['email'])->firstorfail();
                if (!$user->email_verified_at) {
                    $user->notify(new EmailVerificationNotification());//code cheackers
                    return Response()->json(['message' => 'Email not verified. A new verification link has been sent to your email.']);
                }
            $token = $user->createToken('authToken')->plainTextToken;
            $user->notify(new LoginNotification());
            return Response()->json([
                'token' => $token,
                'message' =>'Login successfully'
                ]);
        } else {
            return response()->json(['message' => 'you should signup before login']);
        }
    }
    
    
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout successfully',
            'status' => 200
        ]);
    }

    public function profile()
    {
        $user = User::query()->find(Auth::user()->id);
        return $user->only('first_name','last_name','phone_number','wallet');
    }
    //----------------------------------------------------------------

    public function update_profile(Request $request)
    {
        
        $user = User::find(Auth::user()->id);
        $user->update($request->all());
        $user->save();
            return response()->json([
                'message' => 'Profile Updated Successfully',
                'all'=>$user,
                'status' => 200
            ]);
    }
    //----------------------------------------------------------------
    
    public function confirm_delivery(Request $request)
    {
        $case=Cases::find($request['case_id']);
        if($case)
        {
            //Check if the status case is Done
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
    //----------------------------------------------------------------

    public function rate(Request $request)
    {
        $case_id = $request['case_id'];
        $rate = $request['rate'];
        //Check if rate in range 1 to 5
        if ($rate < 1 || $rate > 5) {
            return response()->json([
                'message' => 'Rating must be between 1 and 5',
                'status' => 400
            ]);
        }
        $case = Cases::find($case_id);
        if($case)
        {
            //Check if the case is confirmed
            if($case->confirm_delivery==1){
            $case->rate = $rate;
            $case->save();
            return response()->json([
                'message' => 'Rate was Added successfully',
                'rate' => $rate,
            ]);
        }
        else{
            return response()->json([
                'message' => 'Case has not been confirmed yet'
            ]);
            }
        }
        return response()->json([
        'message' => 'case not found',
        'status'=>404 
        ]);        
    }
    //----------------------------------------------------------------


    //----------------------------------------------------------------
    //***************************************************************
    //***************************   Admin   *************************
    //***************************************************************
    //***************************************************************
    //----------------------------------------------------------------
            
        

    public function add_user_admin(Request $request)
    {

        try{
        //Check if request email is created already
    if(User::query()->where('email', '=', $request['email'])->first())
        {
        return response()->json(['message' => 'This email already exists for you, please go to login or change your email address']);
        }
        //Validate
        $data = Validator::make($request->all(),[
            'first_name' => 'required|min:3|max:15',
            'last_name' => 'required|min:2|max:15',
            'phone_number' => 'required|min:10|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);
        if($data->fails())
        {
            return response()->json
            ([
                'message' =>$data->errors(),
                'status'=>404
            ]);
        }
        //Create user 
            $user =User::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'phone_number' => $request['phone_number'],
                'email' =>$request['email'],
                'password' => Hash::make($request['password'])
            ]);
            $token = $user->createToken('authToken')->plainTextToken;
            //Send Welcom Mail 
           // $user->notify(new LoginNotification());
           return redirect()->route('Clients')->with('success', 'Employee created successfully');}
           catch(\Exception $e){
               return redirect()->route('Clients')->with('error',$e->getMessage());
           }
            
    }
    //----------------------------------------------------------------

    public function delete_user_admin(Request $request)
{
    //dd($request);
    $id = $request->input('id');
    $user = User::find($id);

    if ($user) {
        if ($user->case) {
            foreach ($user->case as $cases) {
                $cases->tooth()->delete();
                $cases->delete();
            }
        }

        $user->delete();
        return redirect()->back();
    } else {
        return redirect()->back();
    }
}
    //----------------------------------------------------------------
    public function all_users_admin()
    {
        $user = User::all();
        return view('Clients.index', compact('user'));
    }
    
    //----------------------------------------------------------------

    public function search_user_admin(Request $request)
    {
        //Check if the user is exist   
        $user = User::query()->where('first_name', 'like','%'.$request['first_name'].'%')->get();
        if($user)
        {
        return response()->json([
           'message'=> $user,
           'status'=>200
        ]);}
        else
        {
            return response()->json([
                'message'=>'user not found',
                'status'=>404
            ]); 
        }
    }        
    //------------------------------------------------------------
    public function update_profile_user(Request $request)
    {
        
        try {
        
            
            // تحقق من وجود المستخدم
            $user = User::find($request->user_id);
            if (!$user) {
                return redirect()->route('Clients')->with('error', 'User not found');
            }
    
            // تحديث بيانات المستخدم
            $user->fill($request->all());
            $user->save();
    
            return redirect()->route('Clients')->with('success', 'تم تحديث الملف الشخصي بنجاح');
        } catch (\Exception $e) {
            return redirect()->route('Clients')->with('error', $e->getMessage());
        }
    }
    
}