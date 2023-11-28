@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
    <link href="/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="main main-app p-3 p-lg-4">
  @if (session()->has('deleted'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Terhapus!</strong> {{ session('deleted') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
  <div class="container mt-5 mb-5">
    <div>
      <ol class="breadcrumb fs-sm mb-0">
        <li class="breadcrumb-item"><p>{{ $dashboard->name }}</p></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $content->chart->name }}</li>
      </ol> 
      <h4 class="main-title mb-0">Pilih Judul Untuk Kartu {{ $content->chart->name }}</h4>
    </div> <hr>
      <div class=" text-center d-flex align-items-start flex-column">
        @if (in_array($content->chart->id, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15])) {{-- list of chart that can have more than 1 stack  --}}
          <div>Banyak Judul</div>
          <select class="form-select" name="selectOption" id="selectOption">
            @for ($index = 1; $index <= 10; $index++)
              @if (count(json_decode($content->judul)) == $index)
                <option value="{{ $index }}" selected>{{ $index }}</option>
              @else
                <option value="{{ $index }}">{{ $index }}</option>
              @endif
            @endfor
          </select>
        @else
          <select class="form-select" name="selectOption" id="selectOption" disabled>
            <option value="1">1</option>
          </select>
        @endif
      </div><br>
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0"> <!-- search feature for tabl not use this first cause still have a bug in checkbox -->
        {{-- <table class="table table-hover" width="100%" cellspacing="0"> --}}
          <thead>
            <tr>
              <th scope="col">Pilih</th>
              <th scope="col">Kelompok</th>
              <th scope="col">Data</th>
              <th scope="col">Judul</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cleans as $clean)
              {{-- @php
                $contentArray = json_decode('["Jumlah penganut Agama Anggota","Jumlah "]');
              @endphp --}}
              <tr>
                <td>
                @if ($content->judul == '[""]')
                    <input class="select-judul" type="checkbox" name="judul" id="{{ $clean->judul }}" value="{{ $clean->judul }}">
                @else 
                  @if (in_array($clean->judul, json_decode($content->judul)))
                    <input class="select-judul" type="checkbox" name="judul" id="{{ $clean->judul }}" value="{{ $clean->judul }}" checked>
                  @else 
                    <input class="select-judul" type="checkbox" name="judul" id="{{ $clean->judul }}" value="{{ $clean->judul }} "disabled>
                  @endif 
                @endif
                </td>
                <td>{{ $clean->kelompok }}</td>
                <td>{{ $clean->data }}</td>
                <td>{{ $clean->judul }}</td>
                <td>
                    <a href="#delete_cleans" class="modalDelete btn btn-danger" data-bs-toggle="modal"
                      data-data_judul="{{ $clean->judul }}"
                      >
                      <i class="bi bi-trash3" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"></i>
                    </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div><!-- table-responsive -->
    <br>
    <input type="hidden" value="{{ $content->id }}" id="contentId">
    <form action="/dashboard/content/{{ $content->id }}" method="get">
      @csrf
      <div class="col d-flex justify-content-end">
        <input type="hidden" name="selected_judul" id="selected_judul" value="{{implode(',', json_decode($content->judul)) }}">
        @if ($content->judul != '[""]')
          <button class="btn btn-primary" id="selectBtn">Selanjutnya</button>
        @else
          <button class="btn btn-secondary" id="selectBtn" disabled>Selanjutnya</button>
        @endif
      </div>
    </form>
  </div>
</div><!-- main-app -->

@can('admin')
        {{-- Modal delete dashboard --}}
        <div class="modal" id="delete_cleans" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id=""></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p id="message-body"></p>
              <i class="text-secondary"></i>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <form action="/remove/cleans" method="post">
                @method('delete')
                @csrf
                <input type="hidden" id="judul_data" name="judul_data">
                <button type="submit" class="btn btn-danger">Hapus</button>
              </form>
            </div>
          </div>
        </div>
        </div>
    @endcan

@endsection

@section('custom_script')
  <script>
    $(document).ready(function() {
      const selectBtn = document.getElementById('selectBtn');

      // Initialize the maximum selection to 1
      var maxSelection = document.getElementById('selectOption').value;
      

      // Get all elements with the class 'select-judul' and store them in an array
      var checkboxes = document.querySelectorAll('.select-judul');

      // Initialize an array to store the selected checkboxes
      var selectedCheckboxes = {!! $content->judul !!};
      if (selectedCheckboxes[0] == '') {
        selectedCheckboxes.splice(0, 1); // Remove 1 element at the specified index
      }
      
      // Add an event listener to the 'selectOption' element for the 'change' event
      document.getElementById('selectOption').addEventListener('change', function() {

        if (maxSelection > this.value) {
            selectedCheckboxes = [];
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false; // Uncheck all checkboxes
                checkbox.disabled = false; // Enable all checkboxes
            });
        } else {
            checkboxes.forEach(function(checkbox) {
                checkbox.disabled = false; // Enable all checkboxes
            });
        }
        // Update the 'maxSelection' based on the selected option value
        maxSelection = parseInt(this.value);

        selectBtn.disabled = true;
        selectBtn.className = 'btn btn-secondary';

      });

      // Loop through all checkboxes and add an event listener for the 'change' event
      checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
          if (this.checked) {
            // If the checkbox is checked, add its value to the selectedCheckboxes array
            selectedCheckboxes.push(this.value);
            // Check if the number of selected checkboxes exceeds the maximum allowed
            if (selectedCheckboxes.length > maxSelection) {
              // Get the first selected checkbox, uncheck it, and remove it from the array
              var checkbox = document.getElementById(selectedCheckboxes[0]);
              var firstCheckbox = selectedCheckboxes.shift();
              $("#selected_judul").val(selectedCheckboxes); // fill the input hidden
              checkbox.checked = false;
            }
          } else {
            // If the checkbox is unchecked, find its index in the selectedCheckboxes array and remove it
            var index = selectedCheckboxes.indexOf(this.value);
            selectedCheckboxes.splice(index, 1);
          }

          // Disable other checkboxes when the maximum selection is reached
          checkboxes.forEach(function(otherCheckbox) {
            if (selectedCheckboxes.indexOf(otherCheckbox.value) === -1) {
              otherCheckbox.disabled = selectedCheckboxes.length >= maxSelection;
            }
          });

          // Update the 'maxSelection' based on the selected option value
          maxSelection = parseInt(document.getElementById('selectOption').value);

          // Update the select button state
          if (selectedCheckboxes.length == maxSelection) {
            selectBtn.disabled = false;
            selectBtn.className = 'btn btn-primary';
          } else {
            selectBtn.disabled = true;
            selectBtn.className = 'btn btn-secondary';
          }

          $("#selected_judul").val(selectedCheckboxes); // fill the input hidden
        });
      });
      

    
      $(document).on("click", ".modalDelete", function () {
        var data_judul = $(this).data('data_judul');
        console.log(data_judul);
        // var cluster_name = $(this).data('name');
        
        // $("#bookId").val(cluster_id);
        $(".modal-title").html(`Hapus Data ${data_judul}`);
        $("#message-body").html(`Apakah anda ingin menghapus ${data_judul}?`);
        $(".text-secondary").html(`Semua data ${data_judul} akan terhapus !`);

        $('#judul_data').val(data_judul);


      });
    });
  

  </script>
  <!-- Page level plugins -->
  <script src="/lib/datatables/jquery.dataTables.min.js"></script>
  <script src="/lib/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/js/demo/datatables-demo.js"></script>
@endsection