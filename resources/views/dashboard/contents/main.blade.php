@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
<script type="module" src="https://public.tableau.com/javascripts/api/tableau.embedding.3.latest.min.js"></script>
<link rel="stylesheet" href="/lib/jqvmap/jqvmap.min.css">
<link href="/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <div class="main main-app p-3 p-lg-4">
      {{-- <div class="container-fluid">
            <tableau-viz class="mt-3 mb-3" id="tableauViz"></tableau-viz>
        </div> --}}
        <div class="d-md-flex align-items-center justify-content-between mb-4">
            <div>
                <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item"><a href="/cluster">{{ session('cluster_name') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $dashboard->name }}</li>
                </ol>
                <h4 class="main-title mb-0">Dashboard {{ $dashboard->name }}
                @can('admin')
                  <a href="#edit_dashboard_name" data-bs-toggle="modal">
                      <i class="ri-pencil-line text-dark"></i>
                  </a>
                @endcan
                </h4>
            </div>
                
            <div class="d-flex gap-2 mt-3 mt-md-0">
              @can('admin')
                  <a href="{{ route('csv') }}" class="btn btn-primary d-flex align-items-center gap-2">
                        <i class="ri-file-excel-2-line fs-18 lh-1"></i>Import CSV
                  </a>
                  <a href="#importAPIModal" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal">
                        <i class="ri-file-excel-2-line fs-18 lh-1"></i>Import RESTful API
                  </a>
                  <button type="button" class="btn btn-white d-flex align-items-center gap-2"><i class="ri-share-line fs-18 lh-1"></i>Share</button>
                  <button class="btn btn-white d-flex align-items-center gap-2" id="capture"><i class="ri-printer-line fs-18 lh-1"></i>Print</button>
                  <a href="#modal3" class="btn btn-primary d-flex align-items-center gap-2"  data-bs-toggle="modal"><i class="ri-bar-chart-2-line fs-18 lh-1"></i>Customize<span class="d-none d-sm-inline"> Dashboard</span></a>
              @endcan
            </div>
        </div>
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
        <div class="col-xl-12">
          <p class="mb-5">{{ $dashboard->description }}
          @can('admin')
            <a href="#edit_dashboard_name" data-bs-toggle="modal">
              <i class="ri-pencil-line text-dark"></i>
            </a>
          @endcan
          </p>
        </div>
        <div class="row g-3" id="main">
          {{-- <div id="indonesia-map" class="ht-300"></div> --}}
            {{-- CHART CONTENT WILL GOES HERE --}}
        </div><!-- row -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. DPR RI</span>
            @can('admin')
              <a href="#delete_dashboard" class="btn btn-danger" data-bs-toggle="modal">Hapus Dashboard</a>
            @endcan
        </div><!-- main-footer -->
    </div><!-- main -->

    {{-- Modal Customize Dashboard for all--}}
    <div class="modal fade" id="modal3" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Customize Dashboard {{ $dashboard->name }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><!-- modal-header -->
          <div class="modal-body container ">
            <div class="row">
              <div class="col-xl-5">
                <div class="text-center">
                  Pilihan Konten
                </div>
                <table class="table" id="tablePilihKontent">
                  <thead>
                    <tr>
                      <th scope="col">Cluster ID</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($charts as $chart)
                        <tr>
                          <td scope="row">{{ $loop->iteration }}</td>
                          <td ">{{ $chart->name }}</td>
                          {{-- Add new card --}}
                          <td>
                            @if ($chart->id != 1)
                              <form action="/dashboard/content" method="post">
                                @csrf
                                <input type="hidden" value="{{ $chart->id }}" name="chart_id">
                                <input type="hidden" name="dashboard_id" value="{{ $dashboard->id }}" >
                                <input type="hidden" name="card_grid" value="{{ $chart->grid }}" >
                                <button type="submit" class="btn btn-primary">Tambah</button>
                              </form>
                              @else
                                <a href="#modalEmbedTab" class="btn btn-primary" data-bs-toggle="modal">Tambah</a>
                              @endif
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="col">
                <div class="text-center">
                  Dashboard Kontent
                </div>
                <table class="table" id="tableContent">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Cluster ID</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Grid</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($contents as $content)
                        <tr>
                          <td scope="row">{{ $loop->iteration }}</td>
                          <td>{{ $content->chart->id }}</td>
                          <td>{{ $content->chart->name }}</td>
                          <td>{{ $content->card_grid }}</td>
                          <td>
                            <div class="d-flex justify-content-center align-items-center">
                              {{-- Edit cards --}}
                              @if ($content->chart->id != 1)
                                <a href="/dashboard/content/{{ $content->id }}" class="btn btn-primary">Edit</a>
                              @endif
                              
                              {{-- Delete cards --}}
                              <form action="/dashboard/content/{{ $content->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">Hapus</button>
                              </form>
                            </div>
                          </td>
                        </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
        
          </div> <!-- modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          </div><!-- modal-footer -->
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal-fade -->

    @can('admin')
      {{-- MODAL EDIT DASHBOARD NAME & DESCRIPTION --}}
      <div class="modal fade" id="edit_dashboard_name" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Ubah Nama Dashboard</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/dashboard/{{ $dashboard->id }}" method="post">
              @method('put')
              @csrf
              <div class="modal-body text-center">
                  <label>Masukan Nama Dashboard:</label>
                  <input type="text" class="form-control" name="dashboard_name" placeholder="Nama Dashboard" value="{{ $dashboard->name }}" autofocus required>
                  <label>Masukan Deskripsi Dashboard:</label>
                  <textarea class="form-control" name="dashboard_description" rows="3" placeholder="Deskripsi dashboard..." required>{{ $dashboard->description }}</textarea>
                  <label>Pilih Icon:</label>
                  <input type="text" class="form-control iconpicker" value="{{ $dashboard->icon_name }}" name="icon" placeholder="Icon Picker" aria-label="Icone Picker" aria-describedby="basic-addon1" />
                </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Ubah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endcan

    {{-- MODAL EMBED TABLEAU --}}
    <div class="modal fade" id="modalEmbedTab" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Embed Tableau</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/dashboard/content" method="POST">
                        @csrf
                        <div class="mb-3">
                          Contoh url
                            <ol class="list-group">
                              <li class="list-group-item">https://public.tableau.com/views/ThePeriodicTableofWine/periodictableauofwineEN?:language=en-US&:display_count=n&:origin=viz_share_link</li>
                              <li class="list-group-item">https://public.tableau.com/views/SolarEnergyDashboardRWFD_16900452395200/SolarEnergyDashboard?:language=en-US&:display_count=n&:origin=viz_share_link</li>
                            </ol>
                        </div>
                        <div class="modal-body text-center">
                          <div class="d-flex justify-content-center">
                            <div class="col-2">
                              <label for="card_grid" class="form-label">Panjang Konten</label>
                              <select id="card_grid" name="card_grid" class="form-select">
                                @for ($a = 1; $a <= 12; $a++)
                                  <option selected>{{ $a }}</option>
                                @endfor
                              </select>
                            </div>
                          </div>
                          <br>       
                          <label>Masukan Tableau url:</label>
                          <input type="hidden" name="dashboard_id" value="{{ $dashboard->id }}" >
                          <input type="text" class="form-control" name="tableau_link" placeholder="http:///public.tableau.com/...=viz_share_link" value="{{ $dashboard->card_description }}" autofocus required>
                        </div>
                        <div class="container">
                          <div class="row justify-content-end">
                            <div class="col-auto">
                              <button type="submit" class="btn btn-primary">Embed</button>
                            </div>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
      
    {{-- Modal Edit PROMPT--}}
    <div class="modal fade" id="modalprompt" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Prompt</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><!-- modal-header -->
          <form id="contentForm" action="/dashboard/content/" method="post">
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
              <input type="hidden" name="dashboard_id" value="{{ $dashboard->id }}" >

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
          </form>
          </div><!-- modal-footer -->
        </div><!-- modal-content -->
      </div><!-- modal-content -->
    </div><!-- modal-fade -->

    {{-- Modal untuk Impor CSV --}}
    <div class="modal fade" id="importCSVModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import CSV File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="tableName" class="form-label">Table Name</label>
                            <input class="form-control" type="text" id="tableName" name="tableName" required>
                        </div>
                        <div class="mb-3">
                            <label for="csvFile" class="form-label">Choose CSV File</label>
                            <input class="form-control" type="file" id="csvFile" name="csvFile" accept=".csv" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Import CSV</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal untuk Impor From RESTful API --}}
    <div class="modal fade" id="importAPIModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import from RESTful API</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import.api') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          Example url
                            <ol class="list-group list-group-numbered">
                              <li class="list-group-item">https://catfact.ninja/fact</li>
                              <li class="list-group-item">https://www.dpr.go.id/rest/?method=getAgendaPerBulan&tahun=2015&bulan=02&tipe=json</li>
                            </ol>
                            <label for="tableName" class="form-label">Table Name</label>
                            <input class="form-control" type="text" id="tableName" name="tableName" required>
                        </div>
                        <div class="mb-3">
                            <label for="api_url" class="form-label">Enter URL</label>
                            <input class="form-control" type="text" id="api_url" name="api_url" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @can('admin')
        {{-- Modal delete dashboard --}}
        <div class="modal" id="delete_dashboard" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Hapus Dashboard {{ $dashboard->name }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Apakah kamu ingin menghapus dashboard {{ $dashboard->name }}?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <form action="/dashboard/{{ $dashboard->id }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">Hapus</button>
              </form>
            </div>
          </div>
        </div>
        </div>
    @endcan

@endsection


@section('custom_script')

{{-- include all assets (html-structures) --}}
<script src="/js/main/html-structures.js"></script>

{{-- script to save into page into an image --}}
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>


{{-- script to print content in the dashboard --}}
 <script>
  // Declare variables outside the loop
  let contentId, chartId, htmlContent, containerContent, unique, y_value, x_value, prompt, result_prompt, content_grid;
  @foreach ($contents as $content)
    // Access the HTML structure based on the PHP value
    contentId = {{ $content->id }}
    unique = 'content' + {{ $content->id }}; // set unique value for each content
    chartId = {{ $content->chart->id }};
    y_value = {!! json_encode($content->y_value) !!}
    x_value = {!! json_encode($content->x_value) !!}
    prompt = "{!! $content->prompt->body !!}"
    result_prompt = "{{ $content->result_prompt }}"
    content_grid = {{ $content->card_grid }}

    htmlContent = htmlStructures[chartId][0];

    htmlContent = htmlContent.replace('id="content"', `id="${unique}"`); // set the unique id for each content
    htmlContent = htmlContent.replace('id="judul"', `id="judul${unique}"`); // set the unique id for each judul content
    htmlContent = htmlContent.replace('id="description"', `id="description${unique}"`); // set the unique id for each description content
    htmlContent = htmlContent.replace('id="aiAnalysis"', `id="aiAnalysis${unique}"`); // set the unique id for aiAnalysis
    htmlContent = htmlContent.replace('id="placeholder"', `id="placeholder${unique}"`); // set the unique id for placeholder
    htmlContent = htmlContent.replace('data-content-id="id"', `data-content-id="${contentId}"`); // set the data-content-id with its id to send into a modal
    htmlContent = htmlContent.replace('class="col-xl-"', `class="col-xl-${content_grid}"`); 
    

    // Create a containerContent element and set its innerHTML
    containerContent = document.getElementById('main');
    containerContent.innerHTML += htmlContent;

    // add AI analysis for chartId = 8
    if (chartId === 8 && y_value && x_value) {
      // Use unique identifier to select elements
      const aiAnalysisElement = `#aiAnalysis${unique}`;
      const placeholderElement = `#placeholder${unique}`;
      if (!result_prompt) { // if there is no result_prompt in the content so do ajax call to do the analysis then asign the result prompt to the content(table in db)
        let inputString = `Please perform data analysis based on ${prompt} on the following data: I have '${x_value}' each with respective totals of '${y_value}' Key 1 corresponds to Key 1. Kindly provide your analysis and insights in one paragraph. and in bahasa Indonesia and start dengan kalimat =  Data menunjukkan bahwa.....`
        console.log(`prompt to api: ${inputString}` );

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

              // store the result prompt into the db (table "contents")
              $.ajax({
                url: `/dashboard/content/${contentId}`, // Include the content ID
                method: 'put', // Use POST
                data: {
                  result: result // Your data to update
                },
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log("success to update the result_prompt");
                },
                error: function (error) {
                  console.error(error);
                  console.error("woy error when try to access the resource api");
                }
              });
            },
            error: function (error) {
              console.error(error);
              $(aiAnalysisElement).text("API Error");
              $(placeholderElement).empty();
            }
          });
        });
      } else { // if there is a result then no need to do ajax call, just show the result_prompt
        $(aiAnalysisElement).text(result_prompt);
        $(placeholderElement).empty();
      }
    } else {
      $(`#aiAnalysis${unique}`).text("NO DATA");
      $(`#placeholder${unique}`).empty();
    }
  @endforeach
  $(document).ready(function () {
    $('a[data-bs-toggle="modal"]').on('click', function () {

      // Update the form action attribute with the content ID
      var formAction = '/dashboard/content/' + contentId;
      $('#contentForm').attr('action', formAction);
    });
  });

</script>

{{-- script for save dashboard content into an image  --}}
<script>
  document.getElementById('capture').addEventListener('click', function () {
    const content = document.getElementById('main');
    html2canvas(content).then(function (canvas) {
        // Convert the canvas to an image
        const image = new Image();
        image.src = canvas.toDataURL('image/png');
        const dynamicFilename = '{{ $dashboard->name }}'; // dashboard name to save as filename

        // Create an anchor element to trigger the download
        const link = document.createElement('a');
        link.href = image.src;
        link.download = dynamicFilename + '-captured_image.png'; // Set the filename for the download

        // Trigger a click on the anchor element to initiate the download
        link.click();
    });
  });
</script>

<script src="/lib/apexcharts/apexcharts.min.js"></script>
<script src="/js/db.data.js"></script>
<script src="/js/main/contents-config.js"></script>

{{-- TABLEAU EMBED --}}
<script>
  let tableauViz, tableau_link, chart_id;
  @foreach ($contents as $content)
  chart_id = {{ $content->chart_id }}
  if (chart_id == 1) {
    tableauViz = document.getElementById(`tableauViz{{ $content->id }}`);
    tableau_link = '{{ $content->card_description }}';

    console.log(tableau_link);

    tableauViz.src = tableau_link;
  }
  @endforeach
</script>

{{-- TABLE CUSTOMIZE DASHBOARD CONFIG --}}
<script src="/lib/gridjs-jquery/gridjs.production.min.js"></script>
<script>

$("#tablePilihKontent").Grid({
  className: {
    table: 'table table-hover'
  },
  pagination: true,
  search: true,
  sort: true,
  resizable: true
});

$("#tableContent").Grid({
  className: {
    table: 'table table-hover'
  },
  pagination: true,
  search: true,
  sort: true,
  resizable: true
});

</script>



<script src="/lib/jqvmap/jquery.vmap.min.js"></script>
<script src="/lib/jqvmap/maps/jquery.vmap.indonesia.js"></script>
<script src="/lib/jqvmap/maps/jquery.vmap.world.js"></script>

<script src="/js/vmap.sampledata.js"></script>

<script>
$('#indonesia-map').vectorMap({
    map: 'indonesia_id',
    backgroundColor: 'transparent',
    borderColor: '#000',
    borderOpacity: 0.75,
    borderWidth: 1,
    color: '#4a4949',
    enableZoom: true,
    hoverColor: '#00F',
    hoverOpacity: 0.7,
    selectedColor: '#00F',
    selectedRegion: 'ID', // You can specify the region you want to highlight initially
    // showTooltip: true,
    scaleColors: ['#C8EEFF', '#006491'],
    onRegionClick: function (event, code, region) {
        // Add your custom click event handling here if needed
        alert('You clicked on ' + region);
    },
    onRegionOver: function (event, code, region) {
        console.log(code);
        if (code === 'path11') {
            // This is DKI Jakarta, so you can add your custom code to display population
            var population = 10000000; // Replace with the actual population of DKI Jakarta
            // $('#indonesia-map').vectorMap('set', 'colors', { 'path11': '#FF0000' });
            console.log(population);
            // $('#indonesia-map').vectorMap('tip', '<strong>DKI Jakarta</strong><br>Population: ' + population);
        }
    },
    onRegionOut: function (event, code, region) {
        // if (code === 'path11') {
        //     // Restore the default color and tooltip
        //     $('#indonesia-map').vectorMap('set', 'colors', { 'path11': '#4a4949' });
        //     $('#indonesia-map').vectorMap('tip', '');
        // }
    }
});
</script>

@endsection


