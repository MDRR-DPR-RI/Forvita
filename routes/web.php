<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PromptController;
use App\Models\Dashboard;
use App\Models\Clean;
use App\Models\Content;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

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

Route::redirect('/', '/1');
$dashboards;
if (Schema::hasTable('dashboards')) {
    $dashboards = Dashboard::where('cluster_id', 1)->get();
}

foreach ($dashboards as $dashboard) {
    Route::get('/' . $dashboard->id, function () use ($dashboard) {
        return view('dashboard.layouts.main', [
            'dashboard_name' => $dashboard->name,
            'dashboard_id' => $dashboard->id,
            'contents' => Content::where('dashboard_id', $dashboard->id)->get(),
        ]);
    });
}
// Route::get('/kelompok1', function () {
//     return view('dashboard.contents.kelompok1', [
//         'dashboard' => 'kelompok1',
//         'contents' => Content::where('dashboard', 'kelompok1')->get(),
//     ]);
// });
// Route::get('/kelompok23', function () {
//     return view('dashboard.contents.kelompok23', [
//         'dashboard' => 'kelompok23',
//         'contents' => Content::where('dashboard', 'kelompok23')->get(),
//     ]);
// });
// Route::get('/kelompok46', function () {
//     return view('dashboard.contents.kelompok46', [
//         'dashboard' => 'kelompok46',
//         'contents' => Content::where('dashboard', 'kelompok46')->get(),
//     ]);
// });
// Route::get('/kelompok5', function () {
//     return view('dashboard.contents.kelompok5', [
//         'dashboard' => 'kelompok5',
//         'contents' => Content::where('dashboard', 'kelompok5')->get(),
//     ]);
// });

Route::resource('/dashboard/chart', ChartController::class);
Route::resource('/dashboard/content', ContentController::class);
Route::resource('/prompt', PromptController::class);
Route::post('/fetch-data', function (Request $request) {

    // return response()->json($request->selectedJudul);

    $cleanAll = Clean::where('judul', $request->selectedJudul)->get();
    $xValue = Content::where('id', $request->contentId)->pluck('x_value');
    return response()->json([
        'value' => $cleanAll,
        'xValue' => $xValue
    ]);
});
