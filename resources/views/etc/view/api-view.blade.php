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
            @if($dataAPI == "0")
                <a href='{{ route("csv.create",["id"=> $_GET["id"] ]) }}"' class='btn btn-primary w-50'>Buat Tabel</a>
            @else
                
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
        var apiUrl = "{{$dataAPI->file}}";

        fetch(apiUrl)
            .then(response => response.text())
            .then(apiData => {
                // Proses data menggunakan Papaparse
                Papa.parse(apiData, {
                    header: true,
                    complete: function(results) {
                        if (results && results.data && results.data.length > 0) {
                            var apiObject = results.data;

                            // Gantikan spasi dengan garis bawah (_) dalam data API
                            var modifiedData = apiObject.map(item => {
                                try {
                                    return Object.fromEntries(
                                        Object.entries(item).map(([key, value]) => [key, value ? value.toString().replace(/ /g, '_') : ''])
                                    );
                                } catch (error) {
                                    console.error('Error modifying data:', error);
                                    console.log('Problematic item:', item);
                                    return {};
                                }
                            });

                            var head = Object.keys(modifiedData[0]);

                            var row = Object.values(modifiedData).map(Object.values);
                            var localData = row.map(function(dataRow) {
                                return Object.assign(...head.map((key, index) => ({ [key]: dataRow[index] })));
                            });

                            // Tampilkan data dalam bentuk tabel atau sesuai kebutuhan Anda
                            console.log(localData);
                        } else {
                            console.error('Error parsing data:', results.errors);
                        }


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
