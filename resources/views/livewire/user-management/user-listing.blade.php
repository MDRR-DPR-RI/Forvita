<div>
{{--    Initialize livewire modals--}}
    @livewire('wire-elements-modal')
{{--    Show selected users--}}
    @if(!is_null($selectedUsers) and !$selectedUsers->isEmpty())
        <div class="row row-cols-md-auto">
            <div class="col">
                <h3>Pengguna yang Dipilih</h3>
            </div>
           <div class="col">
               <button wire:click="$dispatch('openModal', { component: 'user-management.edit-permissions',
                                 arguments: { selectedUsersID: {{json_encode($selectedUsers->pluck('id')->toArray())}}}})"
                       class="btn btn-outline-primary">
                   Ubah Perizinan Pengguna
               </button>
           </div>
        </div>
        <div id="selected-users-listing" class="row">
            <div class="col col-sm-8">
                <div class="row row-cols-4">
                    @foreach($selectedUsers as $user)
                        <div wire:key="{{ $user->id }}" id="userCard{{ $user->id }}"
                             wire:click="deselectUser({{ $user->id }})"
                             class="btn btn-outline-primary">
                            <div class="row-cols-md-auto">
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-8">
                                    <h6 style="text-align: left;">{{ $user->name }}</h6>
                                    <h6 style="text-align: left;">{{ $user->email }}</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col">
            </div>
        </div>
    @endif
{{--    Search Users--}}
    <label for="searchUserQuery">Cari Pengguna</label>
    <div class="form-search">
        <i class="ri-search-line"></i>
        <input type="text" class="form-control" id="searchUserQuery"
               wire:model.live="searchUserQuery" wire:keydown="searchUser"
               placeholder="Masukkan nama atau email">
    </div>
    <div wire:loading>
        Loading...
    </div>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col" colspan="5"></th>
                <th scope="col">
                    <button wire:click="$dispatch('openModal', { component: 'user-management.add-user'})"
                            class="btn btn-outline-primary">
                        Tambahkan Pengguna
                    </button>
                </th>
            </tr>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Pilih</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
                @foreach($users as $user)
                    <tbody wire:key="{{ $user->id }}">
                        <tr>
                            <td rowspan="2">{{ $loop->iteration }}</td>
                            <td>
                            @if(!is_null($selectedUsers) and $selectedUsers->contains('id', $user->id))
                                <button class="btn btn-outline-success"
                                        wire:click="deselectUser({{ $user->id }})">
                                    <i class="ri-check-fill"></i>
                                    Batalkan Pilih Pengguna
                                </button>
                            @else
                                <button class="btn btn-outline-secondary"
                                        wire:click="selectUser({{ $user->id }})">
                                    <i class="ri-add-fill"></i>
                                    Pilih Pengguna
                                </button>
                            @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>
                                <button wire:click="$dispatch('openModal',
                                                    { component: 'user-management.edit-user', arguments: { selectedUserID: {{$user->id}}}})"
                                        class="btn btn-outline-primary">
                                    Ubah
                                </button>
                                <button type="submit" class="btn btn-outline-danger"
                                        wire:click="deleteUser({{ $user->id }})"
                                        wire:confirm="Yakin ingin menghapus pengguna ini?">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        <tr x-data="{ showPermissions{{$user->id}}: false }">
                            <td colspan="3">
                                <button wire:click="$dispatch('openModal', { component: 'user-management.edit-permissions',
                                 arguments: { selectedUsersID: {{json_encode(array($user->id))}}}})"
                                        class="btn btn-outline-primary">
                                    Ubah Perizinan
                                </button>

                                <button x-show="! showPermissions{{$user->id}}"
                                        x-on:click="showPermissions{{$user->id}} = ! showPermissions{{$user->id}}"
                                        class="btn btn-outline-primary">Tampilkan Perizinan</button>
                                <button x-show="showPermissions{{$user->id}}"
                                        x-on:click="showPermissions{{$user->id}} = ! showPermissions{{$user->id}}"
                                        class="btn btn-outline-danger">Sembunyikan Perizinan</button>

                                <div x-show="showPermissions{{$user->id}}">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Dashboard</th>
                                            <th scope="col">Cluster</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->permission as $permission)
                                            <tr wire:key="{{ $permission->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $permission->dashboard->name }}</td>
                                                <td>{{ $permission->dashboard->cluster->name }}</td>
                                                <td>
                                                    <button type="submit" class="btn btn-outline-danger"
                                                            wire:click="deletePermission({{ $permission->id }})"
                                                            wire:confirm="Yakin ingin menghapus perizinan ini?">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
        </table>
    </div>
</div>