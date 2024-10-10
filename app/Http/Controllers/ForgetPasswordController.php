<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\ResetPasswordVerificationNotification;
use App\Http\Requests\ForgetPasswordRequest;
use App\Models\User;

class ForgetPasswordController extends Controller
{
    public function forgotPassword(ForgetPasswordRequest $request)
    {
        $user = User::query()->where('email','=',$request['email'])->first();
        $user->notify(new ResetPasswordVerificationNotification());
        return response()->json([
            'message' =>'success',
            'status' => 200
        ]);
    }    
}