<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/assign-summary', function () {
    return view('assign_summary');
});

Route::get('/project-list', function () {
    return view('project_list');
});

Route::get('/user-list', function () {
    return view('user_list');
});

Route::get('/client-list', function () {
    return view('client_list');
});