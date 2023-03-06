@extends('layout')

@section('title')
<?php echo "New Project" ?>
@endsection

@section('content')
<div class="container">
    <div class="mt-4">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Projects /</span> Create new Project
        </h4>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <form action="{{url('/projects/store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input class="form-control" type="text" id="title" name="title" placeholder="Enter Title">
                    </div>

                    @error('title')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="status_id">Status</label>
                        <div class="input-group">
                            <select class="form-select" id="status_id" name="status_id">
                                @foreach($statuses as $status)
                                <option value="{{$status->id}}">{{$status->title}} ({{$status->color}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div><a href="/status/create">+ Create new status</a></div>
                    </div>

                    @error('status_id')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div class="mb-3 col-md-6">
                        <label for="budget" class="form-label">Budget</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">&#x20B9;</span>
                            <input class="form-control" type="text" id="budget" name="budget" placeholder="Enter Budget">
                        </div>
                    </div>

                    @error('budget')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="start_date">Start Date</label>
                        <div class="input-group input-group-merge">
                            <input type="date" id="start_date" name="start_date" class="form-control">
                        </div>
                    </div>

                    @error('start_date')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="end_date">End Date</label>
                        <div class="input-group input-group-merge">
                            <input type="date" id="end_date" name="end_date" class="form-control">
                        </div>
                    </div>

                    @error('end_date')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <div class="row">

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
                    </div>

                    @error('description')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="user_id">Select Users</label>
                        <div class="input-group">
                            <select id="" class="form-control js-example-basic-multiple" name="user_id[]" multiple="multiple">
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @error('user_id')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="client_id">Select Clients</label>
                        <div class="input-group">

                            <select id="" class="form-control js-example-basic-multiple" name="client_id[]" multiple="multiple">
                                @foreach ($clients as $client)
                                <option value="{{$client->id}}">{{$client->first_name}} {{$client->last_name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    @error('client_id')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2" id="showToastPlacement">Save Project</button>
                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection