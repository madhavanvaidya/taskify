@extends('layout')
@section('content')
<div class="mt-4">
    <a href="/tasks/create" class="mx-4"><button type="button" class="btn btn-sm btn-primary">Create new Task</button></a>
</div>
<x-tasks-card :projects="$projects" :users="$users" :tasks="$tasks" :clients="$clients"/>
@endsection