<?php

use App\Http\Controllers\admin\DesaController;
use App\Http\Controllers\admin\KabupatenController;
use App\Http\Controllers\admin\KecamatanController;
use App\Http\Controllers\admin\ProvinsiController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\TPSController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\user\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return redirect('login');
})->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard.index');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('user.index');
        Route::delete('/user', 'destroy')->name('user.delete');
    });

    Route::resource('/role', RoleController::class);

    Route::resource('/provinsi', ProvinsiController::class);

    Route::resource('/kabupaten', KabupatenController::class);

    Route::resource('/kecamatan', KecamatanController::class);

    Route::resource('/desa', DesaController::class);

    Route::resource('/tps', TPSController::class);
});
