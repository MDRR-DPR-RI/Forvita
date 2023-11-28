

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

     <title>SATUDATA. Login</title>

     <!-- Vendor CSS -->
     <link rel="stylesheet" href="/lib/remixicon/fonts/remixicon.css">

     <!-- Template CSS -->
     <link rel="stylesheet" href="/css/style.min.css">
   </head>
   <body class="page-sign">
    <form action="/login" method="post">
          @csrf
     <div class="card card-sign">
   
   @if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert"> 
  {{ session('success') }}  
</div>
  @endif

   @if(session()->has('loginError'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ session('loginError') }}  
</div>
  @endif
       <div class="card-header">
         <a href="../" class="header-logo mb-4">SATUDATA</a>
         <h3 class="card-title">Masuk</h3>
         <p class="card-text">Halo! Silahkan login untuk melanjutkan.</p>
       </div><!-- card-header -->
       <div class="card-body">
         <div class="mb-4">
           <label class="form-label" for="email">Alamat Email</label>
             @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
           <input value="{{ old('email') }}" type="email" id="email" class="form-control @error('email') is-invalid @enderror""
              placeholder="Masukkan Alamat Email" name="email" autofocus required/>
         </div>
         <div class="mb-4">
           <label class="form-label d-flex justify-content-between">Kata Sandi</label>
          <input name="password" type="password" id="password" class="form-control"
              placeholder="Masukkan Kata Sandi" required/>
         </div>
         <button class="btn btn-primary btn-sign">Masuk</button>

         <div class="divider"><span>Atau Masuk Dengan</span></div>

         <div class="row gx-2">
          <div class="col">
            <a href="{{ route('auth.google') }}" class="btn btn-google">
            <i class="ri-google-fill"></i> Google
            </a>
          </div>
          </div>
       </div><!-- card-body -->
       <div class="card-footer">
       </div><!-- card-footer -->
     </div><!-- card -->

     <script src="../lib/jquery/jquery.min.js"></script>
     <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
     <script>
       'use script'

       var skinMode = localStorage.getItem('skin-mode');
       if(skinMode) {
         $('html').attr('data-skin', 'dark');
       }
     </script>
    </form>

   </body>
 </html>


