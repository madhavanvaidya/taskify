@extends('layout')

@section('title')
<?php echo "Clients" ?>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            <h4 class="fw-bold mb-0">
                Clients <span class="text-muted fw-light"> /</span>
            </h4>
        </div>
        <a href="{{url('/clients/create')}}"><button type="button" class="btn btn-sm btn-primary">Create new Client</button></a>
    </div>

    <div class="card mt-4">
        <div class="table-responsive text-nowrap">
            <div class="mx-2 mb-2">
                <table id="table" data-toggle="table" data-loading-template="loadingTemplate" data-url="/clients/list" data-icons-prefix="bx" data-icons="icons" data-show-refresh="true" data-total-field="total" data-data-field="rows" data-page-list="[2, 4, 10, All]" data-search="true" data-pagination-side="server" data-pagination="true">
                    <thead>

                        <tr>
                            <th data-formatter="clientFormatter" data-sortable="true">Clients</th>
                            <th data-field="company" data-sortable="true">Company</th>
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
        refresh: 'bx-refresh'
    }

    function loadingTemplate(message) {
        return '<i class="bx bx-loader-alt bx-spin bx-flip-vertical" ></i>'
    }

    function actionFormatter(value, row, index) {
        return [
            '<a href="/clients/edit/' + row.id + '">' +
            '<i class="bx bx-edit-alt mx-1">' +
            '</i>' +
            '</a>' +
            '<button type="button" class="btn" id="delete-client" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="'+ row.id +'">' +
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
            '<p>Are you sure you want to delete this client?</p>' +
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

    function nameFormatter(value, row, index) {
        return [row.first_name, row.last_name].join(' ')
    }

    function clientFormatter(value, row, index) {
        return '<div class="d-flex">' + row.profile + '<div class="mx-2 mt-2"><h6 class="mb-0">' + row.first_name + ' ' + row.last_name + '</h6><p class="text-muted">' + row.email + '</p></div>' +
            '</div>'
    }

    function assignedFormatter(value, row, index) {
        return '<div class="mx-4"><span class="badge rounded-pill bg-primary" style="width: 50%;">' + row.projects + '</span><div>Projects</div></div>'
    }

    $(document).on('click', '#delete-client', function() {
        var id = $(this).data('id');
        $('#deleteModal').modal('show'); // show the confirmation modal
        $('#deleteModal').on('click', '#confirmDelete', function() {
            $.ajax({
                url: '/clients/destroy/' + id,
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
                error: function() {
                    toastr.error('There was a problem deleting the client.');
                }
            });
        });
    });
</script>

@endsection