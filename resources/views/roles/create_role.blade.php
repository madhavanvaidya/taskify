@extends('layout')

@section('title')
<?php

use Spatie\Permission\Models\Permission;

 echo "Create - Role" ?>

use Spatie\Permission\Models\Permission;
@endsection

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <h4 class="fw-bold mb-0 text-capitalize">
            <span class="text-muted fw-light">Settings /</span> Create Role
        </h4>
        <div>
            <a href="{{url('/settings')}}"><button type="button" class="btn btn-sm btn-primary">Back</button></a>
        </div>
    </div>


    <div class="card mt-4">
        <div class="card-body">
            <form action="{{url('/roles/store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Enter Name">
                    </div>
                </div>

                @error('name')
                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror

                <hr class="mb-2" />

                <div class="table-responsive text-nowrap">
                    <table class="table my-2">
                        <thead>
                            <th>Module</th>
                            <th>Permissions</th>
                        </thead>
                        <tbody>
                        @foreach(config("taskhub.permissions") as $module => $permissions)
                            <tr>
                                <td>{{$module}}</td>
                                <td>
                                    <div class="d-flex flex-wrap justify-content-between">

                                        @foreach($permissions as $permission)
                                        <div class="form-check mx-4">
                                            <input type="checkbox" name="permissions[]" value="<?php print_r(Permission::findByName($permission)->id); ?>" class="form-check-input">
                                            <label class="form-check-label text-capitalize"><?php print_r(substr($permission, 0, strpos($permission, "_"))); ?></label>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2" id="showToastPlacement">Save Role</button>
                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection