<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchedulerController;
use App\Http\Controllers\DatabaseController;
use App\Models\Dashboard;
use App\Models\Clean;
use App\Models\Content;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
Route::post('/login',  [AuthController::class, 'login_submit']); //loginpage

Route::post('/logout',  [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'register_view']);
Route::post('/register', [AuthController::class, 'register_submit']);


Route::get('/dashboard/control/{dashboard:id}', function (Request $request) {
    $cluster_id = $request->query('cluster_id');
    $dashboard_id = $request->query('dashboard_id');
    $dashboards = Dashboard::where('cluster_id', $cluster_id)->get();
    $dashboard = Dashboard::where('id', $dashboard_id)->first();
    return view('dashboard.contents.main', [
        'dashboards' => $dashboards,
        'dashboard_name' => $dashboard->name,
        'dashboard_id' => $dashboard->id,
        'contents' => Content::where('dashboard_id', $dashboard->id)->get(),
    ]);
});

Route::resource('/cluster', ClusterController::class);
Route::resource('/dashboard', DashboardController::class);
Route::resource('/dashboard/content', ContentController::class);
Route::post('/fetch-data', function (Request $request) {

    // return response()->json($request->selectedJudul);

    $cleanAll = Clean::where('judul', $request->selectedJudul)->get();
    $xValue = Content::where('id', $request->contentId)->pluck('x_value');
    return response()->json([
        'value' => $cleanAll,
        'xValue' => $xValue
    ]);
});

// Scheduler Routers
Route::get('scheduler', [SchedulerController::class, 'show']);
Route::get('scheduler/execute', [SchedulerController::class, 'execute']);
Route::post('scheduler', [SchedulerController::class, 'store']);
Route::patch('scheduler', [SchedulerController::class, 'update']);
Route::delete('scheduler', [SchedulerController::class, 'destroy']);

// Database Routers
Route::get('database', [DatabaseController::class, 'show']);
Route::post('database', [DatabaseController::class, 'store']);
Route::patch('database', [DatabaseController::class, 'update']);
Route::delete('database', [DatabaseController::class, 'destroy']);
