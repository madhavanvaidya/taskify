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

<div class="card mx-4">
    <div class="table-responsive text-nowrap">

        <div class="d-flex">
            <h4 class="fw-bold p-4">{{ $user->first_name }}'s Projects</h4>
        </div>

        @if (count($projects)==0)
        <h5 class="card-header">No Projects Found!</h5>
        @else

        <table class="table">
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Client</th>
                    <th>Users</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($projects as $project)
                <tr>

                    <td><a href="/projects/information/{{$project->id}}"><strong>{{$project->title}}</strong></a></td>
                    <td>
                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            @php
                            $cid = explode(',', $project->client_id)
                            @endphp
                            @foreach($cid as $id)
                            @php
                            $clients = "App\Models\Client";
                            $client = $clients::find($id);
                            @endphp
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" title="{{$client->first_name}} {{$client->last_name}}">
                                <img src="{{asset('storage/' . $client->profile)}}" alt="Avatar" class="rounded-circle" />
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            @php
                            $uid = explode(',', $project->user_id)
                            @endphp
                            @foreach($uid as $id)
                            @php
                            $users = "App\Models\User";
                            $user = $users::find($id);
                            if ($user==NULL){
                            continue;
                            }
                            @endphp
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" title="{{$user->first_name}} {{$user->last_name}}">
                                <img src="{{asset('storage/' . $user->photo)}}" alt="Avatar" class="rounded-circle" />
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <?php $project_status = config("taskhub.project_status_labels"); ?>
                    <td><span class="badge bg-label-{{$project_status[$project->status] ?? 'info'}} me-1">{{$project->status}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

<div class="card m-4">
    <div class="table-responsive text-nowrap">
        <h4 class="fw-bold m-4">All Tasks</h4>
        @if (count($tasks)==0)
        <h5 class="card-header">No tasks Found!</h5>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Project</th>
                    <th>Clients</th>
                    <th>Users</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($tasks as $task)
                <tr>

                    <td><a href="/tasks/information/{{$task->id}}"><strong>{{$task->title}}</strong></a></td>
                    <td>
                        @php
                        $id = $task->project_id;
                        $projects = "App\Models\Project";
                        $project = $projects::find($id);
                        @endphp
                        <strong>{{$project->title}}</strong>
                    </td>
                    <td>
                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            @php
                            $cid = explode(',', $project->client_id)
                            @endphp
                            @foreach($cid as $id)
                            @php
                            $clients = "App\Models\Client";
                            $client = $clients::find($id);
                            @endphp
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" title="{{$client->first_name}} {{$client->last_name}}">
                                <img src="{{asset('storage/' . $client->profile)}}" alt="Avatar" class="rounded-circle" />
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            @php
                            $uid = explode(',', $task->user_id)
                            @endphp
                            @foreach($uid as $id)
                            @php
                            $users = "App\Models\User";
                            $user = $users::find($id);
                            if ($user==NULL){
                            continue;
                            }
                            @endphp
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" title="{{$user->first_name}} {{$user->last_name}}">
                                <img src="{{asset('storage/' . $user->photo)}}" alt="Avatar" class="rounded-circle" />
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <?php $task_status = config("taskhub.task_status_labels"); ?>
                    <td><span class="badge bg-label-{{$task_status[$task->status] ?? 'info'}} me-1">{{$task->status}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

@endsection