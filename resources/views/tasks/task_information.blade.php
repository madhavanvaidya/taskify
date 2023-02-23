@extends('layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div>
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">{{$task->title}} /</span> Details
        </h4>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card mb-4">


                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-2">

                        <h2 class="card-header fw-bold">{{ $task->title }}</h2>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">


                    <div class="row">

                        <div class="mb-3 col-md-6">

                            <label class="form-label" for="start_date">Users</label>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <?php
                                $users = $task->users;
                                ?>
                                @foreach ($users as $user)
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-lg pull-up mx-1" title="{{$user->first_name}} {{$user->last_name}}">
                                    <img src="{{asset('storage/' . $user->photo)}}" alt="Avatar" class="rounded-circle" />
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="row">

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="project">project</label>
                            <div class="input-group input-group-merge">
                                @php
                                $project = $task->project;
                                @endphp
                                <input class="form-control px-2" type="text" id="project" placeholder="" value="{{$project->title}}" readonly="">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <div class="input-group input-group-merge">
                                <textarea class="form-control" id="description" name="description" rows="5" readonly>{{ $task->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="start_date">Start Date</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="start_date" name="start_date" class="form-control" placeholder="" value="{{$task->start_date}}" readonly />
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="due-date">Due Date</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="due_date" name="due_date" placeholder="" value="{{$task->due_date}}" readonly="">
                            </div>
                        </div>



                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">Status</label>
                            <div class="input-group input-group-merge">
                                <span class='badge bg-label-{{config("taskhub.task_status_labels")[$task->status]}} me-1'> {{$task->status}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection