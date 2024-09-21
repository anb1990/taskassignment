<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
//use Laravel\Passport\Token;
class AuthController extends Controller {

    public function register(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role' => 'required|in:admin,user',
            ]);

            $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'role' => $request->role,
            ]);

            //return response()->json(['message' => 'User registered successfully'], 201);
            //$token = $user->createToken('authToken')->accessToken;

            return response()->json([], 200);
        }
        return view('auth.register');
    }

    public function login(Request $request) {


        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                
                $user->tokens()->delete();
                $token = $user->createToken('authToken');//->accessToken;
                print_r($token);die;
                
                
                $request->session()->put('authToken', $token);
                return redirect('/projects');
            }
            return back()->withErrors(['message' => 'Unauthorized']);

           
        }
        return view('auth.login');
    }

    public function logout() {
        Auth::logout();
            return redirect()->route('auth.login');
        

        //return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
