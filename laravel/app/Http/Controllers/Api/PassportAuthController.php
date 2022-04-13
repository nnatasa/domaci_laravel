<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class PassportAuthController extends BaseController
{
    //
    use HasApiTokens;

    public function register(Request $request)
    {   
        $validator = Validator::make($request->all(),[
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'c_password'=>'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, ' User registered successfully');

    }

    public function login(Request $request)
    {

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $user=Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success, ' User login successful');
 
        }else{
        return $this->sendError('Unauthorised! ', ['error'=>'Unauthorised!']);

        }
    }

    public function userInfo(){
        $user = auth()->user();
        return response()->json(['user' => $user], 200);
    }
}
