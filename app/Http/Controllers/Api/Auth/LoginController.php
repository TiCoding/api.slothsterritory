<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function currentUser() {
        // esto se hace para poder incluir el rol del usuario ya que Auth::user no lo devuelve
        $userEmail = Auth::user()->email;
        return User::include()->where('email', $userEmail)->firstOrFail();
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        if (Hash::check($request->password, $user->password)){
            return UserResource::make($user);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }
}
