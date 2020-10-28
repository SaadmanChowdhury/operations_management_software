<?php

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

Route::get('/readUser/{id}', [UserController::class, 'readUser']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/readUser/{id}', [UserController::class, 'readUser']);

Route::get('/user-modal', function () {
    return view('user-modal');
});

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