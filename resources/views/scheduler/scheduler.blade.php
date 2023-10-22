@extends('dashboard.layouts.main')

@section('custom_vendor')
    <!-- Vendor CSS -->

@endsection
@parent

@section('page_content')
    <div class="main main-app p-3 p-lg-4">
        <h1> Schedulers </h1>
        <div class="row">
            <div class="col">
                {{--Query Format Card--}}
                <div class="card" id="queryFormatCard" style="width: 22rem; margin-left: auto; margin-right: 0;">
                    <div class="card-body">
                        <h5 class="card-title">Query Format</h5>
                        <p class="card-text">
                            Rules: <br>
                            1. Three columns in order: <br>judul, keterangan, jumlah (Case sensitive!)<br>
                            2. Groups of data needs to have the same judul with keterangan to describe the differences.<br>
                            3. Don't have any null or empty string values in any columns.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                {{--Query Example Card--}}
                    <div class="card" id="queryExampleCard" style="width: 50rem;">
                        <div class="card-body">
                            <h5 class="card-title">Query Example</h5>
                            <p class="card-text">
                                SELECT * <br>
                                FROM (<br>
                                SELECT 'total_dummy_data' AS judul, 'total_dummy_data_a' AS keterangan, sum(a) AS jumlah<br>
                                FROM dataset.dummy_data<br>
                                UNION<br>
                                SELECT 'total_dummy_data' AS judul, 'total_dummy_data_b' AS keterangan, sum(b) AS jumlah<br>
                                FROM dataset.dummy_data<br>
                                UNION<br>
                                SELECT 'total_dummy_data' AS judul, 'total_dummy_data_c' AS keterangan, sum(c) AS jumlah<br>
                                FROM dataset.dummy_data<br>
                                ) AS query;
                            </p>
                        </div>
                    </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Query</th>
                <th scope="col">Database</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
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
                    <td>
                        {{--Execute Scheduler Query--}}
                        <a href="/scheduler/execute?schedulerID={{ $scheduler->id }}" class="btn btn-success">Execute</a>

                        {{--Edit Scheduler--}}
                        <a data-bs-toggle="modal" data-bs-target="#editSchedulerModal"
                           data-bs-schedulerID="{{ $scheduler->id }}"
                           data-bs-schedulerName="{{ $scheduler->name }}"
                           data-bs-schedulerQuery="{{ $scheduler->query }}"
                           data-bs-schedulerDatabaseID="{{ $scheduler->database_id }}"
{{--                           @isset($scheduler->database_id)--}}
{{--                               data-bs-schedulerDatabaseName="{{$scheduler->database->name}}"--}}
{{--                           @endisset--}}
                           class="btn btn-primary">Edit</a>

                        {{--Delete Scheduler--}}
                        <form action="/scheduler" method="post">
                            @method('delete')
                            @csrf
                            <input type="hidden" name="schedulerID" value="{{ $scheduler->id }}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2">
                    <a href="#addSchedulerModal" class="btn btn-primary d-flex align-items-center gap-2"
                       data-bs-toggle="modal"><i class="ri-add-line"></i>
                        <span class="d-none d-sm-inline">Add Scheduler</span></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

{{--Add Scheduler Modal--}}
<div class="modal fade" id="addSchedulerModal" tabindex="-1" aria-hidden="true">
    <form action="/scheduler" method="post">
        <div class="modal-dialog">
            <!-- modal-content -->
            <div class="modal-content">
                <!-- modal-header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add Scheduler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- modal-body -->
                <div class="modal-body container text-center">
                    <div class="form-group">
                        <label for="schedulerName">Scheduler Name</label>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @csrf
                    <button type="submit" class="btn btn-primary">Add Scheduler</button>
                </div>
            </div>
        </div>
    </form>
</div>

{{--Edit Scheduler Modal--}}
<div class="modal fade" id="editSchedulerModal" tabindex="-1" aria-hidden="true">
    <form action="/scheduler" method="post">
        <div class="modal-dialog">
            <!-- modal-content -->
            <div class="modal-content">
                <!-- modal-header -->
                <div class="modal-header">
                    <h5 class="modal-title">Edit Scheduler (Name)</h5>
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

@section('custom_script')

@endsection

