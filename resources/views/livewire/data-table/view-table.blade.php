<div>
    <div class="modal d-block"
         tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
            <!-- modal-content -->
            <div class="modal-content">
                <!-- modal-header -->
                <div class="modal-header">
                    <h5 class="modal-title">Lihat Tabel {{$tableName}}</h5>
                    <button type="button" class="btn-close"
                            wire:click="$dispatch('closeModal')" aria-label="Close"></button>
                </div>
                <!-- modal-body -->
                <div class="modal-body container text-center">
                    <div wire:loading>
                        <h5>
                            Loading...
                        </h5>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            @foreach($columnNames as $columnName)
                                <th scope="col">{{$columnName->column_name}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr>
                                @foreach($row as $value)
                                    <td>{{$value}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- modal-footer -->
                <div class="modal-footer">
                    <button type="button"
                            wire:click="$dispatch('closeModal')"
                            class="btn btn-secondary">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>