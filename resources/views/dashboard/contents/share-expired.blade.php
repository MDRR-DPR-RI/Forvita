@extends('dashboard.layouts.share')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
<div class="page-error">
  <div class="header">
    <div class="container">
      <a href="/cluster" class="sidebar-logo">FORVITA</a>
    </div><!-- container -->
  </div><!-- header -->

  <div class="content">
    <div class="container">
      <div class="row gx-5">
        <div class="col-lg-5 d-flex flex-column align-items-center">
          <h1 class="error-number">MAAF</h1>
          <h2 class="error-title">Dashboard Tidak Ditemukan</h2>
          <p class="error-text">Silakan hubungi admin terlebih dahulu untuk dapat mengakses publik dashboard secara langsung.</p>
        </div><!-- col -->
        <div class="col-8 col-lg-6 mb-5 mb-lg-0">
          <object type="image/svg+xml" data="/img/pair_programming.svg" class="w-100"></object>
        </div><!-- col -->
      </div><!-- row -->
    </div><!-- container -->
  </div><!-- content -->
</div>

    <script src="/lib/jquery/jquery.min.js"></script>
    <script src="/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
      'use script'

      var skinMode = localStorage.getItem('skin-mode');
      if(skinMode) {
        $('html').attr('data-skin', 'dark');
      }
    </script>



@endsection