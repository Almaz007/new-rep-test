<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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

// Route::get('/projects', [ProjectController::class, 'index']);
// Route::get('/projects/{id}', [ProjectController::class, 'show']);

Route::resource('projects', ProjectController::class);
// Route::post('projectAdd', [ProjectController::class, 'store']);
// Route::post('foo', function () {
//     return 'Hello World';
// });
