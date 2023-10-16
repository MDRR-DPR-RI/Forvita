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


// <!DOCTYPE html>
// <html lang="en">
//   <head>

//     <!-- Required meta tags -->
//     <meta charset="utf-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

//     <!-- Meta -->
//     <meta name="description" content="">
//     <meta name="author" content="Themepixels">

//     <!-- Favicon -->
//     <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">

//     <title>DashByte - Premium Dashboard Template</title>

//     <!-- Vendor CSS -->
//     <link rel="stylesheet" href="../lib/remixicon/fonts/remixicon.css">

//     <!-- Template CSS -->
//     <link rel="stylesheet" href="../assets/css/style.min.css">
//   </head>
//   <body class="page-sign">

//     <div class="card card-sign">
//       <div class="card-header">
//         <a href="../" class="header-logo mb-4">dashbyte</a>
//         <h3 class="card-title">Sign In</h3>
//         <p class="card-text">Welcome back! Please signin to continue.</p>
//       </div><!-- card-header -->
//       <div class="card-body">
//         <div class="mb-4">
//           <label class="form-label">Email address</label>
//           <input type="text" class="form-control" placeholder="Enter your email address">
//         </div>
//         <div class="mb-4">
//           <label class="form-label d-flex justify-content-between">Password <a href="">Forgot password?</a></label>
//           <input type="password" class="form-control" placeholder="Enter your password">
//         </div>
//         <button class="btn btn-primary btn-sign">Sign In</button>

//         <div class="divider"><span>or sign in with</span></div>

//         <div class="row gx-2">
//           <div class="col"><button class="btn btn-facebook"><i class="ri-facebook-fill"></i> Facebook</button></div>
//           <div class="col"><button class="btn btn-google"><i class="ri-google-fill"></i> Google</button></div>
//         </div><!-- row -->
//       </div><!-- card-body -->
//       <div class="card-footer">
//         Don't have an account? <a href="sign-up.html">Create an Account</a>
//       </div><!-- card-footer -->
//     </div><!-- card -->

//     <script src="../lib/jquery/jquery.min.js"></script>
//     <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
//     <script>
//       'use script'

//       var skinMode = localStorage.getItem('skin-mode');
//       if(skinMode) {
//         $('html').attr('data-skin', 'dark');
//       }
//     </script>
//   </body>
// </html>







// <!DOCTYPE html>
// <html lang="en">
//   <head>

//     <!-- Required meta tags -->
//     <meta charset="utf-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

//     <!-- Meta -->
//     <meta name="description" content="">
//     <meta name="author" content="Themepixels">

//     <!-- Favicon -->
//     <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">

//     <title>DashByte - Premium Dashboard Template</title>

//     <!-- Vendor CSS -->
//     <link rel="stylesheet" href="../lib/remixicon/fonts/remixicon.css">

//     <!-- Template CSS -->
//     <link rel="stylesheet" href="../assets/css/style.min.css">
//   </head>
//   <body class="page-sign">

//     <div class="card card-sign">
//       <div class="card-header">
//         <a href="../" class="header-logo mb-4">dashbyte</a>
//         <h3 class="card-title">Sign Up</h3>
//         <p class="card-text">It's free to signup and only takes a minute.</p>
//       </div><!-- card-header -->
//       <div class="card-body">
//         <div class="mb-3">
//           <label class="form-label">Email address</label>
//           <input type="text" class="form-control" placeholder="Enter your email address">
//         </div>
//         <div class="mb-3">
//           <label class="form-label">Password</label>
//           <input type="password" class="form-control" placeholder="Enter your password">
//         </div>
//         <div class="mb-3">
//           <label class="form-label">Full name</label>
//           <input type="text" class="form-control" placeholder="Enter your full name">
//         </div>
//         <div class="mb-4">
//           <small>By clicking <strong>Create Account</strong> below, you agree to our terms of service and privacy statement.</small>
//         </div>
//         <button class="btn btn-primary btn-sign">Create Account</button>

//         <div class="divider"><span>or sign up using</span></div>

//         <div class="row gx-2">
//           <div class="col"><button class="btn btn-facebook"><i class="ri-facebook-fill"></i> Facebook</button></div>
//           <div class="col"><button class="btn btn-google"><i class="ri-google-fill"></i> Google</button></div>
//         </div><!-- row -->
//       </div><!-- card-body -->
//       <div class="card-footer">
//         Already have an account? <a href="sign-in.html">Sign In</a>
//       </div><!-- card-footer -->
//     </div><!-- card -->

//     <script src="../lib/jquery/jquery.min.js"></script>
//     <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
//     <script>
//       'use script'

//       var skinMode = localStorage.getItem('skin-mode');
//       if(skinMode) {
//         $('html').attr('data-skin', 'dark');
//       }
//     </script>
//   </body>
// </html>
