<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register (Request $request)
    {
        $rules =[
            'name' => 'required',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8',
        ];
        $messages = [
            'required' => 'Este campo es obligatorio'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($request->password !== $request->confirm_password)
        {
            return response()->json([
                'validation_errors' => ["confirm_password" => ['Las contraseñas deben ser iguales']]
            ], 422);
        }

        if($validator->fails())
        {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ], 422);
        }
        else
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

        $token = $user->createToken($user->email.'_Token', [''])->plainTextToken;

        return response()->json([
            'username' => $user->name,
            'token' => $token,
            'message' => 'Usuario registrado exitosamente',
        ],200);
    }

    public function login (Request $request)
    {
        $rules = [
            'email' => 'required|email|max:191',
            'password' => 'required|min:8',
        ];
        $messages = [
            'required' => 'Este campo es obligatorio'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ], 422);
        }
        else
        {
            $user = User::where('email', $request->email)->first();
            if (! $user || ! Hash::check($request->password, $user->password))
            {
                return response()->json([
                    'message' => 'El email o contraseña ingresados son incorrectos'
                ],401);
            }
            else
            {
                if ($user->role_as === 2)
                {
                    $token = $user->createToken($user->email.'_AdminToken', ['server:admin'])->plainTextToken;
                    $role = 'admin';
                }
                else
                {
                    $token = $user->createToken($user->email.'_Token', [''])->plainTextToken;
                    $role = '';
                }

                return response()->json([
                    'username' => $user->name,
                    'token' => $token,
                    'message' => 'Usuario logueado exitosamente',
                    'role' => $role
                ],200);
            }
        }
    }

    public function logout ()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Has salido exitosamente'
        ]);
    }
}
