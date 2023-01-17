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
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-lg pull-up mx-1" title="{{$user->first_name}} {{$user->last_name}}">
                                    <img src="{{asset('storage/' . $user->photo)}}" alt="Avatar" class="rounded-circle" />
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="end_date">Clients</label>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                @php
                                $cid = explode(',', $project->client_id)
                                @endphp
                                @foreach($cid as $id)
                                @php
                                $clients = "App\Models\Client";
                                $client = $clients::find($id);
                                @endphp
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

    <div class="card">
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
</div>
@endsection