<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmailVerificationRequest;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Ichtrojan\Otp\Otp;

class EmailVerificationController extends Controller
{
    private $otp;
    public function __construct()
    {
        $this->otp =new Otp();
    }
    
    public function sendEmailVerfication(Request $request)
    {
        $request->user()->notify(new EmailVerificationNotification());
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function email_verfication(EmailVerificationRequest $request)
    {
        $otpE=$this->otp->validate($request['email'],$request['otp']);
        if(!$otpE->status)
        {
            return response()->json(['error'=>$otpE]);
        }
        $user = User::where('email', $request['email'])->firstorfail();
        $user->email_verified_at = now();
        $user->save();
        return Response()->json([
        'message' =>'Email verified successfully']);
    }
}