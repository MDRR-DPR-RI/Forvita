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
                    $colors_decodedArray = json_decode($content->color, true);
                    $loops = 0;
                @endphp
                <div class="card-body text-center d-flex justify-content-center align-items-center flex-column">
                <label class="form-label mt-2">Pilih Nilai X data: {{ $value[0]['judul'] }}</label>
                @if (in_array($content->chart->id, [1, 2, 3, 4, 7, 9, 13]))
                  <label for="color_picker">Warna :</label>
                  @if (isset($colors_decodedArray[$i]) && ($colors_decodedArray[$i] !== null))
                    <input class="btn-icon" type="color" id="color_picker" name="color_picker{{ $i }}" value="{{ $colors_decodedArray[$i] }}">
                  @else
                    <input class="btn-icon" type="color" id="color_picker" name="color_picker{{ $i }}" value="#506fd9">
                  @endif
                @endif
                </div>
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
                        @if (in_array($content->chart->id, [5, 10, 14]))
                          <th scope="col">Warna</th>
                        @endif
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
                          @if (in_array($content->chart->id, [5, 10, 14, 16]))
                            <td>
                            @if (isset($x_value_decodedArray[$i]) && 
                                  ($x_value_decodedArray[$i] !== null && in_array($clean->keterangan, $x_value_decodedArray[$i])))
                              <input type="color" id="colorPicker{{ $loop->iteration }}" name="color_picker[]" value="{{ $colors_decodedArray[$loops] }}">
                              @php
                                  $loops++
                              @endphp
                            @else
                              <input type="color" id="colorPicker{{ $loop->iteration }}" name="color_picker[]" value="#506fd9" disabled style="display: none">
                            @endif
                            </td>
                          @endif
                        </tr>
                      @endforeach
                    </tbody>
                </table>    
            @endfor
            @if ($content->chart_id == 8)
                <div class="text-center">
                <form id="contentForm" action="/dashboard/content/" method="post">
                  @method('put')
                  @csrf
                  <div class="modal-body container text-center">
                    <label for="judul">Select Prompt:</label>
                    {{-- set on change function, when user add new prompt, then will show INPUT FIELD to enter new prompt --}}
                    <select id="selectPrompt" class="form-select" name="selectPrompt" onchange="checkForNewPrompt()">
                      @foreach ($prompts as $prompt)
                        @if ($prompt->id == $content->prompt->id) <!-- IMPORTANT: UPDATE THIS IF $prompt->id is EQUAL with the prompt_id in table contents -->
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
                        <option value="{{ $nextId }}">Tambah Prompt Baru</option>
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
                </form>
              </div>
            @endif
         
          <input type="hidden" value="{{ $stackCount }}" name="stackCount">
          <input type="hidden" value="{{ $content->dashboard->id }}" name="dashboard_id">
          <div class="col d-flex justify-content-end">
          {{-- BUG: when user edit chart and change the stack. the button is not disabled. make it disabled --}}
            @if ($stackCount == count($x_value_decodedArray))
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

              // Enable or disable input color pickers based on "Select All" checkbox
              const checkboxes = document.querySelectorAll(`.checkbox-item${index}`);
              checkboxes.forEach(function(checkbox, checkboxIndex) {
                  const inputColorPicker = document.getElementById(`colorPicker${checkboxIndex + 1}`);
                  if (isChecked) {
                      inputColorPicker.disabled = false;
                      inputColorPicker.style.display = 'block';
                  } else {
                      inputColorPicker.disabled = true;
                      inputColorPicker.style.display = 'none';
                  }
              });
            });
            // Listen for changes on item checkboxes in the current group
              counters[index] = $(`.checkbox-item${index}:checked`).length;
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
          var checkboxes = document.querySelectorAll('.checkbox-item0');
          let x = 1;
          checkboxes.forEach(function(checkbox) {
            let inputColorPicker =  document.getElementById(`colorPicker${x}`)
            checkbox.addEventListener('change', function() {
              if (this.checked) {
                inputColorPicker.disabled = false 
                inputColorPicker.style.display = 'block'; 
              } else {
                inputColorPicker.disabled = true
                inputColorPicker.style.display = 'none'; 
              }
            })
            x++;
          })
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