<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Data\UserController;
use App\Http\Controllers\Page\LogController;
use App\Http\Controllers\Page\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('test', function () {
    return view('test');
});
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::get('log', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('log');
    Route::get('/logs', [LogController::class, 'index'])->name('logs');
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });
    Route::controller(RoleController::class)->group(function () {
        Route::get('/roles', 'index')->name('role.index');
        Route::get('/roles/add', 'add')->name('role.add');
        Route::get('/roles/remove', 'remove')->name('role.remove');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('user.index');
        Route::get('/users-get', 'get')->name('user.get');
        Route::get('/users-show', 'show')->name('user.show');
        Route::post('/users-store', 'store')->name('user.store');
        Route::post('/users-update', 'update')->name('user.update');
        Route::post('/users-destroy', 'destroy')->name('user.destroy');
        Route::post('/users-destroy-multi', 'destroyMulti')->name('user.destroy.multi');
        Route::get('/users-print', 'print')->name('user.print');
    });
});

require __DIR__ . '/auth.php';