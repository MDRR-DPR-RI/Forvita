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