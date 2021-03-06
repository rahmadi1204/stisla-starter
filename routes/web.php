<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Data\UserController;
use App\Http\Controllers\Page\AppController;
use App\Http\Controllers\Page\DatabaseController;
use App\Http\Controllers\Page\LogController;
use App\Http\Controllers\Page\NotificationController;
use App\Http\Controllers\Page\RoleController;
use App\Http\Controllers\Utilities\WhatsappController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

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

    Route::get('/notification', [NotificationController::class, '__invoke'])->name('notification');
    Route::controller(WhatsappController::class)->group(function () {
        Route::get('/whatsapps', 'index')->name('whatsapp.index');
        Route::get('/whatsapps-qrcode', 'qrcode')->name('whatsapp.qrcode');
        Route::get('/whatsapps-status', 'status')->name('whatsapp.status');
        Route::get('/whatsapps-group', 'group')->name('whatsapp.group');
        Route::post('/whatsapps-group-send', 'groupSend')->name('whatsapp.group.send');
        Route::post('/whatsapps-send', 'send')->name('whatsapp.send');
        Route::post('/whatsapps-update', 'update')->name('whatsapp.update');
    });

    Route::controller(AppController::class)->group(function () {
        Route::get('/apps', 'index')->name('app.index');
        Route::get('/apps-show', 'show')->name('app.show');
        Route::post('/apps-update/{id}', 'update')->name('app.update');
    });

    Route::get('/log', [LogViewerController::class, 'index'])->name('log');
    Route::get('/logs', [LogController::class, 'index'])->name('logs');

    Route::controller(RoleController::class)->group(function () {
        Route::get('/roles', 'index')->name('role.index');
        Route::get('/roles-add', 'add')->name('role.add');
        Route::get('/roles-remove', 'remove')->name('role.remove');
    });

    Route::controller(DatabaseController::class)->group(function () {
        Route::get('/databases', 'index')->name('database.index');
        Route::get('/databases-import', 'import')->name('database.import');
        Route::get('/databases-download/{id}', 'download')->name('database.download');
        Route::get('/databases-backup', 'backup')->name('database.backup');
        Route::get('/databases-destroy', 'destroy')->name('database.destroy');
        Route::get('/databases-destroy-multi', 'destroyMulti')->name('database.destroy.multi');
    });

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard.index');
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
