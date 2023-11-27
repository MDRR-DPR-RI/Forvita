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
            @if($dataCSV == "0")
                <a href='{{ route("csv.create",["id"=> $_GET["id"] ]) }}"' class='btn btn-primary w-50'>Buat Tabel</a>
            @else
                
            @endif
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

        <script src="{{ asset('js/papaparse.min.js') }}"></script>
        <div id="csv-container"></div>

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
        // Ambil data CSV dari endpoint di kontroler
        fetch('/csv/view/target?id={{ $_GET["id"] }}')
            .then(response => response.text())
            .then(csvData => {
                // Proses data menggunakan Papaparse
                Papa.parse(csvData, {
                    header: true,
                    complete: function(results) {
                        var csvObject = results.data;

                        var head = Object.keys(csvObject[0]);

                        var row = Object.values(csvObject).map(Object.values);
                        var localData = row.map(function(dataRow) {
                            return Object.assign(...head.map((key, index) => ({ [key]: dataRow[index] })));
                        });
                        var headColumn = []
                        head.forEach(function(column) {
                            headColumn.push({
                                field: column,
                                title: column,
                                sortable: true,
                                align: 'left'
                            });
                        });

                        console.log(headColumn);


                        // data table

                        function tombolBelum(value, row, index) {
                            return [
                            '<button class="btn btn-danger" data-id="' + row.id + '">',
                            'not create',
                            '</button>'
                            ].join('');
                        }

                        console.log('Combined Data:', localData);

                        function initTable() {
                            $table.bootstrapTable('destroy').bootstrapTable({
                            data: localData, // Use local data instead of data-url
                            locale:"en-US",
                            height: 900,
                            columns: headColumn
                            });

                            //... (rest of the code remains unchanged)
                        }

                        $(function() {
                            initTable();
                        });

                        // Tampilkan hasil gabungan
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    </script>
@endsection
