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
        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @elseif (session()->has('deleted'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Deleted!</strong> {{ session('deleted') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      <div class="row g-3" id="main">
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
                          <td ">{{ $chart->name }}</td>
                          <td >{{ $chart->grid }}</td>
                          <form action="/dashboard/content" method="post">
                              @csrf
                            <input type="hidden" value="{{ $chart->id }}" name="chartId">
                            <input type="hidden" name="dashboard" value="{{ $dashboard }}" >
                            @if ($chart->id === 8 || $chart->id === 4 || $chart->id === 9)
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
                          <td>{{ $content->chart->grid }}</td>
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
            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          </div><!-- modal-footer -->
        </div><!-- modal-content -->
      </div><!-- modal-content -->
    </div>

{{-- include all assets (htmlStructures) --}}
<script src="/js/assets/htmlStructures.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- script to print content in the dashboard --}}
  <script>
    // Declare variables outside the loop
    let chartId, htmlContent, containerContent, uniqe;
    @foreach ($contents as $content)

      // Access the HTML structure based on the PHP value
      unique = 'content' + {{ $content->id }} // set unique value for each content
      chartId = {{ $content->chart->id }};
      y_value = {!! json_encode($content->y_value) !!}
      if (y_value) {
        y_value = y_value.split(','); // this for AI analyst 
      }

      htmlContent = htmlStructures[chartId][0];
      htmlContent = htmlContent.replace('id="content"', `id="${unique}"`); // set the unique id for each content

      // Create a containerContent element and set its innerHTML
      containerContent = document.getElementById('main');
      containerContent.innerHTML += htmlContent;
      // add AI analysis wkwk (ala-ala)
      if(chartId === 8){ // ai analyst is only in chartId = 8 
        if (y_value) { // if not null do ajax call api
          $(document).ready(function() {
            let inputString = "What is the total " + y_value.join(" plus ") + ".";
            inputString = inputString.replace(/"/g, ''); // Remove double quotes
            console.log(inputString);
            $.ajax({
              url: 'https://robomatic-ai.p.rapidapi.com/api',
              method: 'POST',
              headers: {
                  'content-type': 'application/x-www-form-urlencoded',
                  'X-RapidAPI-Key': '346543f61cmshefda0a20bd76340p19f426jsn816f3d62e933',
                  'X-RapidAPI-Host': 'robomatic-ai.p.rapidapi.com'
              },
              data: {
                  in: inputString, // request input hanya bisa simple math, belum bisa aneh2. like --> Please perform data analysis on the following dataset: I have three categories - 'Islam,' 'Kristen,' and 'Buddha,' each with respective totals of '800,' '200,' and '150.' Key 1 corresponds to Key 1. Kindly provide your analysis and insights in one paragraph.
                  op: 'in',
                  cbot: '1',
                  SessionID: 'RapidAPI1',
                  cbid: '1',
                  key: 'RHMN5hnQ4wTYZBGCF3dfxzypt68rVP',
                  ChatSource: 'RapidAPI',
                  duration: '1'
              },
              success: function (response) {
                const result = response.out;
                console.log("analysis result : " + result)

                // Set the result in the HTML element
                $('#aiAnalysis').text(result);
                
                // Empty the placeholder content
                $('#placeholder').empty();
              },
              error: function (error) {
                  console.error(error);
              }
          });
        })
      } else {
        $('#aiAnalysis').text("No data");

         // Empty the placeholder content
        $('#placeholder').empty();
      } 
    }
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
