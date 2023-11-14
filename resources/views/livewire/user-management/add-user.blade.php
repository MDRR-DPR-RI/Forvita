<div>
{{--    Modal Add User--}}
    <div class="modal d-block" tabindex="-1" aria-hidden="true">
        <form wire:submit="addUser">
            <div class="modal-dialog">
                <!-- modal-content -->
                <div class="modal-content">
                    <!-- modal-header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Tambahkan Pengguna</h5>
                        <button type="button" class="btn-close" wire:click="$dispatch('closeModal')" aria-label="Close"></button>
                    </div>
                    <!-- modal-body -->
                    <div class="modal-body container text-center">
                        <div class="form-group" style="text-align: left;">
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name"
                                   wire:model.blur="name" class="form-control" required>
                            <div>@error('name') {{ $message }} @enderror</div>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email"
                                   wire:model.blur="email" class="form-control" required>
                            <div>@error('email') {{ $message }} @enderror</div>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label for="roleID">Role</label>

                            <div class="input-group width-150px">
                                <select wire:model="roleID" name="roleID" id="roleID" class="form-select" aria-label="Default select example">
                                    <option selected>Pilih Role Pengguna</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>@error('roleID') {{ $message }} @enderror</div>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label for="password">Masukkan Kata Sandi</label>
                            <input wire:model.blur="password"
                                   type="password" id="password" name="password" class="form-control">
                            <div>@error('password') {{ $message }} @enderror</div>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label for="resubmitPassword">Masukkan Kata Sandi Kembali</label>
                            <input wire:model.blur="resubmitPassword"
                                   type="password" id="resubmitPassword" name="resubmitPassword" class="form-control">
                            <div>@error('resubmitPassword') {{ $message }} @enderror</div>
                        </div>
                    </div>
                    <!-- modal-footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$dispatch('closeModal')">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambahkan Pengguna</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
