<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
  public function login(Request $request){
    $validatedData = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Préparer les informations d'identification
    $credentials = $validatedData;

    // Tentative de connexion
    if (Auth::attempt($credentials)) {
        // Authentification réussie
        $user = Auth::user();
        $token = $user->createToken('auth-token')->plainTextToken;

        // return $token;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user, // Optionnel : retourner les informations utilisateur si nécessaire
            'id'=>Auth::id()
        ], 200);
    } else {
        // Authentification échouée
        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
        ], 401);
    }
  }

public function register(Request $request){

    $credentials = [
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => $request['password'],
    ];

    $credentials['password']=Hash::make($request->password);

    $user= User::create($credentials);
    
return  $user->createToken('auth-token')->plainTextToken;
  
}


public function logout()
{
    // Révoquer tous les tokens de l'utilisateur
    Auth::user()->tokens()->delete();

    // Retourner une réponse JSON pour indiquer que la déconnexion a réussi
    return response()->json(['message' => 'Déconnexion réussie']);
}



}
