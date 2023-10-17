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
        @if (isset($content))
          @yield('page_content')
        @else
          <div class="d-md-flex align-items-center justify-content-between mb-4">
            <div>
              <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item"><a>@isset($currentParentPage) {{$currentParentPage}} @else Dashboard @endisset</a></li>
                <li class="breadcrumb-item active" aria-current="page">@isset($currentPage) {{$currentPage}} @else Dashboard Content @endisset</li>
              </ol>
              <h4 class="main-title mb-0">@isset($currentPage) {{$currentPage}} @else Content Title @endisset</h4>
            </div>
                
            <div class="d-flex gap-2 mt-3 mt-md-0">
              <button type="button" class="btn btn-white d-flex align-items-center gap-2"><i class="ri-share-line fs-18 lh-1"></i>Share</button>
              <button type="button" class="btn btn-white d-flex align-items-center gap-2"><i class="ri-printer-line fs-18 lh-1"></i>Print</button>
              <a href="#modal3" class="btn btn-primary d-flex align-items-center gap-2"  data-bs-toggle="modal"><i class="ri-bar-chart-2-line fs-18 lh-1"></i>Customize<span class="d-none d-sm-inline"> Dashboard</span></a>
            </div>
          </div>
        @endif
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
              <h5 class="modal-title">Customize Dashboard {{ $dashboard_name }}</h5>
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
                            <td>{{ $chart->name }}</td>
                            <td>{{ $chart->grid }}</td>
                            <form action="/dashboard/content" method="post">
                                @csrf
                              <input type="hidden" value="{{ $chart->id }}" name="chartId">
                              <input type="hidden" name="dashboard_id" value="{{ $dashboard_id }}" >
                              <input type="hidden" name="dashboard_name" value="{{ $dashboard_name }}" >
                              @if ($chart->id === 8 || $chart->id === 4 || $chart->id === 9 || $chart->id === 10 || $chart->id === 11 || $chart->id === 12 || $chart->id === 13)
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
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $content->chart->id }}</td>
                            <td>{{ $content->chart->grid }}</td>
                            <td style="display: flex; justify-content: center;  align-items: center;">
                              <form action="/dashboard/content/{{ $content->id }}" method="post">
                                <a href="/dashboard/content/{{ $content->id }}?dashboard_name={{ $dashboard_name }}&dashboard_id={{ $dashboard_id }}" class="btn btn-primary">Edit </a>
                                  @method('delete')
                                  @csrf
                                <input type="hidden" name="dashboard_id" value="{{ $dashboard_id }}">
                                <input type="hidden" name="dashboard_name" value="{{ $dashboard_name }}">
                                  <button type="submit" class="btn btn-danger">Delete</button>
                              </form>
                            </td>
                          </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
         
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          </div><!-- modal-footer -->
        </div><!-- modal-content -->
      </div>

{{-- Modal Edit PROMPT--}}
      <div class="modal fade" id="modalprompt" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Prompt</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!-- modal-header -->
            <form id="contentForm" action="dashboard/content/" method="post">
              @method('put')
              @csrf
              <div class="modal-body container text-center">
                <label for="judul">Select Prompt:</label>
                {{-- set on change function, when user add new prompt, then will show INPUT FIELD to enter new prompt --}}
                <select id="selectPrompt" class="form-select" name="selectPrompt" onchange="checkForNewPrompt()">
                  @foreach ($prompts as $prompt)
                    @if ($prompt->id == 3) <!-- IMPORTANT: UPDATE THIS IF $prompt->id is EQUAL with the prompt_id in table contents -->
                      <option value="{{ $prompt->id }}" selected>{{ $prompt->body }}</option>
                    @else
                      <option value="{{ $prompt->id }}">{{ $prompt->body }}</option>
                    @endif
                  
                  @endforeach
                  {{-- IF THE USER ADD NEW PROMPT THEN UPDATE THE prompt_id in contents(table) WITH next id of prompt(new id) --}}
                  @php
                    // Calculate the next ID by adding 1 to the last prompt's ID
                    $nextId = $prompts->isEmpty() ? 1 : $prompts->last()->id + 1;
                  @endphp
                    <option value="{{ $nextId }}">Add New Prompt</option>
                </select>
                <!-- Add a new prompt input field initially hidden -->
                <div id="newPromptInput" class="modal-body container text-center" style="display: none;">
                  <label for="newPrompt">Enter New Prompt:</label>
                  <input type="text" id="newPrompt" name="newPrompt" class="form-control">
                </div>
                <input type="hidden" name="dashboard_id" value="{{ $dashboard_id }}" >

                {{-- SCRIPT TO SHOW INPUT FIELD IF USER WANT TO ADD THEIR OWN/NEW PROMPT --}}
                  <script>
                  function checkForNewPrompt() {
                    const select = document.getElementById('selectPrompt');
                    const newPromptInput = document.getElementById('newPromptInput');
                    const newPrompt = document.getElementById('newPrompt');

                    if (select.value == {{ $nextId }}) {
                      newPromptInput.style.display = 'block'; // Show the new prompt input
                      newPrompt.required = true; // Make the new prompt field required
                    } else {
                      newPromptInput.style.display = 'none'; // Hide the new prompt input
                      newPrompt.required = false; // Make the new prompt field not required
                    }
                  }
                </script>
                
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Prompt</button>
              </div>
            </form>
            </div><!-- modal-footer -->
          </div><!-- modal-content -->
        </div><!-- modal-content -->
      </div>


{{-- include all assets (htmlStructures) --}}
<script src="/js/assets/htmlStructures.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- script to print content in the dashboard --}}
  <script >
    // Declare variables outside the loop
    let chartId, htmlContent, containerContent, unique, y_value, x_value;
    @foreach ($contents as $content)
      // Access the HTML structure based on the PHP value
      unique = 'content' + {{ $content->id }}; // set unique value for each content
      chartId = {{ $content->chart->id }};
      y_value = {!! json_encode($content->y_value) !!}
      x_value = {!! json_encode($content->x_value) !!}
      htmlContent = htmlStructures[chartId][0];

      htmlContent = htmlContent.replace('id="content"', `id="${unique}"`); // set the unique id for each content
      htmlContent = htmlContent.replace('id="judul"', `id="judul${unique}"`); // set the unique id for each content
      htmlContent = htmlContent.replace('id="aiAnalysis"', `id="aiAnalysis${unique}"`); // set the unique id for each content
      htmlContent = htmlContent.replace('id="placeholder"', `id="placeholder${unique}"`); // set the unique id for each content

      // Create a containerContent element and set its innerHTML
      containerContent = document.getElementById('main');
      containerContent.innerHTML += htmlContent;

      // add AI analysis for chartId = 8
      if (chartId === 8 && y_value && x_value) {
        console.log(chartId);
        let inputString = `Please perform data analysis on the following data: I have '${x_value}' each with respective totals of '${y_value}' Key 1 corresponds to Key 1. Kindly provide your analysis and insights in one paragraph. and in bahasa Indonesia and start dengan kalimat =  Data menunjukkan bahwa.....`
        console.log(inputString);
        
        // Use unique identifier to select elements
        let aiAnalysisElement = `#aiAnalysis${unique}`;
        let placeholderElement = `#placeholder${unique}`;

        $(document).ready(function() {
          $.ajax({
            type: 'POST',
            url: 'http://localhost:3000/ask',
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
            data: JSON.stringify({
              prompt: inputString
            }),
            success: function (response) {
              const result = response.message;
              console.log("analysis result : " + result)

              // Set the result in the HTML element
              $(aiAnalysisElement).text(result);

              // Empty the placeholder content
              $(placeholderElement).empty();
            },
            error: function (error) {
              console.error(error);
              $(aiAnalysisElement).text("API Error");
              $(placeholderElement).empty();
            }
          });
        });
      } else {
        $(`#aiAnalysis${unique}`).text("NO DATA");
        $(`#placeholder${unique}`).empty();
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

{{--   $.ajax({ // ini api AI analyst using RobotMatic.AI not GPT
            url: 'https://robomatic-ai.p.rapidapi.com/api',
            method: 'POST',
            headers: {
                'content-type': 'application/x-www-form-urlencoded',
                'X-RapidAPI-Key': '346543f61cmshefda0a20bd76340p19f426jsn816f3d62e933',
                'X-RapidAPI-Host': 'robomatic-ai.p.rapidapi.com'
            },
            data: {
                in: `  Whats 19 plus 23 `, // request input hanya bisa simple math, belum bisa aneh2. like --> Please perform data analysis on the following dataset: I have three categories - 'Islam,' 'Kristen,' and 'Buddha,' each with respective totals of '800,' '200,' and '150.' Key 1 corresponds to Key 1. Kindly provide your analysis and insights in one paragraph.
                op: 'in',
                cbot: '1',
                SessionID: 'RapidAPI1',
                cbid: '1',
                key: 'RHMN5hnQ4wTYZBGCF3dfxzypt68rVP',
                ChatSource: 'RapidAPI',
                duration: '1'
            }, --}}