<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class APIUserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Could not create token'], 500);
        }

        $user = JWTAuth::user();
        unset($user->randtoken);
        $token = JWTAuth::fromUser($user);
        $name = $user->name;
        $email = $user->email;

        return response()->json(compact('name','email', 'token'));
    }

    public function register(Request $request){
        if(User::where('email', $request->email)->exists()){
            return response()->json(['error'=> "Email Already Exists!"],401);
        }
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required',
        ]);
        if ($validator->valid()) {
            return response()->json(['message'=> $validator->errors()],401);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'randtoken' => Str::random(30)
        ]);
        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);
        return response()->json(compact('credentials','token') ,200);
    }
    public function edit(Request $request){
        $token = substr($request->header('Authorization'),6);
        $user = JWTAuth::toUser($token);
        return response(compact('user') ,200);
    }
    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate(rules: [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check(value: $request->old_password, hashedValue: auth()->user()->password))
            return back()->with(key: "error", value: "Old Password Doesn't match!");

        if(!$request->new_password == $request->new_password_confirmation)
            return back()->with(key: "error", value: "Password and repeat password don't match");
        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make(value: $request->new_password)
        ]);

        return back()->with(key: "status", value: "Password changed successfully!");
    }
    public function logout()
    {
        auth()->logout();
        Session()->flush();
        return Redirect::to(path: '/');
    }
}
