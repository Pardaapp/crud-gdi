<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
  
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
  
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    
    Route::group(['prefix' => 'admin/pegawai'], function () {
        Route::get('/create', [PegawaiController::class, 'create'])->name('pegawai.create');
        Route::post('/add', [PegawaiController::class, 'store'])->name('pegawai.store');
        Route::get('/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
        Route::post('/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
        Route::post('/delete', [PegawaiController::class, 'destroy'])->name('pegawai.delete');
    });
    
    Route::get('/pegawais', [PegawaiController::class, 'index'])->name('pegawais');
    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
    Route::get('/admin', [PegawaiController::class, 'index'])->name('pegawai.index');
});

