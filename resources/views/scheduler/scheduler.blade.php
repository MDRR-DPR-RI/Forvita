@extends('dashboard.layouts.main')

@section('custom_vendor')
    <!-- Vendor CSS -->

@endsection
@parent

@section('page_content')
    <div class="main main-app p-3 p-lg-4">
        <h1> Queries </h1>
        <div class="row">
            <div class="col">
                {{--Query Format Card--}}
                <div class="card" id="queryFormatCard" style="width: 22rem; margin-left: auto; margin-right: 0;">
                    <div class="card-body">
                        <h5 class="card-title">Format Query</h5>
                        <p class="card-text">
                            Aturan: <br>
                            1. Lima kolom dengan urutan: <br>kelompok, data, judul, keterangan, jumlah (case sensitive!)<br>
                            2. Kelompok data harus memiliki kelompok, data, dan judul yang sama dengan keterangan untuk menjelaskan perbedaannya.<br>
                            3. Tidak mempunyai nilai string null atau kosong di tiap kolomnya.<br>
                            4. Tiap driver database mempunyai sintaks yang berbeda.
                            {{-- Rules:
                            1. Five columns in order: group, data, judul, keterangan, jumlah (Case sensitive!)
                            2. Groups of data needs to have the same group, data, and judul with keterangan to describe the differences.
                            3. Don't have any null or empty string values in any columns.
                            4. Different database drivers have different syntaxes. --}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                {{--Query Example Card--}}
                    <div class="card" id="queryExampleCard" style="width: 50rem;">
                        <div class="card-body">
                            <h5 class="card-title">Contoh Query</h5>
                            <p class="card-text">
                                SELECT * <br>
                                FROM ( <br>
                                select 'dummy' as kelompok, 'arithmetic dummies' as 'data','total dummy data' as 'judul', 'a' as 'keterangan', sum(a) as 'jumlah' <br>
                                from dummy_data <br>
                                UNION <br>
                                select 'dummy' as kelompok, 'arithmetic dummies' as 'data','total dummy data' as 'judul', 'b' as 'keterangan', sum(b) as 'jumlah' <br>
                                from dummy_data <br>
                                UNION <br>
                                select 'dummy' as kelompok, 'arithmetic dummies' as 'data','total dummy data' as 'judul', 'c' as 'keterangan', sum(c) as 'jumlah' <br>
                                from dummy_data <br>
                                ) as query;
                            </p>
                        </div>
                    </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-3 mb-3">
                <a href="#addSchedulerModal" class="btn btn-primary d-flex align-items-center gap-2"
                   data-bs-toggle="modal"><i class="ri-add-line"></i>
                    <span class="d-none d-sm-inline">Tambahkan Query</span></a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Query</th>
                <th scope="col">Database</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($schedulers as $scheduler)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $scheduler->name }}</td>
                    <td>{{ $scheduler->query }}</td>
                    @isset($scheduler->database_id)
                        <td>{{ $scheduler->database->name }}</td>
                    @else
                        <td>localhost</td>
                    @endisset
                    <td>{{ $scheduler->status }}</td>
                    <td class="d-flex justify-content-start">
                        {{--Execute Scheduler Query--}}
                        <a href="/scheduler/execute?schedulerID={{ $scheduler->id }}" class="btn btn-success btn-icon mx-1">
                            <i class="bi bi-gear" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jalankan"></i>
                        </a>

                        {{--Edit Scheduler--}}
                        <a data-bs-toggle="modal" data-bs-target="#editSchedulerModal"
                           data-bs-schedulerID="{{ $scheduler->id }}"
                           data-bs-schedulerName="{{ $scheduler->name }}"
                           data-bs-schedulerQuery="{{ $scheduler->query }}"
                           data-bs-schedulerDatabaseID="{{ $scheduler->database_id }}"
{{--                           @isset($scheduler->database_id)--}}
{{--                               data-bs-schedulerDatabaseName="{{$scheduler->database->name}}"--}}
{{--                           @endisset--}}
                           class="btn btn-primary btn-icon mx-1">
                                <i data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ubah" class="ri-pencil-fill"></i>
                           </a>

                        {{--Delete Scheduler--}}
                        <form action="/scheduler" method="post">
                            @method('delete')
                            @csrf
                            <input type="hidden" name="schedulerID" value="{{ $scheduler->id }}">
                            <button type="submit" class="btn btn-danger btn-icon mx-1">
                                <i data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

{{--Add Scheduler Modal--}}
<div class="modal fade" id="addSchedulerModal" tabindex="-1" aria-hidden="true">
    <form action="/scheduler" method="post">
        <div class="modal-dialog modal-xl">
            <!-- modal-content -->
            <div class="modal-content">
                <!-- modal-header -->
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan Penjadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- modal-body -->
                <div class="modal-body container text-center">
                    <div class="form-group">
                        <label for="schedulerName">Nama Penjadwal</label>
                        <input type="text" id="schedulerName" name="schedulerName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="schedulerQuery">Query</label>
                        <textarea id="schedulerQuery" name="schedulerQuery" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="schedulerDatabaseID">Database</label>
                        <select id="schedulerDatabaseID" name="schedulerDatabaseID" class="form-select" aria-label="Select Database Scheduler">
                            <option value="">Localhost</option>
                            @foreach ($databases as $database)
                                <option value="{{$database->id}}">{{$database->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- modal-footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    @csrf
                    <button type="submit" class="btn btn-primary">Tambahkan Penjadwal</button>
                </div>
            </div>
        </div>
    </form>
</div>

{{--Edit Scheduler Modal--}}
<div class="modal fade" id="editSchedulerModal" tabindex="-1" aria-hidden="true">
    <form action="/scheduler" method="post">
        <div class="modal-dialog modal-xl">
            <!-- modal-content -->
            <div class="modal-content">
                <!-- modal-header -->
                <div class="modal-header">
                    <h5 class="modal-title">Edit Penjadwal (Name)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- modal-body -->
                <div class="modal-body container text-center">
                    <input type="hidden" id="schedulerID" name="schedulerID">
                    <div class="form-group">
                        <label for="schedulerName">Scheduler Name</label>
                        <input type="text" id="schedulerName" name="schedulerName" class="form-control"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="schedulerQuery">Query</label>
                        <textarea id="schedulerQuery" name="schedulerQuery" class="form-control"
                                  required></textarea>
                    </div>
                    <div id="schedulerDatabaseSelectGroup" class="form-group">
                        <label for="schedulerDatabaseID">Database</label>
                        <select id="schedulerDatabaseID" name="schedulerDatabaseID" class="form-select" aria-label="Select Database Scheduler">
                            <option value="">Localhost</option>
                            @foreach ($databases as $database)
                                <option value="{{$database->id}}">{{$database->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- modal-footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @method('patch')
                    @csrf
                    <button type="submit" class="btn btn-primary">Edit Scheduler</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Javascript for assigning edit scheduler modal
    let editSchedulerModal = document.getElementById('editSchedulerModal')
    editSchedulerModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget
        let schedulerID = button.getAttribute('data-bs-schedulerID')
        let schedulerName = button.getAttribute('data-bs-schedulerName')
        let schedulerQuery = button.getAttribute('data-bs-schedulerQuery')
        let schedulerDatabaseID = button.getAttribute('data-bs-schedulerDatabaseID')

        let modalTitle = editSchedulerModal.querySelector(".modal-title")
        modalTitle.textContent = "Edit Scheduler " + schedulerName

        let schedulerIdInput = editSchedulerModal.querySelector("#schedulerID")
        schedulerIdInput.value = schedulerID

        let schedulerNameInput = editSchedulerModal.querySelector('#schedulerName')
        schedulerNameInput.value = schedulerName

        let schedulerQueryInput = editSchedulerModal.querySelector('#schedulerQuery')
        schedulerQueryInput.value = schedulerQuery

        let schedulerDatabaseIDInput = editSchedulerModal.querySelector('#schedulerDatabaseID')
        schedulerDatabaseIDInput.value = schedulerDatabaseID
    })
</script>
@endsection