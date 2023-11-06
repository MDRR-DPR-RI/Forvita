<div>
{{--    Modal Add User--}}
    <div class="modal d-block" tabindex="-1" aria-hidden="true">
        <form wire:submit="addUser">
            <div class="modal-dialog">
                <!-- modal-content -->
                <div class="modal-content">
                    <!-- modal-header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="btn-close" wire:click="$dispatch('closeModal')" aria-label="Close"></button>
                    </div>
                    <!-- modal-body -->
                    <div class="modal-body container text-center">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name"
                                   wire:model.blur="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email"
                                   wire:model.blur="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="databaseDriver">Role</label>
                            <div class="input-group width-150px">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="databaseHost">Database Host</label>
                            <input type="text" id="databaseHost" name="databaseHost" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="databasePort">Database Port</label>
                            <input type="text" id="databasePort" name="databasePort" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="databaseDatabase">Database Database</label>
                            <input type="text" id="databaseDatabase" name="databaseDatabase" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="databaseUsername">Database Username</label>
                            <input type="text" id="databaseUsername" name="databaseUsername" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="databasePassword">Database Password</label>
                            <input type="password" id="databasePassword" name="databasePassword" class="form-control">
                        </div>
                    </div>
                    <!-- modal-footer -->
                    <div id="databaseModalFooter" class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button data-action="add" id="databaseModalSubmitButton" type="submit" class="btn btn-primary">Add Database</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
