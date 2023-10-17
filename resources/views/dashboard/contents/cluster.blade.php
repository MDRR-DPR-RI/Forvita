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

  <title>Satu Data</title>
 
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/lib/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="/lib/apexcharts/apexcharts.css">
    <link rel="stylesheet" href="/lib/prismjs/themes/prism.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Vendor --}}
    @yield('custom_vendor')

  <!-- Template CSS -->
  <link rel="stylesheet" href="/css/style.min.css">
</head>

<body>
    {{-- Top Bar --}}
        @include('dashboard.partials.topbar')

 <div class="main main-app p-3 p-lg-4">
        <div class="row g-3" id="main">
            @foreach ($clusters as $cluster)
                <div class="col-xl-4" >
                    <div class="row g-3" id="content">
                        <div class="col-6 col-sm">
                            <div class="card card-one">
                                <div class="card-body p-3">
                                    <div class="d-block fs-40 lh-1 text-primary mb-1"><i class="ri-calendar-todo-line"></i></div>
                                    <h1 class="card-value mb-0 ls--1 fs-32" id="card-val">{{ $cluster->name }}}</h1>
                                    {{-- <label class="d-block mb-1 fw-medium text-dark">${x_value[j]}</label> --}}
                                    {{-- <small><span class="d-inline-flex text-danger">0.7% <i class="ri-arrow-down-line"></i></span> than last week</small> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!-- row -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. DPR RI</span>
        </div><!-- main-footer -->
    </div><!-- main -->

{{-- Custom Script --}}
  <script src="/lib/jquery/jquery.min.js"></script>
  <script src="/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  
  <script src="/js/script.js"></script>
  
 <script src="/lib/apexcharts/apexcharts.min.js"></script>

  <script src="/js/db.data.js"></script>
  <script src="/js/db.finance.js"></script>
  
@yield('custom_script')

</body>

</html>