<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Redirect,Response,File;

class UserController extends Controller
{
    public function signup(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'cnic' => 'required',
            'pno' => 'required',
            'password' => 'required',
            'img'=>'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'msg'=>$validator->errors(),
                'status'=>401
            ]);
        }
        
        if(User::where('email',$request->email)->first()){
            return response([
                'message' => 'User is already Exist With Provided Email'
            ],401);

        }
          
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'pno' => $request->pno,
            'cnic' => $request->cnic,
            'password' => Hash::make($request->password),
            'img'=>$request->file('img')->store('Products'),
        ]);
        $token = $user->createToken($request->email)->plainTextToken;
        return response([
            'token' => $token,
            'message' => 'Register Successfully'
        ],200);
    }


    public function userDelete($id){
        $res = User::where('id',$id)->delete();
        if($res)
         {
            return ["res"=>"User has been deleted"];
         }else{
            return ["res"=>"fail to delete"];
         }
       
        }



        public function userEdit($id, Request $req){
            $d = User::find($id);
            // $d->name = $req->input('name');
            if($req->input('name') == 'undefined' || $req->input('name') == ''){
        
            }else{
            $d->name=$req->input('name');
        }
        if($req->input('email') == 'undefined' || $req->input('email') == ''){
        
        }else{
        $d->email=$req->input('email');
    }
    if($req->input('cnic') == 'undefined' || $req->input('cnic') == ''){
        
          }else{
              $d->cnic=$req->input('cnic');
}
if($req->input('pno') == 'undefined' || $req->input('pno') == ''){
        
}else{
$d->pno=$req->input('pno');
}
if($req->file('img')){
    $d->img = $req->file('img')->store('Products');
    }

            $d->save();
            return $d; 
            }
        


            public function showByIdUser($id)
            {
            //    return "hello";
                return User::find($id);
            }

    public function userList(){
      return User::all();
    }



    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'msg'=>$validator->errors(),
            ],401);
        }
        $user = User::where('email',$request->email)->first();
        if($user && Hash::check($request->password, $user->password)){
            $token = $user->createToken($request->email)->plainTextToken;
            return response([
                'token' => $token,
                'role' => $user->role,
                'prank' => $user->id,
                'name' => $user->name,
                'img' => $user->img,
                'actor' =>$user->actor,
                'message' => 'Login Successfully'
            ],200);
        }
        return response([
            'message' => 'Provided Email or Password is Wrong',
            'status' => 'failed',
        ],401);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout Successfully',
            'status' => 'success',
        ],200);
    }

    public function user(){
        $user = auth()->user();
        return response([
            'user' => $user,
            'status' => 'success',
        ],200);
    }

    public function change_password(Request $request){
        $validator = Validator::make($request->all(),[
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'msg'=>$validator->errors(),
                'status'=>401
            ]);
        }
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();
         return response([
            'msg' => 'password Changed Successfully',
            'status' => 'success',
        ],200);
        // return "hi";
    }
   
}
