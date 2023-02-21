@extends('layout')
@section('content')
<div class="mt-4">
    <a href="/tasks/kanban" class="mx-4"><button type="button" class="btn btn-sm btn-primary"><i class='bx bxs-dashboard'></i> Board View</button></a>
    <a href="/tasks"><button type="button" class="btn btn-sm btn-primary"><i class='bx bx-list-ul'></i> List View</button></a>
</div>
<div class="d-flex mx-2" style="overflow-x: scroll; overflow-y:hidden">
    <div class="my-4" style="background-color: none ; min-width: 300px; max-width: 300px;">
        <h4 class="fw-bold mx-4 my-2">Started</h4>
        <div class="row m-2 d-flex flex-column" id="started" style="height: 100%">
            @foreach ($tasks as $task)
            @if($task->status=='started')
            <x-kanban :task="$task" />
            @endif
            @endforeach
        </div>
    </div>

    <div class="my-4" style="background-color: none ; min-width: 300px; max-width: 300px;">
        <h4 class="fw-bold mx-4 my-2">Completed</h4>
        <div class="row m-2 d-flex flex-column" id="completed" style="height: 100%">
            @foreach ($tasks as $task)
            @if($task->status=='completed')
            <x-kanban :task="$task" />
            @endif
            @endforeach
        </div>
    </div>

    <div class="my-4" style="background-color: none ; min-width: 300px; max-width: 300px;">
        <h4 class="fw-bold mx-4 my-2">Cancelled</h4>
        <div class="row m-2 d-flex flex-column" id="cancelled" style="height: 100%">
            @foreach ($tasks as $task)
            @if($task->status=='cancelled')
            <x-kanban :task="$task" />
            @endif
            @endforeach
        </div>
    </div>

    <div class="my-4" style="background-color: none ; min-width: 300px; max-width: 300px;">
        <h4 class="fw-bold mx-4 my-2">On Hold</h4>
        <div class="row m-2 d-flex flex-column" id="onhold" style="height: 100%">
            @foreach ($tasks as $task)
            @if($task->status=='onhold')
            <x-kanban :task="$task" />
            @endif
            @endforeach
        </div>
    </div>

    <div class="my-4" style="background-color: none ; min-width: 300px; max-width: 300px;">
        <h4 class="fw-bold mx-4 my-2">Ongoing</h4>
        <div class="row m-2 d-flex flex-column" id="ongoing" style="height: 100%">
            @foreach ($tasks as $task)
            @if($task->status=='ongoing')
            <x-kanban :task="$task" />
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

<script>
    function init() {
        dragula([document.getElementById("started"), document.getElementById("completed"), document.getElementById("cancelled"), document.getElementById("onhold"), document.getElementById("ongoing")]);
    }
</script>