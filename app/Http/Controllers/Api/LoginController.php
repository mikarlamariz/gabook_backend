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
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Guid\Guid;

class LoginController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        if (Auth::check()) return response(null, 403);


        User::create($request->validated());
        return response(null, 201);
    }

    public function authenticate(Request $request)
    {
        $user = User::where('email',  $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => ['Credênciais inválidas'],
            ], 401);
        }

        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Usuário logado com sucesso',
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    }

    public function suap(string $token)
    {
        if (strlen($token) === 0)
            return response(null, 400);

        $url = 'https://suap.ifrn.edu.br/api/eu';

        $client = new Client(['verify' => false]);
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => "Bearer {$token}"
            ]
        ])->getBody()->getContents();

        $responseData = json_decode($response, true);

        $data = [
            "name" => $responseData["nome_usual"],
            "email" => $responseData["email_google_classroom"],
            "password" => Guid::uuid4()->toString()
        ];

        $user = null;

        if (User::where('email', $data["email"])->exists()) {
            $user = User::where('email', $data["email"])->first();
            $user->tokens()->delete();
        } else {
            $imageUrl = $responseData["foto"];
            if (strlen($imageUrl) > 0) {
                $response = $client->get($imageUrl);
                $imageContent = $response->getBody()->getContents();
                $fileName = time() . '.jpg';
                Storage::disk('public')->put('images/' . $fileName, $imageContent);
                $data['profile_image'] = "storage/images/" . $fileName;
            }
            $user = User::create($data);
        }

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

        if ($user) {
            $user->currentAccessToken()->delete();
            return response(null, 204);
        }

        return response(null, 401);
    }
}
