<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/api/candidats/store', [CandidatController::class, 'store'])->name('candidats.store');

// Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'loginSubmit'])->name('admin.login.submit');

Route::prefix('admin')->group(function () {

    Route::get('/home', [AdminController::class, 'index'])->name('admin.index');
    Route::middleware('auth:sanctum')->get('/connect-user', [AdminController::class, 'connectUser'])->name('admin.connect.user');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Route::get('/connect-user', [AdminController::class, 'connectUser'])->name('admin.connect.user');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/candidats', [CandidatController::class, 'candidats'])->name('admin.candidats');
    Route::get('/candidats/{id}', [CandidatController::class, 'show'])->name('admin.candidat.show');
    Route::put('/candidats/{id}', [CandidatController::class, 'update'])->name('admin.candidats.update');;
    Route::get('/candidat/{id}/video', [CandidatController::class, 'getVideo'])->name('admin.candidat.video');
    Route::get('/candidat/{id}/download', [CandidatController::class, 'downloadVideo'])->name('admin.candidat.download');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('/candidat/{id}/validate', [CandidatController::class, 'validateCandidat'])->name('admin.candidat.validate');
    Route::post('/candidat/{id}/reject', [CandidatController::class, 'rejectCandidat'])->name('admin.candidat.reject');
});

Route::get("/qr-code", [CandidatController::class, "generateUserQrCode"]);
