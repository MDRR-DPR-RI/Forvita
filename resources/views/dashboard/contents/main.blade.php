@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
<style>
  .iconpicker-dropdown ul{
    width: 500px;
    top: 80px !important;
  }

  .required-field::after {
    content: "*" !important;
    color: red !important;
}
</style>
<script type="module" src="https://public.tableau.com/javascripts/api/tableau.embedding.3.latest.min.js"></script>
<link rel="stylesheet" href="/lib/jqvmap/jqvmap.min.css">
<link href="/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <div class="main main-app p-3 p-lg-4">
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
                  <a href="#modalShare" class="btn btn-white d-flex align-items-center gap-2" data-bs-toggle="modal"><i class="ri-global-line fs-18 lh-1"></i>Publik</a>
                  <button class="btn btn-white d-flex align-items-center gap-2" id="capture"><i class="bi bi-download fs-18 lh-1"></i>PNG</button>
                  <a href="#modal3" class="btn btn-primary d-flex align-items-center gap-2"  data-bs-toggle="modal"><i class="ri-bar-chart-2-line fs-18 lh-1"></i>Kustomisasi Dashboard</span></a>
              @endcan
            </div>
            @can('admin')
            <!-- Modal Share -->
            <div class="modal" id="modalShare" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Publik Dashboard {{ $dashboard->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/share" method="post">
                  @csrf
                    <div class="modal-body">
                        <div class="required-field">Expired Publik Dashboard</div>
                        <input class="flatpickr flatpickr-input form-control active" name="expired" type="text" placeholder="Pilih tanggal dan jam" data-id="datetime" readonly="readonly">                  
                    </div>
                    <div class="m-3">
                      <p >Apakah anda ingin membuat dashboard ini publik?
                      </p>
                      <i class="text-secondary">Orang lain akan bisa melihat dashboard ini tanpa login</i>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <input type="hidden" name="dashboard_id" value="{{ $dashboard->id }}">
                        <button type="submit" class="btn btn-primary">Publik</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            @endcan
    
          </div>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              {{-- <li>{{ $error }}</li> --}}
              <li>Mohon Masukkan Tanggal Expired Dashboard</li>
              @endforeach
            </ul>
          </div>
        @endif
        @if (session('status'))
          <div class="alert alert-primary mb-3">
              {{ session('status') }}
          </div>
        @endif
        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @elseif (session()->has('deleted'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terhapus!</strong> {{ session('deleted') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @elseif (session()->has('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
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
            {{-- CHART CONTENT WILL GOES HERE --}}
        </div><!-- row -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. DPR RI</span>
            @can('user')
              <a href="#delete_dashboard" class="btn btn-danger" data-bs-toggle="modal">Hapus Dashboard</a>
            @endcan
        </div><!-- main-footer -->
    </div><!-- main -->

    {{-- Modal Customize Dashboard for all--}}
    <div class="modal fade" id="modal3" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Kustomisasi Dashboard {{ $dashboard->name }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><!-- modal-header -->
          <div class="modal-body container ">
            <div class="row">
              <div class="col-xl-6">
                <div class="text-center">
                  Pilihan Konten
                </div>
                {{-- TODO MAKE THE UI PERFECT FOR THIS OPTION SELECT --}}
            
                <div class="mt-2">
                  <select class="form-select" id="customLimitSelector">
                    <option value="7">6</option>
                    <option value="12">10</option>
                    <option value="18">15</option>
                    <option value="25">20</option>
                    <!-- Add more options as needed -->
                  </select>
                </div>
                <table class="table" id="tablePilihKontent">
                  <thead>
                    <tr>
                      <th scope="col">Kartu ID</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($charts as $chart)
                    @if ($loop->iteration == 1)
                        <tr>
                          <td>
                            <div class="text-center">
                              Line Chart
                            </div>
                          </td>
                        </tr>
                    @elseif ($loop->iteration == 7)
                        <tr>
                          <td>
                            <div class="text-center">
                              Bar Chart
                            </div>
                          </td>
                        </tr>
                    @elseif ($loop->iteration == 13)
                        <tr>
                          <td>
                            <div class="text-center">
                              Column Chart
                            </div>
                          </td>
                        </tr>
                    @elseif ($loop->iteration == 16)
                        <tr>
                          <td>
                            <div class="text-center">
                              Donut & Pie Chart
                            </div>
                          </td>
                        </tr>
                        @elseif ($loop->iteration == 18)
                        <tr>
                          <td>
                            <div class="text-center">
                              Pilihan Lain
                            </div>
                          </td>
                        </tr>
                    @endif
                        <tr>
                          <td>{{ $chart->id }}</td>
                          <td ">{{ $chart->name }}</td>
                          <td>
                            @if ($chart->id != 18)
                              <form action="/dashboard/content" method="post">
                                @csrf
                                <input type="hidden" value="{{ $chart->id }}" name="chart_id">
                                <input type="hidden" name="dashboard_id" value="{{ $dashboard->id }}" >
                                <input type="hidden" name="card_grid" value="{{ $chart->grid }}" >
                                <button type="submit" class="btn btn-primary btn-icon mx-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Ke Dashboard"><i class="bi bi-plus-lg"></i></button>
                              </form>
                              @else
                                <a href="#modalEmbedTab" class="btn btn-primary" data-bs-toggle="modal"><i class="bi bi-plus-lg" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Ke Dashboard"></i></a>
                              @endif
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="col">
                <div class="text-center">
                  Dashboard Konten
                </div>
                <table class="table" id="tableContent">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Kartu ID</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Panjang</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($contents as $content)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $content->chart->id }}</td>
                          <td>{{ $content->chart->name }}</td>
                          <td>{{ $content->card_grid }}</td>
                          <td>
                            <div class="d-flex justify-content-center align-items-center">
                              {{-- Edit cards --}}
                              @if ($content->chart->id != 18)
                                <a href="/dashboard/content/{{ $content->id }}" class="btn btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah">
                                  <i class="ri-pencil-fill"></i>
                                </a>
                              @endif
                              
                              {{-- Delete cards --}}
                              <form action="/dashboard/content/{{ $content->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-icon mx-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                  <i class="bi bi-trash3"></i>
                                </button>
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
                  <label>Icon:</label>
                  <div class="input-group mb-3">
                    <label class="input-group-text iconOutput-edit" id="iconOutput-edit" for="iconInput-edit"><i class="{{ $dashboard->icon_name }}"></i></label>
                    <input type="text" class="iconInput-edit form-control iconpicker-edit" value="{{ $dashboard->icon_name }}" name="icon" placeholder="Icon Picker" aria-label="Icone Picker" aria-describedby="basic-addon1" />
                  </div>
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
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="mb-3">
                                Contoh url
                                  <ol class="list-group">
                                    <li class="list-group-item">https://public.tableau.com/views/ThePeriodicTableofWine/periodictableauofwineEN?:language=en-US&:display_count=n&:origin=viz_share_link</li>
                                    <li class="list-group-item">https://public.tableau.com/views/SolarEnergyDashboardRWFD_16900452395200/SolarEnergyDashboard?:language=en-US&:display_count=n&:origin=viz_share_link</li>
                                  </ol>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6 mb-3">
                              <label for="card_grid">Panjang Konten</label>
                              <select id="card_grid" name="card_grid" class="form-select">
                                @for ($a = 1; $a <= 12; $a++)
                                  <option selected>{{ $a }}</option>
                                @endfor
                              </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                              <label for="username_tableau">Username Tableau</label>
                              <input type="text" class="form-control" name="username_tableau" placeholder="Masukkan jika menggunakan tableau private">
                            </div>
                            <div class="col-lg-6 mb-3">
                              <label for="">URL Tableau Domain</label>
                              <input type="text" class="form-control" name="domain_tableau" placeholder="https://visualisasi.dpr.go.id" value="" autofocus required>
                            </div>
                            <div class="col-lg-6 mb-3">
                              <label>URL Tableau View</label>
                              <input type="hidden" name="dashboard_id" value="{{ $dashboard->id }}" >
                              <input type="text" class="form-control" name="tableau_link" placeholder="views/ThePeriodicTableofWine/periodictableauofwineEN?:language=en-US&:display_count=n&:origin=viz_share_link" value="{{ $dashboard->card_description }}" autofocus required>
                            </div>
                          </div>
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

    @can('user')
        {{-- Modal delete dashboard --}}
        <div class="modal" id="delete_dashboard" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Hapus Dashboard {{ $dashboard->name }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Apakah anda ingin menghapus dashboard {{ $dashboard->name }}?</p>
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

    {{-- Modal ZOOM CARDS --}}
    @foreach ($contents as $content)
      <div class="modal" id="modal_card_zoom{{ $content->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="title_card_zoom{{ $content->id }}"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body " >
              <div id="desc_card_zoom{{ $content->id }}"></div>
              @if ($content->chart->id == 19  )
              {{-- NOTE: THIS IS NOT RESPOONSIVE TO THE MOBILE VIEW. BECAUSE NOT USING BOOTSTRAP CLASS/STYLE.  --}}
                <div class="mx-2" style="width: 1150px; height: 700px;" id="card_content_zoom{{ $content->id }}"></div>
              @elseif($content->chart->id == 25)
              {{-- NOTE: THIS IS NOT RESPOONSIVE TO THE MOBILE VIEW. BECAUSE NOT USING BOOTSTRAP CLASS/STYLE.  --}}
                <div class="mx-5" style="width: 1000px; height: 800px;" id="card_content_zoom{{ $content->id }}"></div>
              @else
                <div id="card_content_zoom{{ $content->id }}"></div>
              @endif
            </div>
            <div class="modal-footer">
            <div id="custom-tooltip" data-toggle="tooltip" data-placement="bottom" title="Your Tooltip Content"></div>
              {{-- IMPORTANT: TOOLTIP IN MODAL GABISA. TURU BGT --}}
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    @endforeach

@endsection


@section('custom_script')

{{-- include all assets (html-structures) --}}
<script src="/js/main/html-structures.js"></script>

<script src="/lib/datetime/flatpickr.js"></script>

{{-- script to save into page into an image --}}
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

@push('addon-script')

<script>
  $(".flatpickr").flatpickr(
    {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    minDate: "today",
}
  );
</script>

<script>

(async () => {
    const response = await fetch('https://unpkg.com/codethereal-iconpicker@1.2.1/dist/iconsets/bootstrap5.json')
    const result = await response.json()

    const iconpicker = new Iconpicker(document.querySelector(".iconpicker-edit"), {
        icons: result,
        showSelectedIn: document.querySelector(".selected-icon"),
        searchable: true,
        selectedClass: "selected",
        containerClass: "my-picker",
        hideOnSelect: true,
        fade: true,
        defaultValue: 'bi-alarm',
        valueFormat: val => `bi ${val}`
    });

    iconpicker.set() // Set as empty
    iconpicker.set('{{ $dashboard->icon_name }}') // Reset with a value

    var iconValue = $('#iconInput-edit').value;
    // var iconValue = $(this).val();

    $(".iconpicker-dropdown").on("click", function() {
      var iconValue = $(".iconInput-edit").val();
      // $(".iconOutput-edit").html(`<i class="${$(".iconInput-edit").val()}" ></i>`)
      $("#iconOutput-edit").html(`<i class="${iconValue}" ></i>`);
    });
})()
  
</script>
@endpush

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
    htmlContent = htmlContent.replace('data-content-id="id"', `data-content-id="${contentId}"`); // set the data-content-id with its id to send into a modal
    htmlContent = htmlContent.replace('class="col-xl-"', `class="col-xl-${content_grid}"`); 
    htmlContent = htmlContent.replace('href="#modal_card_zoom"', `href="#modal_card_zoom${contentId}"`); // set the unique id for each content

    // Create a containerContent element and set its innerHTML
    containerContent = document.getElementById('main');
    containerContent.innerHTML += htmlContent;
  @endforeach
</script>

{{-- script for save dashboard content into an image  --}}
<script>
  document.getElementById('capture').addEventListener('click', function () {
      const content = document.getElementById('main');

      html2canvas(content, { scale: 5, logging: true }).then(function (canvas) {
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

<script src="/lib/jqvmap/jquery.vmap.min.js"></script>
<script src="/lib/jqvmap/maps/jquery.vmap.indonesia.js"></script>
<script src="/lib/jqvmap/maps/jquery.vmap.world.js"></script>
<script src="/js/main/possible-map-input.js"></script>

<script src="/lib/apexcharts/apexcharts.min.js"></script>
<script src="/js/db.data.js"></script>
<script src="/js/main/contents-config.js"></script>

{{-- TABLEAU EMBED --}}
<script>
    
  let tableauViz, tableau_domain, tableau_link, chart_id, tableau_embed, username;
  @foreach ($contents as $content)
  chart_id = {{ $content->chart_id }}
  // username = {{ $content->username }}
  if (chart_id == 18) {
    tableauViz = document.getElementById(`tableauViz{{ $content->id }}`);
    tableau_domain = '{{ $content->domain_tableau }}';
    tableau_link = '{{ $content->card_description }}';
  
    if ('{{ $content->username_tableau  !== null}}') {
        tableau_embed = '{{ $content->domain_tableau }}/trusted/{{ $content->ticket }}/{{ $content->card_description }}';
    } else {
        tableau_embed = '{{ $content->domain_tableau }}/{{ $content->card_description }}';
    }
    tableauViz.src = tableau_embed;
  }
  @endforeach
</script>

{{-- TABLE CUSTOMIZE DASHBOARD CONFIG --}}
<script>

var gridInstance =  $("#tablePilihKontent").Grid({
  className: {
    table: 'table table-hover'
  },
 pagination: {
    limit:7,
    summary: false,
  },
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

var table = document.getElementById('tablePilihKontent');

    $("#customLimitSelector").on('change', function() {
    // Get the configuration object of the existing Grid.js instance
    var gridElement = gridInstance.config;

    // Generate a new ID for the container element of the existing Grid.js instance
    var newGridId = new Date().getTime();
    gridElement.container.id = newGridId;

    // Get the selected limit from the dropdown
    var selectedLimit = parseInt($(this).val());

    // Generate a new ID for the table element
    var newId = 'tablePilihKontent_' + new Date().getTime();

    // Set the new ID to the existing table element
    table.id = newId;

    // Remove the existing Grid.js instance's container element
    $("#" + newGridId).remove();

    // Reinitialize the Grid.js instance with the new table ID and limit
    gridInstance = $("#" + newId).Grid({
      className: {
        table: 'table table-hover'
      },
      pagination: {
        limit: selectedLimit, // New limit
        summary: false,
      },
      search: true,
      sort: true,
      resizable: true
    });

  });

</script>


@endsection


