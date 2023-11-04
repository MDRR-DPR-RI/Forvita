@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
<form action="/dashboard/content/{{ $content->id }}" method="post">
@method('put')
@csrf
  <div class="main main-app p-3 p-lg-4">
      <div class="row">
          <div class="col-8">
              <label for="card_title" class="form-label">Judul Kartu</label>
              @if ($content->chart->id == 11)
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
          @if ($content->chart->id == 11)
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
            @if ($content->judul)
              <button type="submit" class="btn btn-primary" id="selesaiBtn">Selesai</button>
            @else
              <button type="submit" class="btn btn-secondary" id="selesaiBtn" disabled>Selesai</button>
            @endif
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
        
        let stackCount = {{ $stackCount }};

        // Create an array to keep track of checkbox counts for each group, initialize to 0
        const counters = new Array(stackCount).fill(0);

        for (let index = 0; index < stackCount; index++) {
            // Listen for clicks on the "Select All" checkbox
            $(`#selectAllCheckbox${index}`).click(function() {
                const isChecked = $(this).prop('checked');
                // Check/uncheck all item checkboxes in the current group
                $(`.checkbox-item${index}`).prop('checked', isChecked);
                counters[index] = isChecked ? $(`.checkbox-item${index}`).length : 0;
                updateSelesaiButton(counters, index);
            });

            // Listen for changes on item checkboxes in the current group
            $(`.checkbox-item${index}`).on('change', function() {
                // Check if all item checkboxes are checked in the current group
                counters[index] = $(`.checkbox-item${index}:checked`).length;
                updateSelesaiButton(counters, index);
                
                // Uncheck the "Select All" checkbox if any individual checkbox is unchecked
                if (counters[index] < $(`.checkbox-item${index}`).length) {
                    $(`#selectAllCheckbox${index}`).prop('checked', false);
                } else {
                    $(`#selectAllCheckbox${index}`).prop('checked', true);
                }
            });
        }

        function updateSelesaiButton(counters, index) {
            // Get the "selesai" button element
            const selesaiBtn = document.getElementById('selesaiBtn');
            // Check if all counters have the same value
            if (counters.every(count => count === counters[0]) && counters[0] > 0) {
                // Enable the "selesai" button and change its class to primary
                selesaiBtn.disabled = false;
                selesaiBtn.className = 'btn btn-primary';
            } else {
                // Disable the "selesai" button and change its class to secondary
                selesaiBtn.disabled = true;
                selesaiBtn.className = 'btn btn-secondary';
            }
        }
    });
  </script>
@endsection