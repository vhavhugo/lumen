<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function gerarToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $usuario = User::where('email', $request->email)->first();

        Hash::check($request->password, $usuario->password);

        //401 = status de não autorizado.
        if (
            is_null($usuario)
            || !Hash::check($request->password, $usuario->password)
        ) {
            return response()->json('Usuário ou senha inválidos', 401);
        }

        $token = JWT::encode(
            ['email' => $request->eamil],
            env('JWT_KEY')
        );

        return [
            'access_token' => $token
        ];
    }
}
