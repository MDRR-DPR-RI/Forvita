<div>
    <label for="searchUserQuery">Search users</label>
    <div class="form-search">
        <i class="ri-search-line"></i>
        <input type="text" class="form-control" id="searchUserQuery"
               wire:model.live="searchUserQuery" wire:keydown="searchUser"
               placeholder="Enter name or email">
    </div>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr wire:key="{{ $user->id }}">
                    <td rowspan="2">{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        @if($showPermissionsNumber !== $user->id)
                            <button wire:click="showPermissions({{$user->id}})"
                                    class="btn btn-outline-primary">Show Permissions</button>
                        @else
                            <button wire:click="hidePermissions({{$user->id}})"
                                    class="btn btn-outline-danger">Hide Permissions</button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>