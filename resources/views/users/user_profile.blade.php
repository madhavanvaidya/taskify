@extends('layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">User Details</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">

                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{$user->photo ? asset('storage/' . $user->photo) : asset('/photos/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                        <h4 class="card-header fw-bold">{{ $user->first_name }} {{$user->last_name}}</h4>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row">

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phone">Phone Number</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="" value="{{$user->phone}}" readonly />
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" value="{{$user->email}}" readonly="">
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="role">Role</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="role" placeholder="" value="{{$user->role}}" readonly="">
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="address">Address</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="address" placeholder="" value="{{$user->address}}" readonly="">
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="city">City</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="city" placeholder="" value="{{$user->city}}" readonly="">
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="state">State</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="state" placeholder="" value="{{$user->state}}" readonly="">
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="country">Country</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="country" placeholder="" value="{{$user->country}}" readonly="">
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="zip">Zip Code</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="zip" placeholder="" value="{{$user->zip}}" readonly="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- projects -->

<div class="card mx-4 my-4">
    <div class="table-responsive text-nowrap">

        <div class="d-flex justify-content-between">
            <h4 class="fw-bold mx-4 mt-4">All Projects</h4>
        </div>


        <div class="mx-2 mb-2">
        <table id="table" data-toggle="table" data-loading-template="loadingTemplate" data-url="/users/project_list/{{$user->id}}" data-icons-prefix="bx" data-icons="icons" data-show-refresh="true" data-total-field="total" data-data-field="rows" data-page-list="[2, 4, 10, All]" data-search="true" data-pagination-side="server" data-pagination="true">
                <thead>
                    <tr>
                        <th data-sortable="true" data-field="title">Title</th>
                        <th data-sortable="true" data-field="clients" data-formatter="clientFormatter">Clients</th>
                        <th data-sortable="true" data-field="users" data-formatter="userFormatter">Users</th>
                        <th data-sortable="true" data-field="status">Status</th>
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
            '<a href="/projects/edit/'+row.id+'">'+
            '<i class="bx bx-edit-alt mx-1">'+
            '</i>'+
            '</a>'+
            '<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#smallModal">'+
                                '<i class="bx bx-trash mx-1"></i>'+
                            '</button>'+


                            '<div class="modal fade" id="smallModal" tabindex="-1" style="display: none;" aria-hidden="true">'+
                                '<div class="modal-dialog modal-sm" role="document">'+
                                    '<div class="modal-content">'+
                                        '<div class="modal-header">'+
                                            '<h5 class="modal-title" id="exampleModalLabel2">Warning!</h5>'+
                                            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">'+'</button>'+
                                        '</div>'+
                                        '<div class="modal-body">'+
                                            '<p>Are you sure you want to delete this project?</p>'+
                                        '</div>'+
                                        '<div class="modal-footer">'+
                                            '<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">'+
                                                'Close'+
                                            '</button>'+
                                            '<a href="/projects/destroy/'+row.id+'">'+
                                                '<button type="submit" class="btn btn-primary">Yes</button>'+
                                            '</a>'+
                                        '</div>'+
                                    '</div>'+
                               '</div>'+
                            '</div>'
        ]
    }

    function clientFormatter(value, row, index) {
        return ['<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">'+row.clients]
    }

    function userFormatter(value, row, index) {
        return ['<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">'+row.users]
    }
</script>

<!-- / projects -->


<!-- tasks -->
<div class="card mx-4 my-4">
    <div class="table-responsive text-nowrap">
        <h4 class="fw-bold mx-4 mt-4">All Tasks</h4>
        <div class="mx-2 mb-2">
            <table id="table" data-toggle="table" data-query-params="queryParams" data-loading-template="loadingTemplate" data-url="/users/task_list/{{$user->id}}" data-icons-prefix="bx" data-icons="icons" data-show-refresh="true" data-total-field="total" data-data-field="rows" data-page-list="[2, 4, 10, All]" data-search="true" data-pagination-side="server" data-pagination="true">
                <thead>
                    <tr>
                        <th data-sortable="true" data-field="title">Task</th>
                        <th data-field="project">Project</th>
                        <th data-field="clients" data-formatter="clientFormatter">Clients</th>
                        <th data-field="users" data-formatter="userFormatter">Users</th>
                        <th data-sortable="true" data-field="status">Status</th>
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
            '<a href="/tasks/edit/' + row.id + '">' +
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
            '<p>Are you sure you want to delete this task?</p>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">' +
            'Close' +
            '</button>' +
            '<a href="/tasks/destroy/' + row.id + '">' +
            '<button type="submit" class="btn btn-primary">Yes</button>' +
            '</a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        ]
    }

    function clientFormatter(value, row, index) {
        return ['<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">' + row.clients]
    }

    function userFormatter(value, row, index) {
        return ['<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">' + row.users]
    }

    function queryParams(p) {
        return {
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
</script>

<!-- / tasks -->

@endsection