<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if ($validator->fails()) {
            return new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Erros de validação',
                'data' => $validator->errors()
            ]));
        }

        $credentials = $validator->validated();

        if (!Auth::attempt($credentials)) {
            return response([
                "success" => false,
                "message" => "Credênciais inválidas",
                "data" => null
            ], 401);
        }
        
        $request->session()->regenerate();
        
        return response(null, 204);
    }

    /*
    LOGOUT USER FROM THE APPLICATION
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response(null, 200);
    }
}
