<div>
    {{--    Initialize livewire modals--}}
    @livewire('wire-elements-modal')
    <label for="searchSchemaQuery">Cari Skema</label>
    <div class="form-search">
        <i class="ri-search-line"></i>
        <input type="text" class="form-control" id="searchSchemaQuery"
               wire:model.live="searchSchemaQuery"
               placeholder="Masukkan nama skema">
    </div>
    <label for="searchTableQuery">Cari Tabel</label>
    <div class="form-search">
        <i class="ri-search-line"></i>
        <input type="text" class="form-control" id="searchTableQuery"
               wire:model.live="searchTableQuery"
               placeholder="Masukkan nama tabel">
    </div>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Skema</th>
                <th scope="col">Tabel</th>
            </tr>
            </thead>
            @foreach($datatables as $datatable)
                <tbody>
                <tr wire:key="{{$datatable->TABLE_SCHEMA.$datatable->TABLE_NAME}}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$datatable->TABLE_SCHEMA}}</td>
                    <td>{{$datatable->TABLE_NAME}}</td>
                </tr>
                </tbody>
            @endforeach

        </table>
    </div>
    {{ $datatables->links() }}
</div>