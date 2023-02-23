@extends('layout')
@section('content')
<div class="container">
    <div class="align-items-center d-flex justify-content-between my-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Tasks /</span> Board View
            </h4>
        </div>
        <div class="">
            <a href="{{url('/tasks/kanban')}}"><button type="button" class="btn btn-sm btn-primary"><i class="bx bxs-dashboard"></i> Board View</button></a>
            <a href="{{url('/tasks')}}"><button type="button" class="btn btn-sm btn-primary"><i class="bx bx-list-ul"></i> List View</button></a>
        </div>
    </div>
    <div class="d-flex card flex-row" style="overflow-x: scroll; overflow-y:hidden">
        <div class="my-4" style="background-color: none ; min-width: 300px; max-width: 300px;">
            <h4 class="fw-bold mx-4 my-2">Started</h4>
            <div class="row m-2 d-flex flex-column" id="started" style="height: 100%" data-status="started">
                @foreach ($tasks as $task)
                @if($task->status=='started')
                <x-kanban :task="$task" />
                @endif
                @endforeach
            </div>
        </div>

        <div class="my-4 " style="background-color: none ; min-width: 300px; max-width: 300px;">
            <h4 class="fw-bold mx-4 my-2">Completed</h4>
            <div class="row m-2 d-flex flex-column" id="completed" style="height: 100%" data-status="completed">
                @foreach ($tasks as $task)
                @if($task->status=='completed')
                <x-kanban :task="$task" />
                @endif
                @endforeach
            </div>
        </div>

        <div class="my-4" style="background-color: none ; min-width: 300px; max-width: 300px;">
            <h4 class="fw-bold mx-4 my-2">Cancelled</h4>
            <div class="row m-2 d-flex flex-column" id="cancelled" style="height: 100%" data-status="cancelled">
                @foreach ($tasks as $task)
                @if($task->status=='cancelled')
                <x-kanban :task="$task" />
                @endif
                @endforeach
            </div>
        </div>

        <div class="my-4" style="background-color: none ; min-width: 300px; max-width: 300px;">
            <h4 class="fw-bold mx-4 my-2">On Hold</h4>
            <div class="row m-2 d-flex flex-column" id="onhold" style="height: 100%" data-status="onhold">
                @foreach ($tasks as $task)
                @if($task->status=='onhold')
                <x-kanban :task="$task" />
                @endif
                @endforeach
            </div>
        </div>

        <div class="my-4" style="background-color: none ; min-width: 300px; max-width: 300px;">
            <h4 class="fw-bold mx-4 my-2">Ongoing</h4>
            <div class="row m-2 d-flex flex-column" id="ongoing" style="height: 100%" data-status="ongoing">
                @foreach ($tasks as $task)
                @if($task->status=='ongoing')
                <x-kanban :task="$task" />
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function init() {
        dragula([document.getElementById("started"), document.getElementById("completed"), document.getElementById("cancelled"), document.getElementById("onhold"), document.getElementById("ongoing")], {
                revertOnSpill: true
            })
            .on('drop', function(el, target, source) {
                // Get the task ID and new status
                var taskId = el.getAttribute('data-task-id');
                var newStatus = target.getAttribute('data-status');

                // Make an AJAX call to update the task status
                $.ajax({
                    method: "PUT",
                    url: "/tasks/" + taskId + "/update-status/" + newStatus,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // If the AJAX request is successful, refresh the page
                        location.reload();
                    }
                });
            });
    }
</script>