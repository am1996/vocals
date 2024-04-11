<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function getLogin()
    {
        return view('login');
    }
    public function getRegister()
    {
        return view("register");
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('index')
                ->withSuccess('You have successfully logged in!');
        }
        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
    }

    public function register(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'randtoken' => Str::random(30)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('index')
            ->with('success','You have successfully registered kindly activate your account');
    }
    public function editUserData(Request $request){
        $this->validate($request,[
            'name' => "required",
            'email' => "required|email",
        ]);
        User::whereId(auth()->user()->id)->update([
            'email' => $request->email,
            'name' => $request->name
        ]);
        return redirect("/dashboard")->with("success","Successfully updated user data.");
    }
    public function changePassword(){
        return view("changepassword");
    }
    public function updatePassword(Request $request)
{
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password))
            return back()->with("error", "Old Password Doesn't match!");

        if(!$request->new_password == $request->new_password_confirmation)
            return back()->with("error", "Password and repeat password don't match");
        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
}
    public function logout()
    {
        auth()->logout();
        Session()->flush();
        return Redirect::to('/');
    }
}
