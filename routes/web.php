<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\StatusController;
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


//---------------------------------------------------------------

Route::get('/register', [UserController::class, 'create']);

Route::get('/', [UserController::class, 'index']);

Route::post('/users', [UserController::class, 'store']);

Route::post('/logout', [UserController::class, 'logout']);

Route::get('/login', [UserController::class, 'login']);

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::get('/users/show', [UserController::class, 'show']);

Route::get('/users/profile/show/{id}', [UserController::class, 'display']);

Route::get('/account/{user}', [UserController::class, 'edit']);

Route::put('/users/update/{user}', [UserController::class, 'update']);
Route::put('/users/update_photo/{user}', [UserController::class, 'update_photo']);

Route::delete('/users/destroy/{user}', [UserController::class, 'destroy']);

Route::get('/users/list', [UserController::class, 'list']);

Route::get('/users/project_list/{id}', [UserController::class, 'project_list']);

Route::get('/users/task_list/{id}', [UserController::class, 'task_list']);

//---------------------------------------------------------------

Route::get('/clients/show', [ClientController::class, 'index']);

Route::get('/clients/profile/show/{id}', [ClientController::class, 'show']);

Route::get('/clients/create', [ClientController::class, 'create']);

Route::post('/clients/store', [ClientController::class, 'store']);

Route::get('/clients/edit/{id}', [ClientController::class, 'edit']);

Route::put('/clients/update/{id}', [ClientController::class, 'update']);

Route::delete('/clients/destroy/{id}', [ClientController::class, 'destroy']);

Route::get('/clients/list', [ClientController::class, 'list']);

Route::get('/clients/project_list/{id}', [ClientController::class, 'project_list']);

//---------------------------------------------------------------

Route::get('/projects', [ProjectsController::class, 'index']);

Route::get('/projects/list_view', [ProjectsController::class, 'list_view']);

Route::get('/projects/information/{id}', [ProjectsController::class, 'show']);

Route::get('/projects/create', [ProjectsController::class, 'create']);

Route::post('/projects/store', [ProjectsController::class, 'store']);

Route::get('/projects/edit/{id}', [ProjectsController::class, 'edit']);

Route::put('/projects/update/{id}', [ProjectsController::class, 'update']);

Route::delete('/projects/destroy/{id}', [ProjectsController::class, 'destroy']);

Route::get('/projects/list', [ProjectsController::class, 'list']);

Route::get('/projects/task_list/{id}', [ProjectsController::class, 'task_list']);

Route::get('/projects/tasks/list/{id}', [ProjectsController::class, 'taskList']);

Route::get('/projects/tasks/board/{id}', [ProjectsController::class, 'taskBoard']);

//---------------------------------------------------------------

Route::get('/tasks', [TasksController::class, 'index']);

Route::get('/tasks/information/{id}', [TasksController::class, 'show']);

Route::get('/tasks/create/{id}', [TasksController::class, 'create']);

Route::post('/tasks/store/{id}', [TasksController::class, 'store']);

Route::get('/tasks/edit/{id}', [TasksController::class, 'edit']);

Route::put('/tasks/update/{id}', [TasksController::class, 'update']);

Route::delete('/tasks/destroy/{id}', [TasksController::class, 'destroy']);

Route::get('/tasks/list', [TasksController::class, 'list']);

Route::get('/tasks/kanban', [TasksController::class, 'dragula']);

Route::put('/tasks/{id}/update-status/{status}', [TasksController::class, 'updateStatus']);

//---------------------------------------------------------------

Route::get('/todos', [TodosController::class, 'index']);

Route::get('/todos/create', [TodosController::class, 'create']);

Route::post('/todos/store', [TodosController::class, 'store']);

Route::patch('/todos/cross/{id}', [TodosController::class, 'update_checked']);

Route::get('/todos/edit/{id}', [TodosController::class, 'edit']);

Route::put('/todos/update/{id}', [TodosController::class, 'update']);

Route::delete('/todos/destroy/{id}', [TodosController::class, 'destroy']);

//---------------------------------------------------------------

Route::get('/status/create', [StatusController::class, 'create']);

Route::post('/status/store', [StatusController::class, 'store']);

//---------------------------------------------------------------

Route::get('/password/request', [ForgotPasswordController::class, 'showLinkRequestForm']);

Route::post('/password/reset', [ForgotPasswordController::class, 'sendResetLinkEmail']);

//---------------------------------------------------------------

Route::get('/settings', function(){
    return view('settings');
});