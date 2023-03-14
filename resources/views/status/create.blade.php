@extends('layout')

@section('title')
<?php echo "Create - Status" ?>
@endsection

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Status / </span>Create New Status
        </h4>
    </div>


    <div class="card mt-4">
        <div class="card-body">
            <form action="{{url('/status/store')}}" method="POST">
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
                        <label class="form-label" for="color">Color</label>
                        <div class="input-group">
                            <select class="form-select" id="color" name="color">
                                <option class="badge bg-label-primary" value="primary"><p>Primary</p></option>
                                <option class="badge bg-label-secondary" value="secondary">secondary</option>
                                <option class="badge bg-label-success" value="success">Success</option>
                                <option class="badge bg-label-danger" value="danger">Danger</option>
                                <option class="badge bg-label-warning" value="warning">Warning</option>
                                <option class="badge bg-label-info" value="info">Info</option>
                                <option class="badge bg-label-dark" value="dark">Dark</option>
                            </select>
                        </div>
                    </div>

                    @error('color')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2" id="showToastPlacement">Save Status</button>
                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection