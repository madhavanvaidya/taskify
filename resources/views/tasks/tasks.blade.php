@extends('layout')
@section('content')
<div class="mt-4">
    <a href="/tasks/kanban" class="mx-4"><button type="button" class="btn btn-sm btn-primary"><i class='bx bxs-dashboard'></i> Board View</button></a>
    <a href="/tasks"><button type="button" class="btn btn-sm btn-primary"><i class='bx bx-list-ul'></i> List View</button></a>
</div>
<x-tasks-card :tasks="$tasks"/>
@endsection