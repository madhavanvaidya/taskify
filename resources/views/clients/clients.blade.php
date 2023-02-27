@extends('layout')

@section('title')
<?php echo "Clients" ?>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div >
            <h4 class="fw-bold mb-0">
                Clients <span class="text-muted fw-light"> /</span>
            </h4>
        </div>
        <a href="{{url('/clients/create')}}"><button type="button" class="btn btn-sm btn-primary">Create new Client</button></a>
    </div>
</div>
<div class="card m-4">
    <div class="table-responsive text-nowrap">
        <div class="mx-2 mb-2">
            <table id="table" data-toggle="table" data-loading-template="loadingTemplate" data-url="/clients/list" data-icons-prefix="bx" data-icons="icons" data-show-refresh="true" data-total-field="total" data-data-field="rows" data-page-list="[2, 4, 10, All]" data-search="true" data-pagination-side="server" data-pagination="true">
                <thead>

                    <tr>
                        <th data-formatter="nameFormatter" data-sortable="true" data-field="first_name">Full Name</th>
                        <th data-field="company" data-sortable="true">Company</th>
                        <th data-field="email" data-sortable="true">Email</th>
                        <th data-field="phone" data-sortable="true">Phone</th>
                        <th data-field="profile">Profile</th>
                        <th data-formatter="actionFormatter">Actions</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>

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
            '<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#smallModal">' +
            '<i class="bx bx-trash mx-1"></i>' +
            '</button>' +


            '<div class="modal fade" id="smallModal" tabindex="-1" style="display: none;" aria-hidden="true">' +
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
            '<a href="/clients/destroy/' + row.id + '">' +
            '<button type="submit" class="btn btn-primary">Yes</button>' +
            '</a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        ]
    }

    function nameFormatter(value, row, index) {
        return [row.first_name, row.last_name].join(' ')
    }
</script>

@endsection