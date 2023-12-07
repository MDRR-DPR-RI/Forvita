@extends('dashboard.layouts.main')

@section('custom_vendor')
    <!-- Vendor CSS -->

@endsection
@parent

@section('page_content')
    <link href="/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <div class="main main-app p-3 p-lg-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @elseif (session()->has('deleted'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terhapus!</strong> {{ session('deleted') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="container">
            <h1 class="mt-4 mb-4">Queries</h1>
            <div class="row">
                <div class="col">
                    <!-- Query Format Card -->
                    <div class="card" id="queryFormatCard">
                        <div class="card-body">
                            <h5 class="card-title">Format Query</h5>
                            <p class="card-text">
                                <strong>Aturan:</strong>
                                <ol>
                                    <li>Hasil query <b> harus </b> memiliki lima kolom dengan urutan: <b> kelompok, data, judul, keterangan, jumlah.</b></li>
                                    <li>Pengguna <b>menentukan</b> nama <b> kelompok, data, dan judul</b>. Sementara itu, <b> keterangan dan jumlah </b> merupakan data yang diambil dari database yang dituju.</li>
                                    <li>Hasil query <b> harus </b> memiliki nilai <b> kelompok </b> yang sama, nilai <b> data </b> yang sama, dan nilai <b> judul </b> yang sama.</li>
                                    <li><b>Tidak boleh </b> ada nilai <b> NULL </b> atau <b> string kosong </b> di kolom manapun.</li>
                                    <li>Tiap driver database mungkin memiliki sintaks yang berbeda.</li>
                                </ol>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> <br>
        <div class="row g-3">
            <div class="col-xl-6">
                {{--Query Example Card--}}
                <div class="card" id="queryExampleCard">
                    <div class="card-body">
                        <h5 class="card-title">Contoh Query</h5>
                        <pre class="card-text">

        SELECT * 
        FROM (
            SELECT 'MINANGWAN' as kelompok, 
                'Agama' as data, 
                'Agama Dari database MINANGWAN' as judul, 
                agama as keterangan, 
                COUNT(*) as jumlah 
            FROM db_minangwan.anggota 
            WHERE status = 1 AND agama IS NOT NULL 
            GROUP BY agama 
            ORDER BY agama DESC
        ) AS query;
                            {{-- SELECT * <br>
                            FROM ( <br>
                            select 'dummy' as kelompok, 'arithmetic dummies' as 'data','total dummy data' as 'judul', 'a' as 'keterangan', sum(a) as 'jumlah' <br>
                            from dummy_data <br>
                            UNION <br>
                            select 'dummy' as kelompok, 'arithmetic dummies' as 'data','total dummy data' as 'judul', 'b' as 'keterangan', sum(b) as 'jumlah' <br>
                            from dummy_data <br>
                            UNION <br>
                            select 'dummy' as kelompok, 'arithmetic dummies' as 'data','total dummy data' as 'judul', 'c' as 'keterangan', sum(c) as 'jumlah' <br>
                            from dummy_data <br>
                            ) as query; --}}
                        </pre>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                {{--Query Example Card--}}
                <div class="card" id="queryExampleCard" >
                    <div class="card-body">
                        <h5 class="card-title">Contoh Hasil Query</h5>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">kelompok</th>
                                <th scope="col">data</th>
                                <th scope="col">judul</th>
                                <th scope="col">keterangan</th>
                                <th scope="col">jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <tD>MINANGWAN</td>
                                    <td>Agama</td>
                                    <td>Agama Dari Database MINANGWAN</td>
                                    <td>Kristen</td>
                                    <td>56</td>
                                </tr>
                                <tr>
                                    <tD>MINANGWAN</td>
                                    <td>Agama</td>
                                    <td>Agama Dari Database MINANGWAN</td>
                                    <td>Katolik</td>
                                    <td>26</td>
                                </tr>
                                <tr>
                                    <tD>MINANGWAN</td>
                                    <td>Agama</td>
                                    <td>Agama Dari Database MINANGWAN</td>
                                    <td>Islam</td>
                                    <td>473</td>
                                </tr>
                                <tr>
                                    <tD>MINANGWAN</td>
                                    <td>Agama</td>
                                    <td>Agama Dari Database MINANGWAN</td>
                                    <td>Hindu</td>
                                    <td>11</td>
                                </tr>
                                <tr>
                                    <tD>MINANGWAN</td>
                                    <td>Agama</td>
                                    <td>Agama Dari Database MINANGWAN</td>
                                    <td>Budha</td>
                                    <td>4</td>
                                </tr>
                            </tbody>
                        </table>
                        <p><strong>Penjelasan:</strong></p>
                        <p class="card-text">
                        Ini adalah contoh hasil query yang dapat diterima. 
                            Pengguna menentukan kelompok, data, dan judul. Sementara itu, keterangan dan jumlah merupakan data yang diambil dari database yang dituju.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-3 mb-3">
                <a href="#addSchedulerModal" class="btn btn-primary d-flex align-items-center gap-2"
                   data-bs-toggle="modal"><i class="ri-add-line"></i>
                    <span class="d-none d-sm-inline">Tambahkan Query</span></a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable">
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
                        <td><pre>{{ $scheduler->query }}</pre></td>
                        @isset($scheduler->database_id)
                            <td>{{ $scheduler->database->name }}</td>
                        @else
                            <td>localhost</td>
                        @endisset
                        <td>{{ $scheduler->status }}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                {{--Execute Scheduler Query--}}
                                <a href="/scheduler/execute?schedulerID={{ $scheduler->id }}" class="btn btn-success btn-icon mx-1">
                                    <i class="bi bi-triangle-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jalankan"></i>
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
                                class="btn btn-primary btn-icon">
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
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

{{--Add Scheduler Modal--}}
<div class="modal fade" id="addSchedulerModal" tabindex="-1" aria-hidden="true">
    <form action="/scheduler" method="post">
        <div class="modal-dialog modal-xl">
            <!-- modal-content -->
            <div class="modal-content">
                <!-- modal-header -->
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan Query</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- modal-body -->
                <div class="modal-body container ">
                    <div class="form-group">
                        <label for="schedulerName">Nama Query</label>
                        <input type="text" id="schedulerName" name="schedulerName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="schedulerQuery">Query</label>
                        <textarea id="schedulerQuery" rows="20" name="schedulerQuery" class="form-control" required></textarea>
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
                <div class="modal-body container m-1">
                    <input type="hidden" id="schedulerID" name="schedulerID">
                    <div class="form-group m-1">
                        <label for="schedulerName">Scheduler Name</label>
                        <input type="text" id="schedulerName" name="schedulerName" class="form-control"
                               required>
                    </div>
                    <div class="form-group m-1">
                        <label for="schedulerQuery">Query</label>
                        <textarea id="schedulerQuery" rows="20" name="schedulerQuery" class="form-control"
                                  required></textarea>
                    </div>
                    <div id="schedulerDatabaseSelectGroup" class="form-group m-1">
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
    <!-- Page level plugins -->
    <script src="/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="/lib/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/datatables-demo.js"></script>
@endsection