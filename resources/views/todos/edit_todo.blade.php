@extends('layout')

@section('title')
<?php echo "Update " . $todo->title . " Information" ?>
@endsection

@section('content')
<div class="container">
    <div class="mt-4">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">{{$todo->title}} /</span> Update Todo Details
        </h4>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <form action="{{url('/todos/update/' . $todo->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="title" class="form-label">Title</label>
                        <input class="form-control" type="text" id="title" name="title" placeholder="Enter Title" value="{{ $todo->title }}">
                    </div>

                    @error('title')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror


                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="priority">Priority</label>
                        <div class="input-group">
                            <select class="form-select" id="priority" name="priority">
                                <option value="low" <?php if ($todo->priority == 'low') {
                                                        echo 'selected';
                                                    }  ?>>Low</option>
                                <option value="medium" <?php if ($todo->priority == 'medium') {
                                                            echo 'selected';
                                                        }  ?>>Medium</option>
                                <option value="high" <?php if ($todo->priority == 'high') {
                                                            echo 'selected';
                                                        }  ?>>High</option>
                            </select>
                        </div>
                    </div>
                </div>

                @error('priority')
                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter Description" style="height: 200px;">{{$todo->description}}</textarea>
                </div>

                @error('description')
                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror

                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2" id="showToastPlacement">Save Task</button>
                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection