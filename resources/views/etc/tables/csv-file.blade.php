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
                <a href="#importCSVModal" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal">
                    <i class="ri-file-excel-2-line fs-18 lh-1"></i>Import CSV
                </a>
                <a href="#importAPIModal" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal">
                    <i class="ri-file-excel-2-line fs-18 lh-1"></i>Import RESTful API
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
    {{-- Modal untuk Impor CSV --}}
    <div class="modal fade" id="importCSVModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import CSV File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="tableName" class="form-label">Table Name</label>
                            <input class="form-control" type="text" id="tableName" name="tableName" required>
                        </div>
                        <div class="mb-3">
                            <label for="csvFile" class="form-label">Choose CSV File</label>
                            <input class="form-control" type="file" id="csvFile" name="csvFile" accept=".csv" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Import CSV</button>
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
        @foreach($csvFiles as $csvFile)
            {
                name: "{{$csvFile->name}}", 
                file: "{{$csvFile->file}}",
                status: `{!! $csvFile->action ? "<button class='btn btn-success w-50'>create</button>" : "<button class='btn btn-danger w-50'>not create</button>" !!}`, 
                action: `<a href='{{ route('csv.create',['id'=> $csvFile->id ]) }}' class="btn btn-primary w-50">Create Table</a><br/><a href='{{ route("csv.delete",['id'=>$csvFile->id]) }}' class="mt-2 btn btn-danger w-50">Delete File</a>`},
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
            title: 'Name',
            sortable: true,
            align: 'center'
            },
            {
            field: 'file',
            title: 'File URL',
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
            title: 'Action',
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