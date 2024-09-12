<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Poste;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserControlle extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::all();

   // $user=Auth::id();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
      $user=User::find($user);
     return  response()->json($user);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,User $user)
    {
        
        $validatedData=$request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            ]);

     $validatedData['password']=Hash::make($request->password);

          $user->fill($validatedData)->save();

          return response()->json([
            'Message' => "le user a été modifié",
            'user' => $user, 
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'Message' => "le user a été supprimé",
            'user' => $user, 
        ], 200);
    }


public function posts(User $user){

    $postes= User::with('posts')->find($user);
    // $postes = Poste::where('id_user', $id)->get();
    return response()->json($postes);
    
}

public function profile(){
    
    $postes= User::with('posts')->find(Auth::user()->id);
    return response()->json($postes);
}

}
