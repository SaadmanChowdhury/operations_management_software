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

function redirection($route)
{
    return redirect($route);
}

Auth::routes();

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------

Route::get('/user', [UserController::class, 'index']);
Route::get('/home', function () {
    return redirect('user');
});


Route::get('/user-list', function () {
    return redirect('user');
});
Route::get('/user-edit', function () {
    return view('user-edit');
});
Route::get('/user-register', function () {
    return view('user_register');
});

Route::get('user/create', [UserController::class, 'getCreateView']);
Route::get('user/edit/{id}', [UserController::class, 'getEditView']);

Route::post("/API/createUser", [UserController::class, 'createUser']);
Route::post("/API/readUser",   [UserController::class, 'readUser']);
Route::post("/API/updateUser", [UserController::class, 'updateUser']);
Route::post("/API/deleteUser", [UserController::class, 'deleteUser']);


// Route::post('user', [UserController::class, 'store'])->name('user.createUser');
// Route::get('/readUser/{id}', [UserController::class, 'readUser']);
// Route::put('user/update', [UserController::class, 'updateUser'])->name('user.update');
// Route::get('user/delete/{id}', [UserController::class, 'deleteUser']);

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------


Route::get('/assign', function () {
    return view('assign_summary');
});


//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------


Route::get('/project', function () {
    return view('project_list');
});


//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------

Route::get('/client', function () {
    return view('client_list');
});
