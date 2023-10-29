<div>
{{--    Show selected users--}}
    @if(!is_null($selectedUsers) and !$selectedUsers->isEmpty())
        <div class="row row-cols-md-auto">
            <div class="col">
                <h3>Selected Users</h3>
            </div>
           <div class="col">
               <button class="btn btn-outline-primary">
                   Edit Selected Users Permissions
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

    <label for="searchUserQuery">Search users</label>
    <div class="form-search">
        <i class="ri-search-line"></i>
        <input type="text" class="form-control" id="searchUserQuery"
               wire:model.live="searchUserQuery" wire:keydown="searchUser"
               placeholder="Enter name or email">
    </div>
    <div wire:loading>
        Loading...
    </div>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Select</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
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
                                    Deselect User
                                </button>
                            @else
                                <button class="btn btn-outline-secondary"
                                        wire:click="selectUser({{ $user->id }})">
                                    <i class="ri-add-fill"></i>
                                    Select User
                                </button>
                            @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>
                                <button type="submit" class="btn btn-danger"
                                        wire:click="deleteUser({{ $user->id }})"
                                        wire:confirm="Are you sure you want to delete this user?">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr x-data="{ showPermissions{{$user->id}}: false }">
                            <td colspan="3">
                                <button class="btn btn-outline-primary">
                                    Edit Permissions
                                </button>
                                <button x-show="! showPermissions{{$user->id}}"
                                        x-on:click="showPermissions{{$user->id}} = ! showPermissions{{$user->id}}"
                                        class="btn btn-outline-primary">Show Permissions</button>
                                <button x-show="showPermissions{{$user->id}}"
                                        x-on:click="showPermissions{{$user->id}} = ! showPermissions{{$user->id}}"
                                        class="btn btn-outline-danger">Hide Permissions</button>
                                <div x-show="showPermissions{{$user->id}}">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Dashboard</th>
                                            <th scope="col">Cluster</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->permission as $permission)
                                            <tr wire:key="{{ $permission->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $permission->dashboard->name }}</td>
                                                <td>{{ $permission->dashboard->cluster->name }}</td>
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
    {{--Edit User Permissions Modal--}}
{{--    <div class="modal fade"--}}
{{--         id="editPermissionsModal"--}}
{{--         style="display: block;"--}}
{{--         tabindex="-1" aria-hidden="true">--}}
{{--        <form wire:submit="editPermissions">--}}
{{--            <div class="modal-dialog">--}}
{{--                <!-- modal-content -->--}}
{{--                <div class="modal-content">--}}
{{--                    <!-- modal-header -->--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title">Edit (Name)'s Permissions</h5>--}}
{{--                        <button type="button" class="btn-close" aria-label="Close"></button>--}}
{{--                    </div>--}}
{{--                    <!-- modal-body -->--}}
{{--                    <div class="modal-body container text-center">--}}
{{--                        <input type="hidden" id="userID" name="userID">--}}
{{--                        <div class="form-search">--}}
{{--                            <i class="ri-search-line"></i>--}}
{{--                            <input type="text" class="form-control" id="searchDashboardQuery"--}}
{{--                                   wire:model.live="searchDashboardQuery" wire:keydown="searchDashboard"--}}
{{--                                   placeholder="Enter dashboard or cluster name">--}}
{{--                        </div>--}}
{{--                        <table class="table">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th scope="col">No</th>--}}
{{--                                <th scope="col">Select</th>--}}
{{--                                <th scope="col">Dashboard</th>--}}
{{--                                <th scope="col">Cluster</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($dashboards as $dashboard)--}}
{{--                                <tr wire:key="{{ $dashboard->id }}">--}}
{{--                                    <td>{{ $loop->iteration }}</td>--}}
{{--                                    <td>--}}
{{--                                        @if(!is_null($selectedDashboards) and $selectedDashboards->contains($dashboard))--}}
{{--                                            <button class="btn btn-outline-success"--}}
{{--                                                    wire:click="deselectDashboard({{ $dashboard->id }})">--}}
{{--                                                <i class="ri-check-fill"></i>--}}
{{--                                                Deselect Dashboard--}}
{{--                                            </button>--}}
{{--                                        @else--}}
{{--                                            <button class="btn btn-outline-secondary"--}}
{{--                                                    wire:click="selectDashboard({{ $dashboard->id }})">--}}
{{--                                                <i class="ri-add-fill"></i>--}}
{{--                                                Select Dashboard--}}
{{--                                            </button>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td>{{ $dashboard->name }}</td>--}}
{{--                                    <td>{{ $dashboard->cluster->name }}</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                    <!-- modal-footer -->--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-secondary">Close</button>--}}
{{--                        @method('patch')--}}
{{--                        @csrf--}}
{{--                        <button type="submit" class="btn btn-primary">Edit Scheduler</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
    <script>
        // document.addEventListener("DOMContentLoaded", (event) => {
        //     const editPermissionsModal = document.getElementById('editPermissionsModal')
        //     console.log(editPermissionsModal)
        //     editPermissionsModal.show()
        // });
    </script>

</div>