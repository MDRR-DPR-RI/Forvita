@extends('dashboard.layouts.share')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
<style>
  .iconpicker-dropdown ul{
    width: 500px;
    top: 80px !important;
  }
</style>
<script type="module" src="https://public.tableau.com/javascripts/api/tableau.embedding.3.latest.min.js"></script>
<link rel="stylesheet" href="/lib/jqvmap/jqvmap.min.css">
<link href="/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <div class="container mt-3 p-3 p-lg-4">
        <div class="d-md-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="main-title mb-0">Dashboard {{ $item->dashboard->name }}</h4>
            </div>
            <div class="d-flex gap-2 mt-3 mt-md-0">
                  <button class="btn btn-white d-flex align-items-center gap-2" id="capture"><i class="bi bi-download fs-18 lh-1"></i>PNG</button>
            </div>
        </div>
        <div class="col-xl-12">
          <p class="mb-5">{{ $item->dashboard->description }}
          </p>
        </div>
        <div class="row g-3" id="main">
            {{-- CHART CONTENT WILL GOES HERE --}}
        </div><!-- row -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. DPR RI</span>
        </div><!-- main-footer -->
    </div><!-- main -->

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
    htmlContent = htmlContent.replace('href="#modal_card_zoom"', `href="#modal_card_zoom${contentId}"`); // set the unique id for each content
    

    // Create a containerContent element and set its innerHTML
    containerContent = document.getElementById('main');
    containerContent.innerHTML += htmlContent;
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

      html2canvas(content, { scale: 2, logging: true }).then(function (canvas) {
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

<script src="/lib/apexcharts/apexcharts.min.js"></script>
<script src="/js/db.data.js"></script>
<script src="/js/main/possible-map-input.js"></script>
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




@endsection


