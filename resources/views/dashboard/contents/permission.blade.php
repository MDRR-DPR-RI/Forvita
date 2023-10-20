@extends('dashboard.layouts.main')

@section('custom_vendor')
<!-- Vendor CSS -->

@endsection
@parent

@section('page_content')
<div class="main main-app p-3 p-lg-4">
    <h3>Dashboard Permission for cluster "{{ session('cluster_name') }}"</h3>
    <div class="row">
        <div class="div">
            <div class="dropdown">
                <button class="btn btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    + GRANT ACCESS
                </button>  
                {{-- <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasEnd">+ GRANT ACCESS</a> --}}
                <div class="dropdown-menu shadow">
                    <div class="mb-3">
                        <label for="exampleDropdownFormEmail1" class="form-label">User Email</label>
                        <input type="email" class="form-control" id="userEmail" placeholder="email@example.com">
                    </div>
                    <div class="col d-flex justify-content-start">
                        <button href="#modalSelectUserDashboard" class="btn btn-primary" data-bs-toggle="modal" id="addUserEmail" id="addUserEmail">Add</button>
                        <a href="" class="btn btn-secondary" data-bs-dismiss="offcanvas" aria-label="Close">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Cluster</th>
                    <th scope="col">Dashboard Permission</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->email }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->user->role->name }}</td>
                    <td>{{ $item->dashboard->cluster->name }}</td>
                    <td>{{ $item->dashboard->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- modal select dashboard access --}}
    <form action="/dashboard/content/" method="post">
        @method('put')
        @csrf
        <input type="hidden" name="" id="">
        <div class="modal fade" id="modalSelectUserDashboard" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModal"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!-- modal-header -->
                <div class="modal-body" id="modalContent">
                    <div id="table-container" class="text-center">
                        <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>
                        </p>
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="text" name="userEmailModal" id="userEmailModal">
                    <button type="submit" class="btn btn-primary">Apply</button>
                </div><!-- modal-footer -->
                </div><!-- modal-content -->
            </div><!-- modal-content -->
        </div><!-- modal -->
    </form>


    @endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
     // Attach a click event listener to the "Update" button
        $('#addUserEmail').click(function () {
          var userEmail = $('#userEmail').val();
          $("#userEmailModal").val(userEmail); // fill the input hidden type to store in db
        //   var contentId = $('#contentId').val();  

            //Make an AJAX request to fetch data
            $.ajax({
                url: '/fetch-dashboard',
                method: 'post',
                data: {
                    userEmail: userEmail,
                    // contentId: contentId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data.dashboards);
                    $('#titleModal').text(`Select dashboard for ${userEmail}`);  

                    var tableHtml = '<table class="table">';
                    tableHtml += '<thead>';
                    tableHtml += '<tr>';
                    tableHtml += '<th scope="col">';
                    tableHtml += '<div class="form-check">';
                    tableHtml += '<input class="form-check-input" type="checkbox" id="selectAllCheckbox" ';

                    // Select all if all the checkbox was checked
                        if (data.dashboard_id.length == $(".checkbox-item").length && $(".checkbox-item:checked").length === $(".checkbox-item").length) {
                            tableHtml += 'checked';
                            console.log("checked all")
                        }
                    
                    tableHtml += '>';

                    tableHtml += '<label class="form-check-label" for="flexCheckDefault">';
                    tableHtml += 'Select All';
                    tableHtml += '</label>';
                    tableHtml += '</div>';
                    tableHtml += '</th>';
                    tableHtml += '<th scope="col">Dashboard Name</th>';
                    tableHtml += '<th scope="col">Cluster</th>';
                    tableHtml += '</tr>';
                    tableHtml += '</thead>';
                    tableHtml += '<tbody>';
                
                    // Iterate over the data and build table rows
                    data.dashboards.forEach(function (item, index) {
                        index += 1
                        tableHtml += '<tr class="table-row" data-judul="' + item.name + '">';
                        tableHtml += '<td scope="row">';
                        tableHtml += '<input class="form-check-input checkbox-item" type="checkbox" ';
                        tableHtml += 'value="' + item.name + '" id="item' + item.index + '" name="dashboard_name[]" ';
                        
                        // Check the box if the value is in db
                        if (data.dashboard_id.includes(item.id)) {
                            tableHtml += 'checked';
                            console.log("checked " + item.name)
                        }
                        
                        tableHtml += '>';
                        tableHtml += ' ' + index;
                        tableHtml += '</td>';
                        tableHtml += '<td>' + item.name + '</td>';
                        tableHtml += '<td>' + item.cluster.name + '</td>';
                        tableHtml += '</tr>';
                    });

                    tableHtml += '</tbody>';
                    tableHtml += '</table>';

                    // Update the table container with the dynamic table
                    $('#table-container').html(tableHtml);
                        // ccheck all
                    $("#selectAllCheckbox").click(function() {
                        $(".checkbox-item").prop('checked', $(this).prop('checked'));
                        console.log("all")
                    });
                        // Listen for changes on item checkboxes
                    $(".checkbox-item").on('change', function () {
                        // Check if all item checkboxes are checked
                        var allChecked = $(".checkbox-item:checked").length === $(".checkbox-item").length;

                        // Update the "Select All" checkbox accordingly
                        $("#selectAllCheckbox").prop('checked', allChecked);
                    });
                },
                error: function (error) {
                    $('#titleModal').text(``);  
                    $('#table-container').html("User not found");
                    console.log("not found");
                    console.error(error);
                }
            });
        });
    });
 
</script>