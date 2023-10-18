<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchedulerController;
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


Route::get('/dashboard/view/{dashboard:id}', function (Request $request, Dashboard $dashboard) {

    $cluster_id = $request->session()->get('cluster_id'); // get cluster_id from session which stored when select cluster after login 
    $dashboards = Dashboard::where('cluster_id', $cluster_id)->get();

    return view('dashboard.contents.main', [
        'dashboards' => $dashboards,
        'dashboard' => $dashboard,
        'contents' => Content::where('dashboard_id', $dashboard->id)->get(),
    ]);
});

Route::resource('/cluster', ClusterController::class);
Route::resource('/dashboard', DashboardController::class);
Route::resource('/dashboard/content', ContentController::class);

// ajax call, when select data in edit_chart page
Route::post('/fetch-data', function (Request $request) {
    $cleanAll = Clean::where('judul', $request->selectedJudul)->get();
    $xValue = Content::where('id', $request->contentId)->pluck('x_value');
    return response()->json([
        'value' => $cleanAll,
        'xValue' => $xValue
    ]);
});

// Scheduler routers
Route::get('scheduler', [SchedulerController::class, 'show']);
Route::get('scheduler/execute', [SchedulerController::class, 'execute']);
Route::post('scheduler', [SchedulerController::class, 'store']);
Route::patch('scheduler', [SchedulerController::class, 'update']);
Route::delete('scheduler', [SchedulerController::class, 'destroy']);
