@props(['task'])
<div class="card m-2 shadow" data-task-id="{{$task->id}}">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h6 class="card-title"><a href="{{url('/tasks/information/' . $task->id)}}"><strong>{{$task->title}}</strong></a></h6>
            <div>
                <div class="input-group">
                    <a href="" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bxs-cog'></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="/tasks/edit/{{$task->id}}" class="card-link m-2"><i class='menu-icon tf-icons bx bxs-edit'></i> Edit Task</a></li>
                        <li class="dropdown-item"><a href="" class="card-link m-2" id="delete-task" data-bs-toggle="modal" data-bs-target="#smallModal" data-id="{{ $task->id }}">
                                <i class='menu-icon tf-icons bx bxs-trash'></i> Delete Task
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="modal fade" id="smallModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel2">Warning!</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this task?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger" id="confirmDelete">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-subtitle text-muted mb-3">{{$task->project->title}}</div>
        <p class="card-text">
            Users:
        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
            <?php
            $users = $task->users;
            $count = count($users);
            $displayed = 0;
            ?>
            @foreach($users as $user)
            @if($displayed < 3) <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up mx-1" title="{{$user->first_name}} {{$user->last_name}}">
                <img src="{{asset('storage/' . $user->photo)}}" alt="Avatar" class="rounded-circle" />
                </li>
                <?php $displayed++ ?>
                @else
                <?php
                $remaining = $count - $displayed;
                echo '+' . $remaining . '';
                break;
                ?>
                @endif
                @endforeach
        </ul>
        </p>
        <div class="d-flex justify-content-between">
            <div class="input-group input-group-merge">
                <span class='badge bg-label-{{config("taskhub.task_status_labels")[$task->status]}} me-1' id="status"> {{$task->status}}</span>
            </div>
            <small class="float-right" style="font-size: small; width: 120px">{{$task->due_date}}</small>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '#delete-task', function() {
        var id = $(this).data('id');
        $('#smallModal').modal('show'); // show the confirmation modal
        $('#smallModal').on('click', '#confirmDelete', function() {
            $.ajax({
                url: '/tasks/destroy/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#smallModal').modal('hide');
                    toastr.warning(response.message); // show a success message
                    // hide the modal
                    setTimeout(function() {
                        location.reload(); // reload the page after a delay
                    }, 2000);
                },
                error: function() {
                    toastr.error('There was a problem deleting the todo.');
                }
            });
        });
    });
</script>