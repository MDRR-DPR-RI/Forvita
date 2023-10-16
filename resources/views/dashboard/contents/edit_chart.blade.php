@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')

 <div class="main main-docs">
      <div class="container">

<br><br><br>
        
        <div class="card card-example">
          <div class="card-body">
            <label for="judul">Select Data:</label>
              <select id="selectJudul" class="form-select" name="judul">

                @foreach ($juduls as $judulOption)
                    @if ($judulOption == $content->judul)
                      <option value="{{ $judulOption }}" selected>{{ $judulOption }}</option>
                    @else
                      <option value="{{ $judulOption }}">{{ $judulOption }}</option>
                    @endif
                @endforeach
            </select>

            <br>
          </div><!-- card-body -->
        </div><!-- card -->
          <br>
        <input type="hidden" value="{{ $content->id }}" id="contentId">
              <div class="col d-flex justify-content-end">
                <button href="#modal5" class="btn btn-primary" data-bs-toggle="modal" id="updateBtn">Select</button>
              </div>
            {{-- <button type="submit" class="btn btn-primary">Update Table</button> --}}
            </div>
      </div>
    {{-- modal select xValues --}}
          <form action="/dashboard/content/{{ $content->id }}" method="post">
              @method('put')
              @csrf
              <input type="hidden" name="" id="">
          <div class="modal fade" id="modal5" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">select x values</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><!-- modal-header -->
          <div class="modal-body" id="modalContent">
              <div id="table-container">
          
    <p class="card-text placeholder-glow">
      <span class="placeholder col-7"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-6"></span>
      <span class="placeholder col-8"></span>
    </p>
              </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="hidden" name="selectedJudul" id="selectedJudul">
            <input type="hidden" name="dashboard_id" value="{{ $dashboard_id }}">
            <button type="submit" class="btn btn-primary">Apply</button>
          </div><!-- modal-footer -->
        </div><!-- modal-content -->
      </div><!-- modal-content -->
    </div><!-- modal -->
    </form>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
     // Attach a click event listener to the "Update" button
        $('#updateBtn').click(function () {
          var selectedJudul = $('#selectJudul').val();
          $("#selectedJudul").val(selectedJudul); // fill the input hidden type to store in db
          var contentId = $('#contentId').val();  

            //Make an AJAX request to fetch data
            $.ajax({
                url: '/fetch-data',
                method: 'post',
                data: {
                    selectedJudul: selectedJudul,
                    contentId: contentId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {

                let xValue;
                if (typeof data.xValue === 'object' && data.xValue[0] !== null) { // check data.xValue is !null
                  xValue = JSON.parse(data.xValue);
                } else {
                  xValue = "";
                }

                var tableHtml = '<table class="table">';
                tableHtml += '<thead>';
                tableHtml += '<tr>';
                tableHtml += '<th scope="col">';
                tableHtml += '<div class="form-check">';
                tableHtml += '<input class="form-check-input" type="checkbox" id="selectAllCheckbox" ';

                // Select all if the xValue is all in db
                  if (xValue.length == data.value.length && $(".checkbox-item:checked").length === $(".checkbox-item").length) {
                      tableHtml += 'checked';
                      console.log("checked all")
                  }
                  

                tableHtml += '>';

                tableHtml += '<label class="form-check-label" for="flexCheckDefault">';
                tableHtml += 'Select All';
                tableHtml += '</label>';
                tableHtml += '</div>';
                tableHtml += '</th>';
                tableHtml += '<th scope="col">Judul</th>';
                tableHtml += '<th scope="col">Jumlah</th>';
                tableHtml += '</tr>';
                tableHtml += '</thead>';
                tableHtml += '<tbody>';
             
                // Iterate over the data and build table rows
                data.value.forEach(function (item) {
                    tableHtml += '<tr class="table-row" data-judul="' + item.judul + '">';
                    tableHtml += '<td scope="row">';
                    tableHtml += '<input class="form-check-input checkbox-item" type="checkbox" ';
                    tableHtml += 'value="' + item.keterangan + '" id="item' + item.index + '" name="xValue[]" ';
                    
                    // Check the box if the value is in db
                    if (xValue.includes(item.keterangan)) {
                        tableHtml += 'checked';
                        console.log("checked " + item.keterangan)
                    }
                    
                    tableHtml += '>';
                    tableHtml += ' ' + item.keterangan;
                    tableHtml += '</td>';
                    tableHtml += '<td>' + item.judul + '</td>';
                    tableHtml += '<td>' + item.jumlah + '</td>';
                    tableHtml += '</tr>';
                });

                tableHtml += '</tbody>';
                tableHtml += '</table>';

                // Update the table container with the dynamic table
                $('#table-container').html(tableHtml);
                    // ccheck all
                  $("#selectAllCheckbox").click(function() {
                      $(".checkbox-item").prop('checked', $(this).prop('checked'));
                      console.log("all")
                  });
                    // Listen for changes on item checkboxes
                  $(".checkbox-item").on('change', function () {
                      // Check if all item checkboxes are checked
                      var allChecked = $(".checkbox-item:checked").length === $(".checkbox-item").length;

                      // Update the "Select All" checkbox accordingly
                      $("#selectAllCheckbox").prop('checked', allChecked);
                  });
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    });
 
</script>

@endsection

@section('custom_script')


@endsection

