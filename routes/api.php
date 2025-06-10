<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/candidats', function () {
    return response()->json([
        'message' => 'Candidats list',
        'data' => [
            // Here you would typically fetch the data from the database
            // For example: Candidat::all()
        ],
    ]);
})->name('candidats.index');

Route::post('/candidats/store', [CandidatController::class, 'store'])->name('candidats.store');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/candidats/{id}', [CandidatController::class, 'show'])->name('candidats.show');
Route::middleware('auth:sanctum')->put('/candidats/{id}', [CandidatController::class, 'update'])->name('candidats.update');
Route::middleware('auth:sanctum')->delete('/candidats/{id}', [CandidatController::class, 'destroy'])->name('candidats.destroy');
Route::middleware('auth:sanctum')->get('/candidats/{id}/video', [CandidatController::class, 'getVideo'])->name('candidats.video');
Route::middleware('auth:sanctum')->get('/candidats/{id}/download', [CandidatController::class, 'downloadVideo'])->name('candidats.download');
Route::middleware('auth:sanctum')->get('/candidats/{id}/delete', [CandidatController::class, 'deleteVideo'])->name('candidats.delete');



// Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout'])->name('logout');
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'me']);
Route::post('/set-presence', [CandidatController::class, 'setPresence'])->name('candidats.presence');


