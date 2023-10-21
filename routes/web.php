<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CsvImportController;
use App\Http\Controllers\SchedulerController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Route::get('/login',  [AuthController::class, 'login_view']); //loginpage
Route::post('/login',  [AuthController::class, 'login_submit']);

Route::post('/logout',  [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'register_view']);
Route::post('/register', [AuthController::class, 'register_submit']);

Route::resource('/cluster', ClusterController::class);
Route::resource('/dashboard', DashboardController::class);
Route::resource('/dashboard/content', ContentController::class);
Route::resource('/permission', PermissionController::class)->middleware('admin');

// ajax call, when select data in edit_chart page
Route::post('/fetch-data', [AjaxController::class, 'data_cleans']);

// ajax call, +grant access when add user email in permission page
Route::post('/fetch-dashboard', [AjaxController::class, 'data_dashboards']);

// Import Data CSV
Route::post('/import-csv', [CsvImportController::class, 'import'])->name('import.csv');

// Scheduler routers
Route::get('scheduler', [SchedulerController::class, 'show']);
Route::get('scheduler/execute', [SchedulerController::class, 'execute']);
Route::post('scheduler', [SchedulerController::class, 'store']);
Route::patch('scheduler', [SchedulerController::class, 'update']);
Route::delete('scheduler', [SchedulerController::class, 'destroy']);
