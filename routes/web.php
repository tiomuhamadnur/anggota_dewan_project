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
    Route::resource('/dashboard', DashboardController::class);

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('user.index');
        Route::delete('/user', 'destroy')->name('user.delete');
    });

    Route::resource('/role', RoleController::class);

    Route::resource('/provinsi', ProvinsiController::class);

    Route::resource('/kabupaten', KabupatenController::class);
    Route::controller(KabupatenController::class)->group(function () {
        Route::post('/kabupaten/import', 'import')->name('kabupaten.import');
        Route::post('/kabupaten/export', 'export')->name('kabupaten.export');
    });

    Route::resource('/kecamatan', KecamatanController::class);
    Route::controller(KecamatanController::class)->group(function () {
        Route::post('/kecamatan/import', 'import')->name('kecamatan.import');
        Route::post('/kecamatan/export', 'export')->name('kecamatan.export');
    });

    Route::resource('/desa', DesaController::class);

    Route::resource('/tps', TPSController::class);
});
