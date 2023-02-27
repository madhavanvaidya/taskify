@extends('layout')

@section('title')
<?php echo "New Task" ?>
@endsection

@section('content')
<div class="container">
    <div class="mt-4">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">{{$project->title}} /</span> New Task
        </h4>
    </div>
</div>
<div class="card m-4">
    <div class="card-body">
        <form action="{{url('/tasks/store/' . $project->id)}}" method="POST">
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
                    <label class="form-label" for="status">Status</label>
                    <div class="input-group">
                        <select class="form-select" id="status" name="status">
                            <option value="ongoing">Ongoing</option>
                            <option value="onhold">On Hold</option>
                            <option value="started">Started</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">cancelled</option>
                        </select>
                    </div>
                </div>

                @error('status')
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
                    <label class="form-label" for="due_date">Due Date</label>
                    <div class="input-group input-group-merge">
                        <input type="date" id="due_date" name="due_date" class="form-control">
                    </div>
                </div>

                @error('due_date')
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
                            <?php
                            $users = $project->users;
                            ?>
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

            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2" id="showToastPlacement">Save Task</button>
                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
        </form>
    </div>
</div>


@endsection