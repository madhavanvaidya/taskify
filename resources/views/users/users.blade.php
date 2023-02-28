@extends('layout')

@section('title')
<?php echo "Users" ?>
@endsection

@section('content')
<div class="container mt-4">
    <div>
        <h4 class="fw-bold mb-0">
        Users <span class="text-muted fw-light">/</span>
        </h4>
    </div>
</div>
<div class="card mx-4 my-4">
    <div class="table-responsive text-nowrap">
        <div class="mx-2 mb-2">
            <table id="table" data-toggle="table" data-loading-template="loadingTemplate" data-url="/users/list" data-icons-prefix="bx" data-icons="icons" data-show-refresh="true" data-total-field="total" data-data-field="rows" data-page-list="[2, 4, 10, All]" data-search="true" data-pagination-side="server" data-pagination="true">
                <thead>

                    <tr>
                        <th data-formatter="userFormatter" data-sortable="true" data-field="first_name">User</th>
                        <th data-field="role" data-sortable="true">Role</th>
                        <th data-field="phone" data-sortable="true">Phone</th>
                        <th data-formatter="assignedFormatter">Assigned</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

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
        return '<div class="d-flex">'+row.photo+'<div class="mx-2 mt-2"><h6 class="mb-0">'+row.first_name+' '+row.last_name+'</h6><p class="text-muted">'+row.email+'</p></div>'+
        '</div>'
    }

    function assignedFormatter(value, row, index) {
        return '<div class="d-flex justify-content-start align-items-center"><div class="text-center mx-4"><span class="badge rounded-pill bg-primary" >'+row.projects+'</span><p>Projects</p></div>'+
        '<div class="text-center"><span class="badge rounded-pill bg-primary" >'+row.tasks+'</span><p>Tasks</p></div></div>'
    }
</script>

@endsection