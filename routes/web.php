<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AssignController;
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

Route::post("/API/fetchUserLookup", [UserController::class, 'fetchUserLookup']);
Route::post("/API/fetchClientLookup", [ClientController::class, 'fetchClientLookup']);

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
Route::post("/API/fetchUserList", [UserController::class, 'fetchUserList']);
Route::post("/API/updateUser", [UserController::class, 'updateUser']);
Route::post("/API/deleteUser", [UserController::class, 'deleteUser']);

Route::post("/API/updateUIPreference", [UserController::class, 'updateUserUIPreference']);

// Route::post('user', [UserController::class, 'store'])->name('user.createUser');
// Route::get('/readUser/{id}', [UserController::class, 'readUser']);
// Route::put('user/update', [UserController::class, 'updateUser'])->name('user.update');
// Route::get('user/delete/{id}', [UserController::class, 'deleteUser']);

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------


Route::get('/assign', [AssignController::class, 'index']);


//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------


// Route::get('/project', function () {
//     return view('project_list');
// });


//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------

Route::get('/client', [ClientController::class, 'index']);
Route::get('/client-list', function () {
    return redirect('client');
});

Route::post("/API/createClient", [ClientController::class, 'createClient']);
Route::post("/API/readClient",   [ClientController::class, 'readClient']);
Route::post("/API/updateClient", [ClientController::class, 'updateClient']);
Route::post("/API/deleteClient", [ClientController::class, 'deleteClient']);

//for testing the method
Route::get('/client/total-sale/{id}', [ClientController::class, 'getTotalSale']);
Route::get('/client/total-profit/{id}', [ClientController::class, 'getTotalProfit']);
Route::get('/user-modal', function () {
    return view('user-modal');
});
Route::get('/client-modal', function () {
    return view('client-modal');
});



Route::get('project/create', [ProjectController::class, 'getCreateView']);
Route::get('project/edit/{id}', [ProjectController::class, 'getEditView']);

Route::get('/project', [ProjectController::class, 'index']);
Route::post("/API/createProject", [ProjectController::class, 'createProject']);
Route::post("/API/readProject",   [ProjectController::class, 'readProject']);
Route::post("/API/updateProject", [ProjectController::class, 'updateProject']);
Route::post("/API/deleteProject", [ProjectController::class, 'deleteProject']);

Route::post("/API/getTotalProfit", [ClientController::class, 'getTotalProfit']);

Route::post('/API/fetchProjectList', [ProjectController::class, 'fetchProjectList']);
Route::post('/API/readProjectDetails', [ProjectController::class, 'readProjectDetails']);
Route::post('/API/upsertProjectDetails', [ProjectController::class, 'upsertProjectDetails']);
Route::post('/API/readProjectAssign', [ProjectController::class, 'readProjectAssign']);

Route::post('/API/upsertAssign', [ProjectController::class, 'upsertAssign']);

Route::post('/API/assignSummary', [AssignController::class, 'assignSummary']);



//for testing the update function
Route::get('/test-view', function () {
    return view('project.test');
});
