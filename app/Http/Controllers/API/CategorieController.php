<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=categorie::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $validatedData=$request->validate([
          'name'=>'required',
          'description'=>'required',
          ]);

      return categorie::create($validatedData);


    }

    /**
     * Display the specified resource.
     */
    public function show(categorie $categorie)
    {
        $categorie=categorie::find($categorie);
     return response()->json( $categorie);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,categorie $categorie)
    {
        $validatedData=$request->validate([
            'name'=>'required',
            'description'=>'required',
            ]);

            $categorie->fill( $validatedData)->save(); 

            return response()->json([
                'Message' => "la categorie a été modifié",
                'categorie' => $categorie, 
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categorie $categorie)
    {
        $categorie->delete();
        return response()->json([
            'Message' => "la categorie a été supprimé",
            'categorie' => $categorie, 
        ], 200);
    }
}
