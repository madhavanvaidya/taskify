@extends('layout')
@section('content')
<div class="mt-4">
    <a href="/projects/create" class="mx-4"><button type="button" class="btn btn-sm btn-primary">Create new Project</button></a>
</div>
<x-projects-card :projects="$projects" :users="$users" />



@endsection