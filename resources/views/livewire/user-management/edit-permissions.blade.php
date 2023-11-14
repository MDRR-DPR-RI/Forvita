<div>
    <div class="modal d-block"
         tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <!-- modal-content -->
                <div class="modal-content">
                    <!-- modal-header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Perizinan</h5>
                        <button type="button" class="btn-close"
                                wire:click="$dispatch('closeModal')" aria-label="Close"></button>
                    </div>
                    <!-- modal-body -->
                    <div class="modal-body container text-center">
                        <div style="text-align: left;">
                            <label for="searchDashboardQuery">Cari Dashboard</label>
                        </div>
                        <div wire:loading>
                            <h5>
                                Loading...
                            </h5>
                        </div>
                        <div class="form-search">
                            <i class="ri-search-line"></i>
                            <input type="text" class="form-control" id="searchDashboardQuery"
                                   wire:model.live="searchDashboardQuery" wire:keydown="searchDashboard"
                                   placeholder="Masukkan nama dashboard atau cluster">
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pilih</th>
                                <th scope="col">Dashboard</th>
                                <th scope="col">Cluster</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allDashboards as $dashboard)
                                <tr wire:key="{{ $dashboard->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if(!is_null($selectedDashboards) and $selectedDashboards->contains($dashboard))
                                            <button class="btn btn-outline-success"
                                                    wire:click="deselectDashboard({{ $dashboard->id }})">
                                                <i class="ri-check-fill"></i>
                                                Batalkan Pilih Dashboard
                                            </button>
                                        @else
                                            <button class="btn btn-outline-secondary"
                                                    wire:click="selectDashboard({{ $dashboard->id }})">
                                                <i class="ri-add-fill"></i>
                                                Pilih Dashboard
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{ $dashboard->name }}</td>
                                    <td>{{ $dashboard->cluster->name }}</td>
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
                        <button class="btn btn-primary"
                                wire:click="editPermissions">
                            Ubah Perizinan
                        </button>
                    </div>
                </div>
            </div>
    </div>
</div>
