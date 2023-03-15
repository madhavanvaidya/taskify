@extends('layout')

@section('title')
<?php echo "Todo List" ?>
@endsection

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <h4 class="fw-bold mb-0">
            {{auth()->user()->first_name}}'s Todo List <span class="text-muted fw-light">/</span>
        </h4>
        <div>
            <a href="{{url('/todos/create')}}"><button type="button" class="btn btn-sm btn-primary">Add new TODO</button></a>
        </div>
    </div>


    <div class="card mt-4">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Todo</th>
                        <th>Priority</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($todos as $todo)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div>
                                    <form method="POST" action="/todos/cross/{{$todo->id}}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="checkbox" name="completed" class="form-check-input mt-0" onchange="this.form.submit()" {{$todo->completed ? 'checked' : ''}}>
                                    </form>
                                </div>
                                <span class="mx-4">
                                    <h4 style="<?php ($todo->completed) ? print_r('text-decoration: line-through') : '' ?>" class="m-0">{{ $todo->title }}</h4>
                                    <h7 class="m-0 text-muted">{{$todo->created_at}}</h7>
                                </span>
                            </div>
                        </td>
                        <td>
                            <span class='badge bg-label-{{config("taskhub.priority_labels")[$todo->priority]}} me-1'>{{$todo->priority}}</span>
                        </td>
                        <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space:nowrap">
                            {{$todo->description}}
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{url('/todos/edit/' . $todo->id)}}" class="card-link m-2"><i class='bx bxs-edit'></i></a>


                                <button type="button" id="delete-todo" data-id="{{$todo->id}}" class="btn form-control" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class='bx bxs-trash'></i></button>

                            </div>
                            <!-- delete todo modal -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLabel2">Warning!</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this Todo?</p>
                                            <input type="hidden" id="delete_id" name="delete_id" value="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>

                                            <button type="submit" class="btn btn-danger" id="confirmDelete">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- -------------------- -->

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '#delete-todo', function() {
        var id = $(this).data('id');
        $('#deleteModal').modal('show'); // show the confirmation modal
        $('#deleteModal').on('click', '#confirmDelete', function() {
            $.ajax({
                url: '/todos/destroy/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteModal').modal('hide');
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


@endsection