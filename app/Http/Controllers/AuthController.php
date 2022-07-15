<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response(['error' => 'Credenciais inválidas'], 401);
        }

        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);

    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:14',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response(['message' => 'Deslogado com sucesso!']);
    }

}
