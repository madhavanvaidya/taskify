@extends('layout')

@section('title')
<?php echo "Create - Todo" ?>
@endsection

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">{{auth()->user()->first_name}}'s Todo List /</span>Add Todo
        </h4>
        <div>
            <a href="{{url('/todos')}}"><button type="button" class="btn btn-sm btn-primary">Back</button></a>
        </div>
    </div>


    <div class="card mt-4">
        <div class="card-body">
            <form action="{{url('/todos/store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="title" class="form-label">Title</label>
                        <input class="form-control" type="text" id="title" name="title" placeholder="Enter Title">
                    </div>

                    @error('title')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="priority">Priority</label>
                        <div class="input-group">
                            <select class="form-select" id="priority" name="priority">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>

                    @error('priority')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
                    </div>

                    @error('description')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2" id="showToastPlacement">Save Todo</button>
                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection