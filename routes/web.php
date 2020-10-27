<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/assign-summary', function () {
    return view('assign_summary');
});

Route::get('/project-list', function () {
    return view('project_list');
});

// Route::get('/user-list', function () {
//     return view('user_list');
// });

Route::get('/client-list', function () {
    return view('client_list');
});
Route::get('/login', function () {
    return view('login');
});

//user routes
Route::get('/user', [UserController::class, 'index']);
Route::get('/readUser/{id}', [UserController::class, 'readUser']);
Route::get('user/create', [UserController::class, 'create']);
Route::post('user', [UserController::class, 'store'])->name('user.store');
Route::get('user/edit/{id}', [UserController::class, 'edit']);
Route::put('user/update', [UserController::class, 'update'])->name('user.update');
Route::get('user/delete/{id}', [UserController::class, 'delete']);

//clients routes
Route::get('client/create', [ClientController::class, 'create']);
Route::post('client', [ClientController::class, 'store'])->name('client.store');
