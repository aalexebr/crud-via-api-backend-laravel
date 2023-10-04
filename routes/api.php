<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// controller
use App\Http\Controllers\Api\FileController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::name('/api.')->group(function(){
//     Route::resource('files',FileController::class);
// });
Route::get('file',[FileController::class,'index']);
Route::post('file',[FileController::class,'store']);
Route::get('file/{file}',[FileController::class,'show']);
Route::post('file/{file}',[FileController::class,'update']);