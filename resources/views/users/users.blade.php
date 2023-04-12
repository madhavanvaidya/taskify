@extends('layout')

@section('title')
<?php echo "Users" ?>
@endsection

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold mb-0">
            Users <span class="text-muted fw-light">/</span>
        </h4>
        <a href="{{url('/users/create_user')}}"><button type="button" class="btn btn-sm btn-primary">Create new User</button></a>
    </div>

    <div class="card my-4">
        <div class="table-responsive text-nowrap">
            <div class="mx-2 mb-2">
                <table id="table" data-toggle="table" data-loading-template="loadingTemplate" data-url="/users/list" data-icons-prefix="bx" data-icons="icons" data-show-refresh="true" data-total-field="total" data-data-field="rows" data-page-list="[2, 4, 10, All]" data-search="true" data-pagination-side="server" data-pagination="true">
                    <thead>

                        <tr>
                            <th data-formatter="userFormatter" data-sortable="true" data-field="first_name">User</th>
                            <th data-field="role" data-sortable="true">Role</th>
                            <th data-field="phone" data-sortable="true">Phone</th>
                            <th data-formatter="assignedFormatter">Assigned</th>
                            <th data-formatter="actionFormatter">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    window.icons = {
        refresh: 'bx-refresh',
        toggleOff: 'bx-toggle-left',
        toggleOn: 'bx-toggle-right'
    }

    function loadingTemplate(message) {
        return '<i class="bx bx-loader-alt bx-spin bx-flip-vertical" ></i>'
    }

    function userFormatter(value, row, index) {
        return '<div class="d-flex">' + row.photo + '<div class="mx-2 mt-2"><h6 class="mb-0">' + row.first_name + ' ' + row.last_name + '</h6><p class="text-muted">' + row.email + '</p></div>' +
            '</div>'
    }

    function assignedFormatter(value, row, index) {
        return '<div class="d-flex justify-content-start align-items-center"><div class="text-center mx-4"><span class="badge rounded-pill bg-primary" >' + row.projects + '</span><div>Projects</div></div>' +
            '<div class="text-center"><span class="badge rounded-pill bg-primary" >' + row.tasks + '</span><div>Tasks</div></div></div>'
    }

    function actionFormatter(value, row, index) {
        return [
            '<a href="/users/edit/' + row.id + '">' +
            '<i class="bx bx-edit-alt mx-1">' +
            '</i>' +
            '</a>' +
            '<button type="button" class="btn" id="delete-user" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' + row.id + '">' +
            '<i class="bx bx-trash mx-1"></i>' +
            '</button>' +


            '<div class="modal fade" id="deleteModal" tabindex="-1" style="display: none;" aria-hidden="true">' +
            '<div class="modal-dialog modal-sm" role="document">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<h5 class="modal-title" id="exampleModalLabel2">Warning!</h5>' +
            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">' + '</button>' +
            '</div>' +
            '<div class="modal-body">' +
            '<p>Are you sure you want to delete this user?</p>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">' +
            'Close' +
            '</button>' +
            '<button type="submit" class="btn btn-primary" id="confirmDelete">Yes</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        ]
    }

    $(document).on('click', '#delete-user', function() {
        var id = $(this).data('id');
        $('#deleteModal').modal('show'); // show the confirmation modal
        $('#deleteModal').on('click', '#confirmDelete', function() {
            $.ajax({
                url: '/users/delete_user/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    toastr.warning(response.message); // show a success message
                    // hide the modal
                    setTimeout(function() {
                        location.reload(); // reload the page after a delay
                    }, 2000);
                },
                error: function(response) {
                    $('#deleteModal').modal('hide');
                    toastr.error("You are not authorised!"); // show a success message
                    // hide the modal
                    setTimeout(function() {
                        location.reload(); // reload the page after a delay
                    }, 2000);
                }
            });
        });
    });
</script>

@endsection