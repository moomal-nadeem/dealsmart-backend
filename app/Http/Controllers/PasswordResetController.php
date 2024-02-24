<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Message;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class PasswordResetController extends Controller
{
    Public function send_password_reset_mail(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required',
        ]);
        $email = $request->email;
        if($validator->fails()){
            return response()->json([
                'msg' => $validator->errors(),
                'status' => 'fail'
            ],401);
        }
        // check email exist
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json([
                'msg' => 'Email does not exist',
                'status' => 'Fail',
            ],404);
        }
        // generate token
        $token = Str::random(60);
        PasswordReset::create([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        // send email with password reset link
        Mail::send('reset', ['token' => $token], function(Message $message)use($email){
            $message->subject('Reset Your Password');
            $message->to($email);
        });

        return response()->json([
                'msg' => 'Password reset email sent, check your email',
                'status' => 'Success',
            ],200);
    }

    // reset password
    public function reset(Request $request, $token){
        $validator = Validator::make($request->all(),[
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'msg'=>$validator->errors(),
            ],401);
        }
        $password = PasswordReset::where('token',$token)->first();
        if(!$password){
            return response()->json([
                'msg' => 'Token is invalid or expired',
                'status' => 'Failed',
            ],404);
        }

        $user = User::where('email',$password->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
         
         // delete token after password reset
         PasswordReset::where('email',$user->email)->delete();
         return response([
            'msg' => 'password Changed Successfully',
            'status' => 'success',
        ],200);
    }
}
