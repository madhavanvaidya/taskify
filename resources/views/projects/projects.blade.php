@extends('layout')
@section('content')
<div class="container">
    <div class="mt-4 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-0">
                Projects <span class="text-muted fw-light"> /</span>
            </h4>
        </div>
        <a href="{{url('/projects/create')}}"><button type="button" class="btn btn-sm btn-primary">Create new Project</button></a>
    </div>
</div>
<x-projects-card :projects="$projects" />



@endsection