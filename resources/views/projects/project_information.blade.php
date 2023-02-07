@extends('layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Project Details</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-header fw-bold">{{ $project->title }}</h2>
                </div>
                <hr class="my-0" />
                <div class="card-body">


                    <div class="row">

                        <div class="mb-3 col-md-6">

                            <label class="form-label" for="start_date">Users</label>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <?php
                                $users = $project->users;
                                $clients = $project->clients;
                                ?>
                                @foreach($users as $user)

                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-lg pull-up mx-1" title="{{$user->first_name}} {{$user->last_name}}">
                                    <img src="{{asset('storage/' . $user->photo)}}" alt="Avatar" class="rounded-circle" />
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="end_date">Clients</label>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">

                                @foreach($clients as $client)

                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-lg pull-up mx-1" title="{{$client->first_name}} {{$client->last_name}}">
                                    <img src="{{asset('storage/' . $client->profile)}}" alt="Avatar" class="rounded-circle" />
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="row">

                        <div class="row">

                            <div class="mb-3">
                                <label class="form-label" for="description">Description</label>
                                <div class="input-group input-group-merge">
                                    <textarea class="form-control" id="description" name="description" rows="5" readonly>{{ $project->description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="start_date">Start Date</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="start_date" name="start_date" class="form-control" placeholder="" value="{{$project->start_date}}" readonly />
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="end_date">End Date</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="text" id="end_date" name="end_date" placeholder="" value="{{$project->end_date}}" readonly="">
                                </div>
                            </div>



                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="status">Status</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="text" id="status" placeholder="" value="{{$project->status}}" readonly="">
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="budget">Budget</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">&#x20B9;</span>
                                    <input class="form-control px-2" type="text" id="budget" placeholder="" value="{{$project->budget}}" readonly="">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <a href="/tasks/create/{{$project->id}}" class="mx-4"><button type="button" class="btn btn-sm btn-primary">Create new Task</button></a>
</div>


<!-- tasks -->
<div class="card mx-4 my-4">
    <div class="table-responsive text-nowrap">
        <h4 class="fw-bold mx-4 mt-4">All Tasks</h4>
        <div class="mx-2 mb-2">
        <table id="table" data-toggle="table" data-loading-template="loadingTemplate" data-url="/projects/task_list/{{$project->id}}" data-icons-prefix="bx" data-icons="icons" data-show-refresh="true" data-total-field="total" data-data-field="rows" data-page-list="[2, 4, 10, All]" data-search="true" data-pagination-side="server" data-pagination="true">
                <thead>
                    <tr>
                        <th data-sortable="true" data-field="title">Task</th>
                        <th data-sortable="true" data-field="project">Project</th>
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
            '<a href="/tasks/edit/'+row.id+'">'+
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
                                            '<p>Are you sure you want to delete this task?</p>'+
                                        '</div>'+
                                        '<div class="modal-footer">'+
                                            '<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">'+
                                                'Close'+
                                            '</button>'+
                                            '<a href="/tasks/destroy/'+row.id+'">'+
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

<!-- / tasks -->



@endsection