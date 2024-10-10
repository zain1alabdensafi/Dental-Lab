<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ResetPasswordRequest;
use Ichtrojan\Otp\Otp;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    private $otp;
    
    public function __construct()
    {
        $this->otp = new Otp;
    }
    public function ResetPassword(ResetPasswordRequest $request)
    {
        $otp2 = $this->otp->validate($request['email'], $request['otp']);
        if(!$otp2->status)
        {
                return response()->json(['error' =>$otp2],400);
        }
        $user=User::query()->where('email',$request['email'])->first();
        $user->update(['password' =>Hash::make($request['password'])]);
        $user->save();
        return response()->json(['message' =>'success'],200);
    }
}