<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KebutuhanPokokController;
use App\Http\Controllers\KebutuhanPendidikanController;
use App\Http\Controllers\PenghasilanController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\AdminController;

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
//LOGIN REGISTER
Route::post('register', [AuthController::class, 'register']);
Route::post('login',    [AuthController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('kebutuhan-pokok', [KebutuhanPokokController::class, 'index']);
    Route::post('kebutuhan-pokok', [KebutuhanPokokController::class, 'store']);
    Route::get('kebutuhan-pendidikan',     [KebutuhanPendidikanController::class, 'index']);
    Route::post('kebutuhan-pendidikan',    [KebutuhanPendidikanController::class, 'store']);
  
    // CRUD lengkap penghasilan
    Route::get('penghasilan', [PenghasilanController::class, 'index']);
    Route::post('penghasilan', [PenghasilanController::class, 'store']);
    Route::put('penghasilan/{id}', [PenghasilanController::class, 'update']);
    Route::delete('penghasilan/{id}', [PenghasilanController::class, 'destroy']);
    //EVALUASI
    Route::get('/evaluasi', [EvaluasiController::class, 'index']);

    //propil
   Route::get('/user', function (Request $request) {
    return response()->json([
        'name' => $request->user()->name,
        'email' => $request->user()->email,
        'nik' => $request->user()->nik,
        'no_kk' => $request->user()->no_kk,   
        'alamat' => $request->user()->alamat,  
        'lat' => $request->user()->lat,    
        'lng' => $request->user()->lng,
        ]);
        });

        Route::middleware('auth:sanctum')->get('/progress', [ProgressController::class, 'getProgress']);
        });


        Route::get('/lokasi-pengguna', [AuthController::class, 'lokasiPengguna']);

        Route::middleware(['auth:sanctum', 'is.admin'])->group(function () {
        Route::get('/admin/users', [AdminController::class, 'getAllUsers']);
        Route::delete('/admin/users/{id}', [AdminController::class, 'destroy']);
        Route::put('/admin/users/{id}', [AdminController::class, 'update']);
        Route::patch('/admin/users/{id}/checklist', [AdminController::class, 'toggleChecklist']);
        Route::get('/admin/users/checked', [AdminController::class, 'getCheckedUsers']);
});