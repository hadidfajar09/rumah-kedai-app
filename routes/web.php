<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TokoController;
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

// ROUTE ADMIN


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'index'])->name('form.login');
    Route::post('/login/bos', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
 


//END ROUTE


Route::get('/', function () {
    return view('admin.admin_login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'admin'], function(){
    Route::get('admin/toko/data', [TokoController::class, 'data'])->name('toko.data');
    Route::resource('admin/toko',TokoController::class);
});

require __DIR__ . '/auth.php';
