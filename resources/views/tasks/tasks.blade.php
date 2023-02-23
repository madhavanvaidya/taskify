@extends('layout')
@section('content')
<div class="container">
    <div class="align-items-center d-flex justify-content-between mt-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Tasks /</span> List View
            </h4>
        </div>
        <div class="">
            <a href="{{url('/tasks/kanban')}}"><button type="button" class="btn btn-sm btn-primary"><i class="bx bxs-dashboard"></i> Board View</button></a>
            <a href="{{url('/tasks')}}"><button type="button" class="btn btn-sm btn-primary"><i class="bx bx-list-ul"></i> List View</button></a>
        </div>
    </div>
</div>
<x-tasks-card :tasks="$tasks" />
@endsection