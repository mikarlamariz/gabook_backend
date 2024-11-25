<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        if(Auth::check()) return response(null, 403);
        
        
        User::create($request->validated());
        return response(null, 201);
    }

    public function authenticate(Request $request)
    {
        $user = User::where('email',  $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => ['Credênciais inválidas'],
            ]);
        }

        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Usuário logado com sucesso',
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    }

    /*
    LOGOUT USER FROM THE APPLICATION
    */
    public function logout(Request $request)
    {
        $user = $request->user('sanctum');

        if($user)
        {
            $user->currentAccessToken()->delete();
            return response(null, 204);
        }

        return response(null, 401);
    }
}
