
 <!DOCTYPE html>
 <html lang="en">
   <head>

     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- Meta -->
     <meta name="description" content="">
     <meta name="author" content="Themepixels">

     <!-- Favicon -->
     <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.png">

     <title>DashByte - Premium Dashboard Template</title>

     <!-- Vendor CSS -->
     <link rel="stylesheet" href="/lib/remixicon/fonts/remixicon.css">

     <!-- Template CSS -->
     <link rel="stylesheet" href="/css/style.min.css">
   </head>
   <body class="page-sign">

     <div class="card card-sign">
       <div class="card-header">
         <a href="/" class="header-logo mb-4">dashbyte</a>
         <h3 class="card-title">Sign Up</h3>
         <p class="card-text">It's free to signup and only takes a minute.</p>
       </div><!-- card-header -->
       <div class="card-body">
         <div class="mb-3">
           <label class="form-label">Email address</label>
           <input type="text" class="form-control" placeholder="Enter your email address">
         </div>
         <div class="mb-3">
           <label class="form-label">Password</label>
           <input type="password" class="form-control" placeholder="Enter your password">
         </div>
         <div class="mb-3">
           <label class="form-label">Full name</label>
           <input type="text" class="form-control" placeholder="Enter your full name">
         </div>
         <div class="mb-4">
           <small>By clicking <strong>Create Account</strong> below, you agree to our terms of service and privacy statement.</small>
         </div>
         <button class="btn btn-primary btn-sign">Create Account</button>

         <div class="divider"><span>or sign up using</span></div>

         <div class="row gx-2">
           <div class="col"><button class="btn btn-facebook"><i class="ri-facebook-fill"></i> Facebook</button></div>
           <div class="col"><button class="btn btn-google"><i class="ri-google-fill"></i> Google</button></div>
         </div><!-- row -->
       </div><!-- card-body -->
       <div class="card-footer">
         Already have an account? <a href="sign-in.html">Sign In</a>
       </div><!-- card-footer -->
     </div><!-- card -->

     <script src="/lib/jquery/jquery.min.js"></script>
     <script src="/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
     <script>
       'use script'

       var skinMode = localStorage.getItem('skin-mode');
       if(skinMode) {
         $('html').attr('data-skin', 'dark');
       }
     </script>
   </body>
 </html>
