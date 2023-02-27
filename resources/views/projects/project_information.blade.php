@extends('layout')

@section('title')
<?php echo $project->title." Information" ?>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-bold mb-0">
                    <span class="text-muted fw-light">{{$project->title}} /</span> Details
                </h4>
            </div>
            <div>
                <a href="{{url('/tasks/create/' . $project->id)}}"><button type="button" class="btn btn-sm btn-primary">Create new Task</button></a>
                <a href="{{url('/projects/tasks/list/' . $project->id)}}"><button type="button" class="btn btn-sm btn-primary">Tasks Details</button></a>
            </div>
        </div>
    <div class="row my-4">
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
@endsection