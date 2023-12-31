@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
<form action="/dashboard/content/{{ $content->id }}" method="post">
@method('put')
@csrf
  <div class="main main-app p-3 p-lg-4">
    <div class="container mt-5 mb-5">
      <div>
        <ol class="breadcrumb fs-sm mb-0">
          <li class="breadcrumb-item"><a href="/dashboard/{{ $dashboard->id }}">{{ $dashboard->name }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $content->chart->name }}</li>
        </ol> 
        <br>
        <h4 class="main-title mb-0">Konfigurasi Untuk Kartu {{ $content->chart->name }}</h4>
      </div> <hr>
      <div class="row">
          <div class="col-xl-6">
              <label for="card_title" class="form-label">Judul Kartu</label>
              @if ($content->chart->id == 21) 
              {{-- id for chart=card --}}
                <input type="text" class="form-control" placeholder="Kartu ini tidak memiliki judul" aria-label="card_title" name="card_title" disabled>
              @else
                <input type="text" class="form-control" placeholder="Masukan judul kartu disini..." aria-label="card_title" name="card_title" value="{{ $content->card_title }}" required>
              @endif
          </div>
          <div class="col-xl-4">
              <label for="chart_type" class="form-label">Tipe Kartu</label>
              <select id="chart_type" name="chart_type" class="form-select" @if (in_array($content->chart->id, [18,19,20,21,22,23,24,25,26])) disabled @endif>
              @foreach ($charts as $chart)
                @if ($chart->name == $content->chart->name)
                    <option value="{{ $chart->id }}" selected>{{ $chart->name }}</option>
                @else
                  @if (!in_array($chart->id, [18,19,20,21,22,23,24,25,26]))
                    <option value="{{ $chart->id }}">{{ $chart->name }}</option>
                  @endif
                @endif
              @endforeach
              </select>
          </div>
          <div class="col-xl-2">
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
              {{-- id for chart=card --}}
            @if ($content->chart->id == 20)
                <label for="card_description" class="form-label">Hasil Analisis AI</label>
                <textarea class="form-control" id="card_description" name="card_description" rows="3" placeholder="Belum ada hasil analisis AI." disabled>{{ $content->card_description }}</textarea>
            @elseif($content->chart->id == 20 || $content->chart->id == 21)
                <label for="card_description" class="form-label">Deskripsi Kartu</label>
                <textarea class="form-control" id="card_description" name="card_description" rows="3" placeholder="Kartu ini tidak memiliki deskripsi" disabled></textarea>
            @else
                <label for="card_description" class="form-label">Deskripsi Kartu</label>
                <textarea class="form-control" id="card_description" name="card_description" rows="3" placeholder="Masukan deskripsi kartu disini..." required>{{ $content->card_description }}</textarea>
            @endif
          </div>
          <div> <br>
            @for ($i = 0; $i < $stackCount; $i++)
                @php
                    $variableName = 'clean' . $i;
                    $value = $$variableName; // $$ is used to create a variable variable
                    // Now, $value contains the value of $clean0, $clean1, etc. based on the value of $i

                    $variableName2 = 'date' . $i;
                    $value2 = $$variableName2;

                    $judul_decodedArray = json_decode($content->judul, true);
                    $x_value_decodedArray = json_decode($content->x_value, true);
                    $content_clean_created_at = json_decode($content->clean_created_at, true);
                    $colors_decodedArray = json_decode($content->color, true);
                    $loops = 0;
                @endphp
                <div class="card-body text-center d-flex justify-content-center align-items-center flex-column">
                  <label class="form-label mt-2">Pilih Nilai X data: {{ $value[0]['judul'] }}</label>
                  @if (in_array($content->chart->id, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]))
                    <label for="color_picker">Warna :</label>
                    @if (isset($colors_decodedArray[$i]) && ($colors_decodedArray[$i] !== ""))
                      <input class="btn-icon" type="color" id="color_picker" name="color_picker{{ $i }}" value="{{ $colors_decodedArray[$i] }}">
                    @else
                      <input class="btn-icon" type="color" id="color_picker" name="color_picker{{ $i }}" value="#506fd9">
                    @endif
                  @endif
                </div>
                <div class="col-xl-2 d-flex justify-content-start">
                  <select class="form-select" name="filter_date{{ $i }}" id="clean_date{{ $i }}">
                    @foreach ($value2 as $clean)
                        <option value="{{ ($clean->created_at) }}, {{ ($clean->judul) }}" 
                          @if ( isset($content_clean_created_at[$i]) && $clean->created_at == $content_clean_created_at[$i])
                            selected
                          @endif
                        >
                          {{ ($clean->newest == 1) ? "(Data Terbaru) ". ($clean->created_at . " (" . $clean->created_at->diffForHumans() . ")") : ($clean->created_at . " (" . $clean->created_at->diffForHumans() . ")") }}
                        </option>
                    @endforeach
                  </select>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover">
                      <thead>
                          <tr>
                          <th scope="col">
                              <div class="form-check">
                              @if ( isset($x_value_decodedArray[$i]) && $x_value_decodedArray[$i] !== "" && count($x_value_decodedArray[$i]) == count($value) )
                                <input class="form-check-input" type="checkbox" id="selectAllCheckbox{{ $i }}" checked>
                              @else
                                <input class="form-check-input" type="checkbox" id="selectAllCheckbox{{ $i }}" >
                              @endif
                              <label class="form-check-label" for="selectAllCheckbox{{ $i }}">Keterangan</label>
                              </div>
                          </th>
                          <th scope="col">Judul</th>
                          <th scope="col">Status Data</th>
                          <th scope="col">Jumlah</th>
                          @if (in_array($content->chart->id, [16, 17, 19, 24, 25]))
                            <th scope="col">Warna</th>
                          @endif
                          </tr>
                      </thead>
                      <tbody id="table_body{{ $i }}">
                        @foreach ($value as $clean)
                          <tr class="table-row{{ $i }}" data-judul="Item 1">
                            <td scope="row">
                              @if (isset($x_value_decodedArray[$i]) && in_array($clean->keterangan, $x_value_decodedArray[$i]))
                                  <input class="checkbox-item{{ $i }}" type="checkbox" value="{{ $clean->keterangan }}" name="xValue{{ $i }}[]" checked >
                              @else
                                <input class="checkbox-item{{ $i }}" type="checkbox" value="{{ $clean->keterangan }}" name="xValue{{ $i }}[]" >
                              @endif
                              {{ $clean->keterangan }}
                                
                              <input type="hidden" name="selectedJudul{{ $i }}" value="{{ $clean->judul }}">
                            </td>
                            <td>{{ $clean->judul }}</td>
                          <td>{{ ($clean->newest == 1) ? "Terbaru" : ($clean->created_at)}}</td>

                            <td>{{ $clean->jumlah }}</td>
                            @if (in_array($content->chart->id, [16, 17, 19, 24, 25]))
                              <td>
                              @if (isset($x_value_decodedArray[$i]) && in_array($clean->keterangan, $x_value_decodedArray[$i]))
                                <input type="color" id="colorPicker{{ $loop->iteration }}" name="color_picker{{ $i }}[]" value="{{ $colors_decodedArray[$loops] }}">
                                @php
                                    $loops++
                                @endphp
                              @else
                                <input type="color" id="colorPicker{{ $loop->iteration }}" name="color_picker{{ $i }}[]" value="#506fd9" disabled style="display: none">
                              @endif
                              </td>
                            @endif
                          </tr>
                        @endforeach
                      </tbody>
                  </table>    
                </div>
            @endfor
            @if ($content->chart_id == 20)
              <div class="text-center" >
                  <div class="modal-body container text-center">
                    <label for="judul">Pilih Perintah:</label>
                    {{-- set on change function, when user add new prompt, then will show INPUT FIELD to enter new prompt --}}
                    <select id="selectPrompt" class="form-select" name="selectPrompt" onchange="checkForNewPrompt()">
                      @foreach ($prompts as $prompt)
                        @if ($prompt->id == $content->prompt->id) 
                          <option value="{{ $prompt->body }}" selected>{{ $prompt->body }}</option>
                        @else
                          <option value="{{ $prompt->body }}">{{ $prompt->body }}</option>
                        @endif
                      
                      @endforeach
                      {{-- IF THE USER ADD NEW PROMPT THEN UPDATE THE prompt_id in contents(table) WITH next id of prompt(new id) --}}
                      @php
                        // Calculate the next ID by adding 1 to the last prompt's ID
                        $nextId = $prompts->isEmpty() ? 1 : $prompts->last()->id + 1;
                      @endphp
                        <option value="{{ $nextId }}">Tambah Perintah Baru</option>
                    </select>
                    <!-- Add a new prompt input field initially hidden -->
                    <div id="newPromptInput" class="modal-body container text-center" style="display: none;">
                      <label for="newPrompt">Masukkan Perintah Baru:</label>
                      <input type="text" id="newPrompt" name="newPrompt" class="form-control">
                    </div>
                    <input type="hidden" name="dashboard_id" value="{{ $dashboard->id }}" > <br>
                    {{-- <div>
                      <textarea class="form-control" id="textArea" name="text_area_prompt" rows="3" placeholder="Masukan perintah disini...">Tolong lakukan analisis data berdasarkan {{ $content->prompt->body }}. Mohon berikan analisis dan wawasan Anda dalam satu paragraf dan dimulai dengan kalimat = Data menunjukkan bahwa.....
                      </textarea>
                    </div> --}}
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
                      
                      // // Get the content-editable div and prompt select elements
                      // var contentEditableDiv = document.getElementById("exampleFormControlTextarea1");
                      // var promptSelect = document.getElementById("selectPrompt");
                      // var prompt = "{{ $content->prompt->body }}";
                      // // Attach the onchange event listener to the prompt select
                      // promptSelect.onchange = function() {
                      //     var selectedValue = promptSelect.value;
                      //     // Update $selectedPrompt variable in the textarea content
                      //     var textareaElement = document.getElementById("textArea");
                      //     textareaElement.value = textareaElement.value.replace(prompt, selectedValue);
                      //     prompt = selectedValue
                      // };
                    </script>
                  </div><!-- modal-body -->
              </div>
              <br>
            @endif
         
          <input type="hidden" value="{{ $stackCount }}" name="stackCount">
          <input type="hidden" value="{{ $content->dashboard->id }}" name="dashboard_id">
          <div class="col d-flex justify-content-end">
          {{-- BUG: when user edit chart and change the stack. the button is not disabled. make it disabled --}}
            @if ( $x_value_decodedArray[0][0] !== "" && $stackCount == count($x_value_decodedArray) && $judul_decodedArray == $selected_judul )
              <button type="submit" class="btn btn-primary" id="selesaiBtn" >Selesai</button>
            @else
              <button type="submit" class="btn btn-secondary" id="selesaiBtn" disabled>Selesai</button>
            @endif
          </div>
        </div>
    {{-- <div class="main-footer mt-5">
      <span>&copy; 2023. DPR RI</span>
    </div><!-- main-footer --> --}}
    </div><!-- main-app -->
  </div><!-- main-app -->
</form>

@endsection

@section('custom_script')
  <script>
      var selesaiBtn = document.getElementById("selesaiBtn");

      function enableSelectBeforeSubmit() {
          // Enable the select element before submitting the form
          document.getElementById("chart_type").disabled = false;
      }

      // Attach the handleClick function to the button's onclick event
      selesaiBtn.onclick = enableSelectBeforeSubmit;

  </script>

  <script>
    $(document).ready(function() {

        let stackCount = {{ $stackCount }};
        // Create an array to keep track of checkbox counts for each group, initialize to 0
        const counters = new Array(stackCount).fill(0);

        for (let i = 0; i < stackCount; i++) {
            // Listen for clicks on the "Select All" checkbox
            $(`#selectAllCheckbox${i}`).click(function() {
              const isChecked = $(this).prop('checked');
              // Check/uncheck all item checkboxes in the current group
              $(`.checkbox-item${i}`).prop('checked', isChecked);
              counters[i] = isChecked ? $(`.checkbox-item${i}`).length : 0;
              updateSelesaiButton(counters, i);

              // Enable or disable input color pickers based on "Select All" checkbox
              const checkboxes = document.querySelectorAll(`.checkbox-item${i}`);
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
              counters[i] = $(`.checkbox-item${i}:checked`).length;
            $(`.checkbox-item${i}`).on('change', function() {
                // Check if all item checkboxes are checked in the current group
              counters[i] = $(`.checkbox-item${i}:checked`).length;
                updateSelesaiButton(counters, i);
                
                // Uncheck the "Select All" checkbox if any individual checkbox is unchecked
                if (counters[i] < $(`.checkbox-item${i}`).length) {
                    $(`#selectAllCheckbox${i}`).prop('checked', false);
                } else {
                    $(`#selectAllCheckbox${i}`).prop('checked', true);
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
          
          var clean_date = document.getElementById(`clean_date${i}`)

          // Listen for changes on the select element
          $(`#clean_date${i}`).change(function () {
              clean_date = $(this).val();
              var trContainer = $(`.table-row${i}`);//trow
              var tbContainer = $(`#table_body${i}`); //tbody

              trContainer.empty(); // Remove content inside the table row

              const newElement = `
                  <td colspan="4">
                      <p class="card-text placeholder-glow" id="placeholder">
                        <span class="placeholder col-12"></span>
                      </p>
                  </td>
              `;

              trContainer.append(newElement); // Append the new content

              $.ajax({
                url: '/filter-clean',
                method: 'GET',
                data: { clean_date: clean_date },
                success: function (data) {
                  trContainer.remove()
                  var colorInput = '';
                  $(`#selectAllCheckbox${i}`).prop('checked', false);

                    // Update the items container with the filtered data
                  $.each(data.data, function (index, clean) {
                    @if (in_array($content->chart->id, [16, 17, 19, 24, 25]))
                        colorInput = `
                            <td>
                                <input type="color" id="colorPicker${index + 1}" name="color_picker${i}[]" value="#506fd9" disabled style="display: none">
                            </td>
                        `;  
                    @endif
                    var clean_createdAt = clean.created_at;
                    let date = new Date(clean_createdAt);
                    let formattedDate = date.toLocaleString('en-US', {
                      year: 'numeric',
                      month: '2-digit',
                      day: '2-digit',
                      hour: '2-digit',
                      minute: '2-digit',
                      second: '2-digit',
                      hour12: false,  // Set to false for 24, 25-hour format
                      timeZone: 'UTC'
                    });

                    var newRow = `
                      <tr class="table-row${i}" data-judul="Item 1">
                        <td>
                          <input class="checkbox-item${i}" type="checkbox" value="${clean.keterangan}" name="xValue${i}[]" >
                            ${clean.keterangan}
                          <input type="hidden" name="selectedJudul${i}" value="${clean.judul}">
                        </td>
                        <td>${clean.judul}</td>
                        <td>${(clean.newest == 1) ? "Terbaru" : (formattedDate)}</td>
                        <td>${clean.jumlah}</td>
                        ${colorInput}
                      </tr>
                      `;
                    tbContainer.append(newRow);
                  });
                  var checkboxes = document.querySelectorAll(`.checkbox-item${i}`);
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
                  // Listen for changes on item checkboxes in the current group
                  counters[i] = $(`.checkbox-item${i}:checked`).length;
                  $(`.checkbox-item${i}`).on('change', function() {
                      // Check if all item checkboxes are checked in the current group
                    counters[i] = $(`.checkbox-item${i}:checked`).length;
                      updateSelesaiButton(counters, i);
                      
                      // Uncheck the "Select All" checkbox if any individual checkbox is unchecked
                      if (counters[i] < $(`.checkbox-item${i}`).length) {
                          $(`#selectAllCheckbox${i}`).prop('checked', false);
                      } else {
                          $(`#selectAllCheckbox${i}`).prop('checked', true);
                      }
                  });
                },
                error: function (error) {
                    console.log(error);
                }
            });
          });
        }

        function updateSelesaiButton(counters, i) {
            // Get the "selesai" button element
            const selesaiBtn = document.getElementById('selesaiBtn');
            // Check if all counters have the same value
            if (counters.every(count => count > 0) && counters[0] > 0) {
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