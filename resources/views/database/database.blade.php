@extends('dashboard.layouts.main')

@section('custom_vendor')
    <!-- Vendor CSS -->

@endsection
@parent

@section('page_content')
    <div class="main main-app p-3 p-lg-4">
        <h1> Databases </h1>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Url</th>
                    <th scope="col">Driver</th>
                    <th scope="col">Host</th>
                    <th scope="col">Port</th>
                    <th scope="col">Database</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($databases as $database)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $database->name }}</td>
                        <td>{{ $database->url }}</td>
                        <td>{{ $database->driver }}</td>
                        <td>{{ $database->host }}</td>
                        <td>{{ $database->port }}</td>
                        <td>{{ $database->database }}</td>
                        <td>{{ $database->username }}</td>
                        <td>{{ $database->password }}</td>
                        <td>
                            {{--Edit Database--}}
                            <a data-bs-toggle="modal" data-bs-target="#databaseModal"
                               data-action="edit"
                               data-bs-databaseID="{{ $database->id }}"
                               data-bs-databaseName="{{ $database->name }}"
                               data-bs-databaseUrl="{{ $database->url }}"
                               data-bs-databaseDriver="{{ $database->driver }}"
                               data-bs-databaseHost="{{ $database->host }}"
                               data-bs-databasePort="{{ $database->port }}"
                               data-bs-databaseDatabase="{{ $database->database }}"
                               data-bs-databaseUsername="{{ $database->username }}"
                               data-bs-databasePassword="{{ $database->password }}"
                               class="btn btn-primary">Edit</a>

                            {{--Delete Database--}}
                            <form action="/database" method="post">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="databaseID" value="{{ $database->id }}">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="8"></td>
                    <td colspan="2">
                        <a href="#databaseModal" class="btn btn-primary d-flex align-items-center gap-2"
                           data-bs-toggle="modal"><i class="ri-add-line"></i>
                            <span class="d-none d-sm-inline">Add Database</span></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        {{--Add/Edit Database Modal (Default ADD)--}}
        <div class="modal fade" id="databaseModal" tabindex="-1" aria-hidden="true">
            <form action="/database" method="post">
                <div class="modal-dialog">
                    <!-- modal-content -->
                    <div class="modal-content">
                        <!-- modal-header -->
                        <div class="modal-header">
                            <h5 id="databaseModalTitle" class="modal-title">Add Database</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- modal-body -->
                        <div class="modal-body container text-center">
                            <input type="hidden" id="databaseID" name="databaseID">
                            <div class="form-group">
                                <label for="databaseName">Database Name</label>
                                <input type="text" id="databaseName" name="databaseName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="databaseUrl">Database Url</label>
                                <input type="text" id="databaseUrl" name="databaseUrl" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="databaseDriver">Database Driver</label>
                                <div class="input-group width-150px">
                                    <input type="text" id="databaseDriver" name="databaseDriver" class="form-control"
                                           required>
                                    <div id="databaseDriverDropdown" class="btn-group">
                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" data-databaseDriver="sqlite" href="#">SQLite </a></li>
                                            <li><a class="dropdown-item" data-databaseDriver="mysql" href="#">MySQL/MariaDB</a></li>
                                            <li><a class="dropdown-item" data-databaseDriver="pgsql" href="#">PostgreSQL</a></li>
                                            <li><a class="dropdown-item" data-databaseDriver="sqlsrv" href="#">SQL Server</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="databaseHost">Database Host</label>
                                <input type="text" id="databaseHost" name="databaseHost" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="databasePort">Database Port</label>
                                <input type="text" id="databasePort" name="databasePort" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="databaseDatabase">Database Database</label>
                                <input type="text" id="databaseDatabase" name="databaseDatabase" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="databaseUsername">Database Username</label>
                                <input type="text" id="databaseUsername" name="databaseUsername" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="databasePassword">Database Password</label>
                                <input type="password" id="databasePassword" name="databasePassword" class="form-control" required>
                            </div>
                        </div>
                        <!-- modal-footer -->
                        <div id="databaseModalFooter" class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            @csrf
                            <button data-action="add" id="databaseModalSubmitButton" type="submit" class="btn btn-primary">Add Database</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // Scripts for database modal
            let databaseModal = document.getElementById('databaseModal')

            // Javascript for database driver input field with dropdown combo
            databaseModal.addEventListener('hide.bs.dropdown', event => {
                if (event.clickEvent) {
                    let clickedValue = event.clickEvent.target.getAttribute('data-databaseDriver')
                    let databaseDriverInput = databaseModal.querySelector('#databaseDriver')
                    databaseDriverInput.value = clickedValue
                }
            })

            // Javascript for clearing modal inputs when closing modal
            databaseModal.addEventListener('hidden.bs.modal', function() {
                let inputs = databaseModal.querySelectorAll('input')
                inputs.forEach(input => {
                    input.value = ''
                })
            })

            // Javascript for assigning add or edit database modal
            databaseModal.addEventListener('show.bs.modal', function (event) {
                let button = event.relatedTarget
                if(button.getAttribute('data-action') === 'add'){

                    let modalTitle = databaseModal.querySelector(".modal-title")
                    modalTitle.textContent = "Add Database"

                    let databaseModalFooter = databaseModal.querySelector('#databaseModalFooter')
                    databaseModalFooter.innerHTML = `
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        @csrf
                        <button id="databaseModalSubmitButton" type="submit" class="btn btn-primary">Add Database</button>
                        `
                    return
                }
                let databaseID = button.getAttribute('data-bs-databaseID')
                let databaseName = button.getAttribute('data-bs-databaseName')
                let databaseUrl = button.getAttribute('data-bs-databaseUrl')
                let databaseDriver = button.getAttribute('data-bs-databaseDriver')
                let databaseHost = button.getAttribute('data-bs-databaseHost')
                let databasePort = button.getAttribute('data-bs-databasePort')
                let databaseDatabase = button.getAttribute('data-bs-databaseDatabase')
                let databaseUsername = button.getAttribute('data-bs-databaseUsername')
                let databasePassword = button.getAttribute('data-bs-databasePassword')

                let modalTitle = databaseModal.querySelector(".modal-title")
                modalTitle.textContent = "Edit Database " + databaseName

                let databaseIdInput = databaseModal.querySelector("#databaseID")
                databaseIdInput.value = databaseID

                let databaseNameInput = databaseModal.querySelector('#databaseName')
                databaseNameInput.value = databaseName

                let databaseUrlInput = databaseModal.querySelector('#databaseUrl')
                databaseUrlInput.value = databaseUrl

                let databaseDriverInput = databaseModal.querySelector('#databaseDriver')
                databaseDriverInput.value = databaseDriver

                let databaseHostInput = databaseModal.querySelector('#databaseHost')
                databaseHostInput.value = databaseHost

                let databasePortInput = databaseModal.querySelector('#databasePort')
                databasePortInput.value = databasePort

                let databaseDatabaseInput = databaseModal.querySelector('#databaseDatabase')
                databaseDatabaseInput.value = databaseDatabase

                let databaseUsernameInput = databaseModal.querySelector('#databaseUsername')
                databaseUsernameInput.value = databaseUsername

                let databasePasswordInput = databaseModal.querySelector('#databasePassword')
                databasePasswordInput.value = databasePassword

                let databaseModalFooter = databaseModal.querySelector('#databaseModalFooter')
                databaseModalFooter.innerHTML = `
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @method('patch')
                @csrf
                <button id="databaseModalSubmitButton" type="submit" class="btn btn-primary">Edit Database</button>`
            })
        </script>
@endsection

@section('custom_script')

@endsection

