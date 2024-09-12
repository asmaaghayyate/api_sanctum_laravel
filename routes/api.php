<?php

use App\Http\Controllers\API\CategorieController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\PosteController;
use App\Http\Controllers\API\UserControlle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('users',[UserControlle::class,'index'])->middleware(('auth:sanctum'));
Route::get('users/{user}',[UserControlle::class,'show'])->middleware(('auth:sanctum'));
Route::put('/users/{user}',[UserControlle::class,'update'])->middleware(('auth:sanctum'));
Route::delete('/users/{user}',[UserControlle::class,'destroy'])->middleware(('auth:sanctum'));


Route::get('/users/{user}/postes',[UserControlle::class,'posts'])->middleware(('auth:sanctum'));
Route::get('/profile/postes',[UserControlle::class,'profile'])->middleware(('auth:sanctum'));


Route::post('/login',[LoginController::class,'login']);
Route::post('/register',[LoginController::class,'register']);
Route::post('/logout',[LoginController::class,'logout'])->middleware(('auth:sanctum'));


Route::get('/postes',[PosteController::class,'index'])->middleware(('auth:sanctum'));
Route::post('/postes',[PosteController::class,'store'])->middleware(('auth:sanctum'));
Route::get('/postes/{poste}',[PosteController::class,'show'])->middleware(('auth:sanctum'));
Route::put('/postes/{poste}',[PosteController::class,'update'])->middleware(('auth:sanctum'));
Route::delete('/postes/{poste}',[PosteController::class,'destroy'])->middleware(('auth:sanctum'));
Route::get('/user/{poste}',[PosteController::class,'user'])->middleware(('auth:sanctum'));



// Route::get('/categories',[CategorieController::class,'index'])->middleware(('auth:sanctum'));
// Route::post('/categories',[CategorieController::class,'store'])->middleware(('auth:sanctum'));
// Route::get('/categories/{categorie}',[CategorieController::class,'show'])->middleware(('auth:sanctum'));
// Route::put('/categories/{categorie}',[CategorieController::class,'update'])->middleware(('auth:sanctum'));
// Route::delete('/categories/{categorie}',[CategorieController::class,'destroy'])->middleware(('auth:sanctum'));



Route::apiResource('categories',CategorieController::class)->middleware(('auth:sanctum'));


