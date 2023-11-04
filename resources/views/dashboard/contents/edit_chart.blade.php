@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
    <link href="/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="main main-app p-3 p-lg-4">
  <div class="container"><br><br><br>
    <div class="card">
      <div class="card-body">
      Berapa stack?
      <select name="selectOption" id="selectOption">
        @for ($index = 1; $index <= 5; $index++)
          @if (count(json_decode($content->judul)) == $index)
            <option value="{{ $index }}" selected>{{ $index }}</option>
          @else
            <option value="{{ $index }}">{{ $index }}</option>
          @endif
        @endfor
      </select>
        <div class="table-responsive">
          {{-- <table class="table table-hover" id="dataTable" width="100%" cellspacing="0"> --}} <!-- search feature for tabl not use this first cause still have a bug in checkbox -->
          <table class="table table-hover" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kluster</th>
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
                  <td>{{ $clean->cluster }}</td>
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
        @if ($content->judul)
          <button class="btn btn-primary" id="selectBtn">Pilih</button>
        @else
          <button class="btn btn-secondary" id="selectBtn" disabled>Pilih</button>
        @endif
      </div>
    </form>
  </div>
  {{-- <div class="main-footer mt-5">
    <span>&copy; 2023. DPR RI</span>
  </div><!-- main-footer --> --}}
</div><!-- main-app -->
    
    {{-- modal select xValues --}}
    {{-- <form action="/dashboard/content/{{ $content->id }}" method="post">
      @method('put')
      @csrf
      <input type="hidden" name="" id="">
      <div class="modal fade" id="modal5" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Card</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
              <div class="row">
                <div class="col-8">
                  <label for="card_title" class="form-label">Judul Kartu</label>
                  @if ($content->chart->id == 11 || $content->chart->id == 15)
                    <input type="text" class="form-control" placeholder="Kartu ini tidak memiliki judul" aria-label="card_title" name="card_title" disabled>
                  @else
                    <input type="text" class="form-control" placeholder="Judul" aria-label="card_title" name="card_title" value="{{ $content->card_title }}" required>
                  @endif
                </div>
                <div class="col">
                  <label for="card_grid" class="form-label">Panjang Kartu</label>
                  <select id="card_grid" name="card_grid" class="form-select">
                    @for ($a = 1; $a <= 12; $a++)
                      @if ($a == $content->card_grid)
                        <option selected>{{ $a }}</option>
                      @else
                        <option>{{ $a }}</option>
                      @endif
                    @endfor
                  </select>
                </div>
              </div><br>
              <div>

                <label for="card_description" class="form-label">Deskripsi Kartu</label>
                @if ($content->chart->id == 11 || $content->chart->id == 15)
                  <textarea class="form-control" id="card_description" name="card_description" rows="3" placeholder="Kartu ini tidak memiliki deskripsi" disabled></textarea>
                @else
                  <textarea class="form-control" id="card_description" name="card_description" rows="3" placeholder="Masukan deskripsi kartu disini..." required>{{ $content->card_description }}</textarea>
                @endif
              </div>
              <div> <br>
                <label class="form-label">Pilih Nilai X</label>
                <div id="table-container">
                  <p class="card-text placeholder-glow">
                    <span class="placeholder col-7"></span>
                    <span class="placeholder col-4"></span>
                    <span class="placeholder col-4"></span>
                    <span class="placeholder col-6"></span>
                    <span class="placeholder col-8"></span>
                  </p>
                </div>
              </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <input type="hidden" name="selectedJudul" id="selectedJudul">
              <input type="hidden" name="dashboard_id" value="{{ $content->dashboard->id }}">
              <input type="hidden" value="{{ $content->id }}" id="contentId">
              <button type="submit" class="btn btn-primary">Apply</button>
            </div><!-- modal-footer -->
          </div><!-- modal-content -->
        </div><!-- modal-content -->
      </div><!-- modal -->
    </form>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

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
        // Update the 'maxSelection' based on the selected option value
        maxSelection = parseInt(this.value);

        // Reset the array of selected checkboxes
        selectedCheckboxes = [];
        $("#selected_judul").val(null); // empty the input hidden

        // Loop through all checkboxes and uncheck them
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false; // Uncheck all checkboxes
        });

        // disabled select button
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


    //   let selectedJudul;
    //   // this is for add asign the selectedJudul variable if user want to s=edit the data in the cards. 
    //   for (var i = 1; i <= {{ count($cleans) }}; i++) {
    //     var checkbox = document.getElementById("selectJudul" + i);

    //     if (checkbox && checkbox.checked) {
    //       selectedJudul = checkbox.value;
    //       console.log("Checkbox value for index " + i + ": " + selectedJudul);
    //     }
    //   }
    // // Attach a click event listener to the "Update" button
    //     $('#selectBtn').click(function () {
    //       // var selectedJudul = $('#selectJudul').val();
    //       console.log(selectedJudul);
    //       $("#selectedJudul").val(selectedJudul); // fill the input hidden type to store in db
    //       var contentId = $('#contentId').val();
    //               // $(aiAnalysisElement).text("API Error");

    //         //Make an AJAX request to fetch data
    //         $.ajax({
    //             url: '/fetch-data',
    //             method: 'post',
    //             data: {
    //                 selectedJudul: selectedJudul,
    //                 contentId: contentId
    //             },
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             success: function (data) {
    //               let xValue;
    //               if (typeof data.xValue === 'object' && data.xValue[0] !== null) { // check data.xValue is !null
    //                 xValue = JSON.parse(data.xValue);
    //               } else {
    //                 xValue = "";
    //               }

    //               var tableHtml = '<table class="table">';
    //               tableHtml += '<thead>';
    //               tableHtml += '<tr>';
    //               tableHtml += '<th scope="col">';
    //               tableHtml += '<div class="form-check">';
    //               tableHtml += '<input class="form-check-input" type="checkbox" id="selectAllCheckbox" ';

    //               // Select all if the xValue is all in db
    //               console.log(xValue.length);
    //               console.log(data.value.length);
    //               console.log($(".checkbox-item:checked").length);
    //               console.log($(".checkbox-item").length);
    //                 if (xValue.length == data.value.length) {
    //                     tableHtml += 'checked';
    //                     console.log("checked all")
    //                 }
                    

    //               tableHtml += '>';

    //               tableHtml += '<label class="form-check-label" for="flexCheckDefault">';
    //               tableHtml += 'Select All';
    //               tableHtml += '</label>';
    //               tableHtml += '</div>';
    //               tableHtml += '</th>';
    //               tableHtml += '<th scope="col">Judul</th>';
    //               tableHtml += '<th scope="col">Jumlah</th>';
    //               tableHtml += '</tr>';
    //               tableHtml += '</thead>';
    //               tableHtml += '<tbody>';
              
    //               // Iterate over the data and build table rows
    //               data.value.forEach(function (item) {
    //                   tableHtml += '<tr class="table-row" data-judul="' + item.judul + '">';
    //                   tableHtml += '<td scope="row">';
    //                   tableHtml += '<input class="form-check-input checkbox-item" type="checkbox" ';
    //                   tableHtml += 'value="' + item.keterangan + '" id="item' + item.index + '" name="xValue[]" ';
                      
    //                   // Check the box if the value is in db
    //                   if (xValue.includes(item.keterangan)) {
    //                       tableHtml += 'checked';
    //                       console.log("checked " + item.keterangan)
    //                   }
                      
    //                   tableHtml += '>';
    //                   tableHtml += ' ' + item.keterangan;
    //                   tableHtml += '</td>';
    //                   tableHtml += '<td>' + item.judul + '</td>';
    //                   tableHtml += '<td>' + item.jumlah + '</td>';
    //                   tableHtml += '</tr>';
    //               });

    //               tableHtml += '</tbody>';
    //               tableHtml += '</table>';

    //               // Update the table container with the dynamic table
    //               $('#table-container').html(tableHtml);
    //                 // ccheck all
    //               $("#selectAllCheckbox").click(function() {
    //                   $(".checkbox-item").prop('checked', $(this).prop('checked'));
    //                   console.log("all")
    //               });
    //                 // Listen for changes on item checkboxes
    //               $(".checkbox-item").on('change', function () {
    //                   // Check if all item checkboxes are checked
    //                   var allChecked = $(".checkbox-item:checked").length === $(".checkbox-item").length;

    //                   // Update the "Select All" checkbox accordingly
    //                   $("#selectAllCheckbox").prop('checked', allChecked);
    //               });
    //             },
    //             error: function (error) {
    //                 console.error(error);
    //             }
    //         });
    //     });
    });
  

  </script>
  <!-- Page level plugins -->
  <script src="/lib/datatables/jquery.dataTables.min.js"></script>
  <script src="/lib/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/js/demo/datatables-demo.js"></script>
@endsection