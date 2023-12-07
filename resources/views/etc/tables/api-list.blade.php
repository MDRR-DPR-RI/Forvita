@extends('dashboard.layouts.main')

@section('custom_vendor')
    <!-- Vendor CSS -->
    <link href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table-locale-all.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/export/bootstrap-table-export.min.js"></script>

    <style>
    .select,
    #locale {
        width: 100%;
    }
    .like {
        margin-right: 10px;
    }
    </style>
@endsection
@parent

@section('page_content')
    <div class="main main-app p-3 p-lg-4">
        @can('admin')
        <div class="d-flex gap-2 mt-3 mt-md-0">
                <a href="#importAPIModal" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal">
                    <i class="bi bi-link-45deg"></i>Impor RESTful API
                </a>
        </div>
        <div class="mt-3">
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif (session()->has('deleted'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Deleted!</strong> {{ session('deleted') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>

        <table
            id="table"
            data-search="true"
            data-show-refresh="true"
            data-show-toggle="true"
            data-show-fullscreen="true"
            data-detail-view="true"
            data-click-to-select="true"
            data-detail-formatter="detailFormatter"
            data-minimum-count-columns="2"
            data-show-pagination-switch="true"
            data-pagination="true"
            data-id-field="id"
            data-page-list="[5,10, 25, 50, 100, all]"
            data-show-footer="true">
        </table>
        @endcan
    </div>
    {{-- Modal untuk Impor From RESTful API --}}
    <div class="modal fade" id="importAPIModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Impor dari RESTful API</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import.api') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          Contoh URL
                            <ol class="list-group list-group-numbered">
                              <li class="list-group-item">https://catfact.ninja/fact</li>
                              <li class="list-group-item">https://www.dpr.go.id/rest/?method=getAgendaPerBulan&tahun=2015&bulan=02&tipe=json</li>
                            </ol>
                            <label for="tableName" class="form-label">Nama Tabel</label>
                            <input class="form-control" type="text" id="tableName" name="tableName" required>
                        </div>
                        <div class="mb-3">
                            <label for="api_url" class="form-label">Masukan URL</label>
                            <input class="form-control" type="text" id="api_url" name="api_url" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Impor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- table script -->
    <script>
    var $table = $('#table')
    var selections = []

    function getIdSelections() {
        return $.map($table.bootstrapTable('getSelections'), function (row) {
        return row.id
        })
    }

    function responseHandler(res) {
        $.each(res.rows, function (i, row) {
        row.state = $.inArray(row.id, selections) !== -1
        })
        return res
    }

    function detailFormatter(index, row) {
        var html = []
        $.each(row, function (key, value) {
        html.push('<p><b>' + key + ':</b> ' + value + '</p>')
        })
        return html.join('')
    }

    function tombolBelum(value, row, index) {
        return [
        '<button class="btn btn-danger" data-id="' + row.id + '">',
        'not create',
        '</button>'
        ].join('');
    }

    //   data
    var localData = [
        @foreach($apiLists as $apiList)
            {
                name: "{{$apiList->name}}", 
                file: "{{$apiList->file}}",
                status: `{!! $apiList->action ? "<span class='btn btn-success btn-sm'>Berhasil Dibuat</span>" : "<span class='btn btn-danger btn-sm'>Belum Dijalankan</span>" !!}`, 
                action: `<div class='d-flex justify-content-center p-2'>
                            {!! $apiList->action ?
                                "<a href='". route('restapi.delete',['id'=> $apiList->id ]) ."' class='btn-icon mx-1 btn btn-warning' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Hapus Tabel'>
                                    <i class='bi bi-file-earmark-excel'></i>
                                </a>" :
                                "<a href='". route('restapi.create',['id'=> $apiList->id ]) ."' class='btn-icon mx-1 btn btn-success' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Jalankan \/ Buat Tabel'>
                                    <i class='bi bi-triangle-fill'></i>
                                </a>" !!} 
                                
                                <a href='{{ route("restapi.remove",['id'=>$apiList->id]) }}' class="btn-icon mx-1 btn btn-danger" data-bs-toggle='tooltip' data-bs-placement='bottom' title='Hapus List'>
                                    <i class='bi bi-trash-fill'></i>
                                </a>
                                <a href='{{ route("restapi.view",['id'=>$apiList->id]) }}' class="btn-icon mx-1 btn btn-secondary" data-bs-toggle='tooltip' data-bs-placement='bottom' title='Lihat'>
                                    <i class='bi bi-eye-fill'></i>
                                </a>
                            </div>`
            },
        @endforeach
    ];

    function initTable() {
        $table.bootstrapTable('destroy').bootstrapTable({
        data: localData, // Use local data instead of data-url
        locale:"en-US",
        height: 900,
        columns: [
            {
            field: 'name',
            title: 'Nama Tabel',
            sortable: true,
            align: 'center'
            },
            {
            field: 'file',
            title: 'URL',
            sortable: true,
            align: 'center'
            },
            {
            field: 'status',
            title: 'Status',
            sortable: true,
            align: 'center'
            },
            {
            field: 'action',
            title: 'Aksi',
            sortable: true,
            align: 'center'
            }
        ]
        });

        //... (rest of the code remains unchanged)
    }

    $(function() {
        initTable();
    });
    </script>
@endsection
