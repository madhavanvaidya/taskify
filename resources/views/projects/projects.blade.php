@extends('layout')

@section('title')
<?php echo "Projects - List View" ?>
@endsection

@section('content')
<div class="container">
    <div class="mt-4 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Projects /</span> List View
            </h4>
        </div>
        <div>
            <a href="{{url('/projects/create')}}"><button type="button" class="btn btn-sm btn-primary">Create new Project</button></a>
            <a href="{{url('/projects')}}"><button type="button" class="btn btn-sm btn-primary"><i class='bx bxs-grid-alt'></i> Grid View</button></a>
            <a href="{{url('/projects/list')}}"><button type="button" class="btn btn-sm btn-primary"><i class='bx bx-list-ul'></i> List View</button></a>
        </div>
    </div>
</div>
<x-projects-card :projects="$projects" />
@endsection