@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<form action="/dashboard/content/{{ $content->id }}" method="post">
@method('put')
@csrf
  <div class="main main-app p-3 p-lg-4">
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
            @for ($i = 0; $i < $stackCount; $i++)
                @php
                    $variableName = 'clean' . $i;
                    $value = $$variableName; // $$ is used to create a variable variable
                    // Now, $value contains the value of $clean0, $clean1, etc. based on the value of $i

                    $x_value_decodedArray = json_decode($content->x_value, true);
                @endphp
                <label class="form-label">Pilih Nilai X data: {{ $value[0]['judul'] }}</label>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">
                            <div class="form-check">
                            <label class="form-check-label" for="selectAllCheckbox{{ $i }}">Pilih Semua</label>
                            @if (isset($x_value_decodedArray[$i]) && 
                                  ($x_value_decodedArray[$i] !== null && count($x_value_decodedArray[$i]) == count($value))
                            )
                              <input class="form-check-input" type="checkbox" id="selectAllCheckbox{{ $i }}" checked>
                            @else
                              <input class="form-check-input" type="checkbox" id="selectAllCheckbox{{ $i }}" >
                            @endif
                            </div>
                        </th>
                        <th scope="col">Judul</th>
                        <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($value as $clean)
                        <tr class="table-row" data-judul="Item 1">
                          <td scope="row">
                            @if (
                                  isset($x_value_decodedArray[$i]) && 
                                  ($x_value_decodedArray[$i] !== null && in_array($clean->keterangan, $x_value_decodedArray[$i]))
                              )
                                <input class="checkbox-item{{ $i }}" type="checkbox" value="{{ $clean->keterangan }}" name="xValue{{ $i }}[]" checked >
                            @else
                              <input class="checkbox-item{{ $i }}" type="checkbox" value="{{ $clean->keterangan }}" name="xValue{{ $i }}[]" >
                            @endif
                            {{ $clean->keterangan }}
                              
                            <input type="hidden" name="selectedJudul{{ $i }}" value="{{ $clean->judul }}">
                          </td>
                          <td>{{ $clean->judul }}</td>
                          <td>{{ $clean->jumlah }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>    
            @endfor
          <input type="hidden" value="{{ $stackCount }}" name="stackCount">
          <input type="hidden" value="{{ $content->dashboard->id }}" name="dashboard_id">
          <div class="col d-flex justify-content-end">
            <button type="submit" class="btn btn-secondary" >Selesai</button>
            {{-- todo: disabled btn til the selected checkbox.length is equal  --}}
          </div>
        </div>
    {{-- <div class="main-footer mt-5">
      <span>&copy; 2023. DPR RI</span>
    </div><!-- main-footer --> --}}
  </div><!-- main-app -->
</form>

@endsection

@section('custom_script')
  <script>
    $(document).ready(function() {
      // ccheck all
      let stackCount = {{ $stackCount }}
      for (let index = 0; index < stackCount; index++) {
        $(`#selectAllCheckbox${index}`).click(function() {
            $(`.checkbox-item${index}`).prop('checked', $(this).prop('checked'));
            console.log("all")
        });

          // Listen for changes on item checkboxes
        $(`.checkbox-item${index}`).on('change', function () {
            // Check if all item checkboxes are checked
            var allChecked = $(`.checkbox-item${index}:checked`).length === $(`.checkbox-item${index}`).length;

            // Update the `Select All` checkbox accordingly
            let checkboxLength = $(`.checkbox-item${index}`).length;
            $(`#selectAllCheckbox${index}`).prop('checked', allChecked);
            console.log(checkboxLength);
        });
      }
    })
    

  </script>
  <!-- Page level plugins -->
  <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/js/demo/datatables-demo.js"></script>
@endsection