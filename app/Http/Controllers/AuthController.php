<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponser;

    public function login(Request $request)
    {
        if (!auth()){
            return $this->error('sd', '', 403);
        }
        $validatedData = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6',
        ]);

        if (!Auth::attempt($validatedData)) {
            return $this->error('Credentials not match', '', 401);
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken,
            'user' => auth()->user()
        ]);
    }

//    public function login(Request $request)
//    {
//        $credentials = $request->validate([
//            'email' => ['required', 'email'],
//            'password' => ['required'],
//        ]);
//
//        if (Auth::attempt($credentials)) {
//            $request->session()->regenerate();
//
//            return redirect()->intended('dashboard');
//        }
//
//        return back()->withErrors([
//            'email' => 'The provided credentials do not match our records.',
//        ]);
//    }

    public function register(
        Request $request
    ) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|min:6|string',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        return $this->success(['token' => $user->createToken('auth'), 'user' => $user]);

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
