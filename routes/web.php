<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CsvImportController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\EmbedTableauController;
use App\Http\Controllers\ApiImportController;
use App\Http\Controllers\SchedulerController;
use App\Http\Controllers\TableauController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// ->middleware('admin') was created in app/Http/Middleware/IsAdmin. and register the middleware name as = 'admin' in Kernel.php

Route::redirect('/', '/login');

Route::get('/login',  [AuthController::class, 'login_view'])->name('login')->middleware('guest'); //loginpage
Route::post('/login',  [AuthController::class, 'login_submit'])->middleware('guest');

Route::post('/logout',  [AuthController::class, 'logout'])->middleware('auth');

Route::get('/register', [AuthController::class, 'register_view'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register_submit'])->middleware('guest');

Route::get('/profile', [UserController::class, 'show'])->middleware('auth');
Route::post('/profile', [UserController::class, 'update'])->middleware('auth');

Route::resource('/cluster', ClusterController::class)->middleware('auth');
Route::resource('/dashboard', DashboardController::class)->middleware('auth');
Route::resource('/dashboard/content', ContentController::class)->middleware('auth');

Route::post('/refresh-ticket', [EmbedTableauController::class, 'refresh'])->name('refreshTicket')->middleware('auth');

// ajax call, when select data in edit_chart page
Route::post('/fetch-data', [AjaxController::class, 'data_cleans'])->middleware('admin');

// ajax call, +grant access when add user email in permission page
Route::post('/fetch-dashboard', [AjaxController::class, 'data_dashboards'])->middleware('admin');

Route::get('/filter-clean', [AjaxController::class, 'filter_clean_by_date'])->middleware('admin');

// Import Data CSV
Route::get('csv', [CsvImportController::class, 'show'])->name('csv')->middleware('admin');
Route::get('csv/view', [CsvImportController::class, 'viewTable'])->name('csv.view')->middleware('admin');
Route::get('csv/view/target', [CsvImportController::class, 'handleFile'])->name('csv.target')->middleware('admin');
Route::get('csv/create', [CsvImportController::class, 'createTable'])->name('csv.create')->middleware('admin');
Route::get('csv/remove', [CsvImportController::class, 'removeTable'])->name('csv.remove')->middleware('admin');
Route::get('csv/delete', [CsvImportController::class, 'deleteTable'])->name('csv.delete')->middleware('admin');
// import API
Route::get('restapi', [ApiImportController::class, 'show'])->name('restapi')->middleware('admin');
Route::get('restapi/view', [ApiImportController::class, 'viewTable'])->name('restapi.view')->middleware('admin');
// Route::get('restapi/view/target', [CsvImportController::class, 'handleFile'])->name('csv.target')->middleware('admin');
Route::get('restapi/create', [ApiImportController::class, 'createTable'])->name('restapi.create')->middleware('admin');
Route::get('restapi/remove', [ApiImportController::class, 'deleteList'])->name('restapi.remove')->middleware('admin');
Route::get('restapi/delete', [ApiImportController::class, 'deleteTable'])->name('restapi.delete')->middleware('admin');

Route::post('/import-csv', [CsvImportController::class, 'import'])->name('import.csv')->middleware('admin');

// Import Data From RESTful API
Route::post('/import-api', [ApiImportController::class, 'import'])->name('import.api')->middleware('admin');

// Share Public Dashboard
Route::resource('/share', ShareController::class)->middleware('admin');
Route::get('public/dashboard/{link}', [ShareController::class, 'index']);

// Scheduler Routers
Route::get('scheduler/execute', [SchedulerController::class, 'execute'])->middleware('admin');
Route::get('scheduler', [SchedulerController::class, 'show'])->middleware('admin');
Route::post('scheduler', [SchedulerController::class, 'store'])->middleware('admin');
Route::patch('scheduler', [SchedulerController::class, 'update'])->middleware('admin');
Route::delete('scheduler', [SchedulerController::class, 'destroy'])->middleware('admin');

// Database Routers
Route::get('database/test-connection', [DatabaseController::class, 'testConnection'])->middleware('admin');
Route::get('database', [DatabaseController::class, 'show'])->middleware('admin');
Route::post('database', [DatabaseController::class, 'store'])->middleware('admin');
Route::patch('database', [DatabaseController::class, 'update'])->middleware('admin');
Route::delete('database', [DatabaseController::class, 'destroy'])->middleware('admin');

// User Management Routers
Route::get('user-management', [UserManagementController::class, 'index'])->middleware('admin');

// Data Tables Routers
Route::get('data-table', [DataTableController::class, 'index'])->middleware('admin');
