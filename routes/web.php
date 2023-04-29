<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RolesController;
use App\Http\Middleware\Authorize;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleMiddleware;

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

Route::get('/users/create_user', [UserController::class, 'create']);

Route::get('/index', [UserController::class, 'index']);

Route::post('/users/store', [UserController::class, 'store']);

Route::get('/', [UserController::class, 'login'])->name('login');

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [UserController::class, 'logout']);

    Route::get('/account/{user}', [UserController::class, 'edit']);

    Route::put('/users/update/{user}', [UserController::class, 'update']);

    Route::put('/users/update_photo/{user}', [UserController::class, 'update_photo']);

    Route::middleware(['auth', PermissionMiddleware::class . ':manage_users'])->group(function () {
        Route::get('/users/show', [UserController::class, 'show']);

        Route::get('/users/profile/show/{id}', [UserController::class, 'display']);

        Route::get('/users/edit/{id}', [UserController::class, 'edit_user']);

        Route::put('/users/update_user/{user}', [UserController::class, 'update_user']);

        Route::delete('/users/destroy/{user}', [UserController::class, 'destroy']);

        Route::delete('/users/delete_user/{user}', [UserController::class, 'delete_user']);

        Route::get('/users/list', [UserController::class, 'list']);

        Route::get('/users/project_list/{id}', [UserController::class, 'project_list']);

        Route::get('/users/task_list/{id}', [UserController::class, 'task_list']);
    });

    //---------------------------------------------------------------

    Route::middleware(['auth', PermissionMiddleware::class . ':manage_clients'])->group(function () {
        // Your routes that require the manage-clients permission
        Route::get('/clients/show', [ClientController::class, 'index']);

        Route::get('/clients/profile/show/{id}', [ClientController::class, 'show']);

        Route::get('/clients/create', [ClientController::class, 'create']);

        Route::post('/clients/store', [ClientController::class, 'store']);

        Route::get('/clients/edit/{id}', [ClientController::class, 'edit']);

        Route::put('/clients/update/{id}', [ClientController::class, 'update']);

        Route::delete('/clients/destroy/{id}', [ClientController::class, 'destroy']);

        Route::get('/clients/list', [ClientController::class, 'list']);

        Route::get('/clients/project_list/{id}', [ClientController::class, 'project_list']);
    });


    //---------------------------------------------------------------

    Route::middleware(['auth', PermissionMiddleware::class . ':manage_projects'])->group(function () {

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

        Route::get('/status/create', [StatusController::class, 'create']);

        Route::post('/status/store', [StatusController::class, 'store']);
    });

    //---------------------------------------------------------------

    Route::middleware(['auth', PermissionMiddleware::class . ':manage_tasks'])->group(function () {

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
    });
    //---------------------------------------------------------------

    Route::get('/todos', [TodosController::class, 'index']);

    Route::get('/todos/create', [TodosController::class, 'create']);

    Route::post('/todos/store', [TodosController::class, 'store']);

    Route::patch('/todos/cross/{id}', [TodosController::class, 'update_checked']);

    Route::get('/todos/edit/{id}', [TodosController::class, 'edit']);

    Route::put('/todos/update/{id}', [TodosController::class, 'update']);

    Route::delete('/todos/destroy/{id}', [TodosController::class, 'destroy']);

    //---------------------------------------------------------------

    Route::get('/password/request', [ForgotPasswordController::class, 'showLinkRequestForm']);

    Route::post('/password/reset', [ForgotPasswordController::class, 'sendResetLinkEmail']);

    //---------------------------------------------------------------

    Route::get('/search', [SearchController::class, 'search'])->name('search');

    //---------------------------------------------------------------
    Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
        Route::get('/settings', [RolesController::class, 'index']);

        Route::get('/settings/general', [RolesController::class, 'general_settings']);

        Route::delete('/roles/destroy/{id}', [RolesController::class, 'destroy']);

        Route::get('/roles/create', [RolesController::class, 'create']);

        Route::post('/roles/store', [RolesController::class, 'store']);

        Route::get('/roles/edit/{id}', [RolesController::class, 'edit']);

        Route::put('/roles/update/{id}', [RolesController::class, 'update']);
    });
});
