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
<meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Vendor --}}
    @yield('custom_vendor')

  <!-- Template CSS -->
  <link rel="stylesheet" href="/css/style.min.css">
</head>

{{-- <script src="/js/charts/index.js"></script> --}}
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
        
      
    <div class="main main-app p-3 p-lg-4">
        @yield('page_content')
      <div class="row g-3" id="content">
        {{-- CHART CONTENT WILL GOES HERE --}}
      </div><!-- row -->
      <div class="main-footer mt-5">
        <span>&copy; 2023. DPR RI</span>
      </div><!-- main-footer -->
    </div><!-- main -->

                
@if (isset($contents))                      
      {{-- Modal Customize Dashboard for all--}}
       <div class="modal fade" id="modal3" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Customize Dashboard {{ $dashboard }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><!-- modal-header -->
          <div class="modal-body container text-center">
            <div class="row align-items-start">
              <div class="col">
                Chart
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Cluster</th>
                      <th scope="col">Type</th>
                      <th scope="col">Grid</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($charts as $chart)
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td id="itemName_{{ $loop->iteration }}"></td>
                          <td id="grid_{{ $loop->iteration }}"></td>
                          <form action="/dashboard/content" method="post">
                              @csrf
                            <input type="hidden" value="{{ $chart->id }}" name="chartId">
                            <input type="hidden" name="dashboard" value="{{ $dashboard }}" >
                            @if ($chart->id === 8)
                              <td><button type="submit" class="btn btn-primary">Add</button></td>
                            @else
                              <td><button type="submit" class="btn btn-warning">Belum bisa dynamic data</button></td>
                            @endif
                          </form>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="col">
                content
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Cluster</th>
                      <th scope="col">Grid</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($contents as $content)
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td>{{ $content->chart->id }}</td>
                          <td>8</td>
                          <td style="display: flex; justify-content: center;  align-items: center;">
                            <form action="/dashboard/content/{{ $content->id }}" method="post">
                              <a href="/dashboard/content/{{ $content->id }}?dashboard={{ $dashboard }}" class="btn btn-primary">Edit </a>
                                @method('delete')
                                @csrf
                              <input type="hidden" name="dashboard" value="{{ $dashboard }}">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                          </td>
                        </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div><!-- modal-footer -->
        </div><!-- modal-content -->
      </div><!-- modal-content -->
    </div>


<script src="/js/assets/charts.js"></script>
  <script>
    // Declare variables outside the loop
    let contentId, htmlContent, containerContent, containerContentName, itemName, containerGrid, grid;

    // Chart Assets to show in modal
    @foreach ($charts as $chart)
      itemName = htmlStructures[{{ $loop->iteration }}][1]
      containerContentName = document.getElementById('itemName_{{ $loop->iteration }}');
      containerContentName.innerHTML += itemName;

      grid = htmlStructures[{{ $loop->iteration }}][2]
      containerGrid = document.getElementById('grid_{{ $loop->iteration }}');
      containerGrid.innerHTML += grid;
    @endforeach

    // Content to show in modal
    @foreach ($contents as $content)
      // Access the HTML structure based on the PHP value
      contentId = {{ $content->chart->id }};
      htmlContent = htmlStructures[contentId][0];
      
      // Create a containerContent element and set its innerHTML
      containerContent = document.getElementById('content');
      containerContent.innerHTML += htmlContent;

    @endforeach
</script>
@endif

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
