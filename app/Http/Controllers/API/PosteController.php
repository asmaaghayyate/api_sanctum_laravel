<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Poste;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PosteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $postes=Poste::all();
        return response()->json($postes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $validatedData = $request->validate([
            'body' => 'required',
            'id_categorie'=> 'required',
        ]);

        $validatedData['id_user']=Auth::id();
       
    //return ($validatedData);

         return Poste::create($validatedData);

    }

    /**
     * Display the specified resource.
     */
      public function show(Poste $poste)
    {

        $poste=Poste::find($poste->id); 
        return response()->json($poste);
    }


 /*   public function show($id)
    {
        // Récupérer l'utilisateur avec ses posts
        $user = User::with('posts')->find($id);

        if (!$user) {
            // Retourner une réponse 404 si l'utilisateur n'est pas trouvé
            return response()->json([
                'message' => 'Utilisateur non trouvé'
            ], Response::HTTP_NOT_FOUND);
        }

        // Retourner les données utilisateur avec ses posts en réponse JSON
        return response()->json($user, Response::HTTP_OK);
    }
*/

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poste $poste)
    {

        $validatedData = $request->validate([
            'body' => 'required',
        ]);
        $poste->fill($validatedData)->save();

      //  return response()->json($poste);

        return response()->json([
            'Message' => "la poste a été modifié",
            'poste' => $poste, 
        ], 200);


     }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Poste $poste)
    {
        $poste->delete();
        return response()->json([
            'Message' => "la poste a été supprimé",
            'poste' => $poste, 
        ], 200);
    }


    public function user(Poste $poste){

        $user= Poste::with('user')->find($poste->id);

        return response()->json($user);


    }



}
