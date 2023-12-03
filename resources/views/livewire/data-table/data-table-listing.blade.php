<div>
    {{--    Initialize livewire modals--}}
    @livewire('wire-elements-modal')
    <form wire:submit="search">
        <div class="row">
            <div class="col">
                <label for="searchSchemaQuery">
                    Cari Skema
                    <div class="form-search">
                        <i class="ri-search-line"></i>
                        <input type="text" class="form-control" id="searchSchemaQuery"
                               wire:model="searchSchemaQuery"
                               placeholder="Masukkan nama skema">
                    </div>
                </label>
                <label for="searchTableQuery">
                    Cari Tabel
                    <div class="form-search">
                        <i class="ri-search-line"></i>
                        <input type="text" class="form-control" id="searchTableQuery"
                               wire:model="searchTableQuery"
                               placeholder="Masukkan nama tabel">
                    </div>
                </label>
                <button type="submit" class="btn btn-outline-primary"> Cari </button>
                <button wire:click="$dispatch('openModal', { component: 'data-table.execute-query',
                                            arguments: {}})"
                        class="btn btn-outline-primary"> Query </button>
            </div>
        </div>

    </form>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Skema</th>
                <th scope="col">Tabel</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            @foreach($datatables as $datatable)
                <tbody>
                <tr wire:key="{{$datatable->TABLE_SCHEMA.$datatable->TABLE_NAME}}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$datatable->TABLE_SCHEMA}}</td>
                    <td>{{$datatable->TABLE_NAME}}</td>
                    <td>
                        <button wire:click="$dispatch('openModal', { component: 'data-table.view-table',
                                            arguments: {schemaName: '{{ $datatable->TABLE_SCHEMA }}', tableName: '{{ $datatable->TABLE_NAME }}'}})"
                                class="btn btn-outline-primary">
                            Lihat
                        </button>
                    </td>
                </tr>
                </tbody>
            @endforeach

        </table>
    </div>
    {{ $datatables->links() }}
</div>