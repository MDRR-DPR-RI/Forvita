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

<title>
  @if (null !== session('cluster_name'))
      {{ session('cluster_name') }} - 
  @endif
  FORVITA
</title>

 
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css"/>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <link rel="stylesheet" href="/lib/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="/lib/apexcharts/apexcharts.css">
    <link rel="stylesheet" href="/lib/prismjs/themes/prism.min.css">
    <link rel="stylesheet" href="/lib/datetime/flatpickr.min.css">


    <link rel="stylesheet" href="/lib/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/lib/iconpicker-master/dist/iconpicker.js"  />


    <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Vendor --}}
    @yield('custom_vendor')

  <!-- Template CSS -->
  <link rel="stylesheet" href="/css/style.min.css">
</head>

<body>
@if(isset($contents))
    <script>
        var contents = @json($contents);
    </script>
@endif
{{-- Side Bar --}}
    @include('dashboard.partials.sidebar') 

    {{-- Top Bar --}}
        @include('dashboard.partials.topbar')

      {{-- Page Content --}}
          @yield('page_content')

  {{-- script for all contents --}}
 
  <script src="/lib/jquery/jquery.min.js"></script>
  <script src="/lib/gridjs-jquery/gridjs.production.min.js"></script>
  <script src="/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="/lib/iconpicker-master/dist/iconpicker.js"></script>


  <script src="/js/script.js"></script>

  @yield('custom_script')
   <script>
   $(document).ready(function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    // console.log((tooltipTriggerEl));
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  });
  
  </script>
  @stack('addon-script')

</body>

</html>
