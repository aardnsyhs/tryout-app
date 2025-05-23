<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TryoutController;
use Illuminate\Support\Facades\Route;

Route::middleware('redirect.if.auth')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth.session');
Route::get('/soal/selesai', [TryoutController::class, 'selesai'])->name('soal.selesai')->middleware(['auth.session', 'prevent.back']);

Route::middleware('auth.session')->group(function () {
    Route::get('/home', function () {
        return view('home.index');
    });
    Route::get('/soal/{no}', [TryoutController::class, 'show'])->name('soal.show');
    Route::post('/soal/{id}/lapor', [TryoutController::class, 'lapor'])->name('soal.lapor');
    Route::post('/soal/jawab/{questionId}', [TryoutController::class, 'simpanJawaban'])->name('soal.jawab');
});
