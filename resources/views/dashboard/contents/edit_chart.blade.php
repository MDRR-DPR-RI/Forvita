@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
    <link href="/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="main main-app p-3 p-lg-4">
  <div class="container mt-5 mb-5">
      @if (!in_array($content->chart->id, [ 5, 10, 11, 12, 14, 15, 16])) {{-- list of chart that can only have 1 stack  --}}
        <div class="text-center d-flex justify-content-center align-items-center flex-column">
          <p>Berapa stack?</p>
            <select name="selectOption" id="selectOption">
              @for ($index = 1; $index <= 5; $index++)
                @if (count(json_decode($content->judul)) == $index)
                  <option value="{{ $index }}" selected>{{ $index }}</option>
                @else
                  <option value="{{ $index }}">{{ $index }}</option>
                @endif
              @endfor
            </select>
        </div>
      @else
        <input type="hidden" id="selectOption" value="1">
      @endif
      <br>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          {{-- <table class="table table-hover" id="dataTable" width="100%" cellspacing="0"> --}} <!-- search feature for tabl not use this first cause still have a bug in checkbox -->
          <table class="table table-hover" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Grup</th>
                <th scope="col">Data</th>
                <th scope="col">Judul</th>
                <th scope="col">Select</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($cleans as $clean)
                {{-- @php
                  $contentArray = json_decode('["Jumlah penganut Agama Anggota","Jumlah "]');
                @endphp --}}
                <tr>
                  <td scope="row">{{ $loop->iteration }}</td>
                  <td>{{ $clean->group }}</td>
                  <td>{{ $clean->data }}</td>
                  <td>{{ $clean->judul }}</td>
                  <td>
                  @if (in_array($clean->judul, json_decode($content->judul)))
                    <input class="select-judul" type="checkbox" name="judul" id="{{ $clean->judul }}" value="{{ $clean->judul }}" checked>
                  @else 
                    <input class="select-judul" type="checkbox" name="judul" id="{{ $clean->judul }}" value="{{ $clean->judul }}">
                  @endif 
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- card-body -->
      </div><!-- table-responsive -->
    </div><!-- card -->
    <br>
    <input type="hidden" value="{{ $content->id }}" id="contentId">
    <form action="/dashboard/content/{{ $content->id }}" method="get">
      @csrf
      <div class="col d-flex justify-content-end">
        <input type="hidden" name="selected_judul" id="selected_judul" value="{{implode(',', json_decode($content->judul)) }}">
        @if ($content->card_title)
          <button class="btn btn-primary" id="selectBtn">Selanjutnya</button>
        @else
          <button class="btn btn-secondary" id="selectBtn" disabled>Selanjutnya</button>
        @endif
      </div>
    </form>
  </div>
</div><!-- main-app -->

@endsection

@section('custom_script')
  <script>
    $(document).ready(function() {
      const selectBtn = document.getElementById('selectBtn');

      // Initialize the maximum selection to 1
      var maxSelection = document.getElementById('selectOption').value;
      console.log(maxSelection);

      // Get all elements with the class 'select-judul' and store them in an array
      var checkboxes = document.querySelectorAll('.select-judul');

      // Initialize an array to store the selected checkboxes
      var selectedCheckboxes = {!! $content->judul !!};

      // Add an event listener to the 'selectOption' element for the 'change' event
      document.getElementById('selectOption').addEventListener('change', function() {

        if (maxSelection > this.value) {
            selectedCheckboxes = [];
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false; // Uncheck all checkboxes
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
                checkbox.checked = false;
                var firstCheckbox = selectedCheckboxes.shift();
                console.log(selectedCheckboxes); // Output the updated selected checkboxes array
            }
          } else {
            // If the checkbox is unchecked, find its index in the selectedCheckboxes array and remove it
            var index = selectedCheckboxes.indexOf(this.value);
            selectedCheckboxes.splice(index, 1);
            console.log(selectedCheckboxes); // Output the updated selected checkboxes array
          }
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
    });
  

  </script>
  <!-- Page level plugins -->
  <script src="/lib/datatables/jquery.dataTables.min.js"></script>
  <script src="/lib/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/js/demo/datatables-demo.js"></script>
@endsection