@extends('layout')

@section('title')
<?php echo "Settings" ?>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Settings /</span> Permissions Settings
        </h4>
        <a href="/roles/create"><button type="button" class="btn btn-primary">Create new Role</button></a>

    </div>

    <div class="card mt-4">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>
                                <h4 class="text-capitalize fw-bold mb-0">{{$role->name}}</h4>
                            </td>

                            <?php
                            $permissions = $role->permissions;
                            ?>
                            @if(count($permissions)!=0)
                            <td style="display: flex; flex-wrap: wrap;">
                                @foreach($permissions as $permission)
                                <span class="badge rounded p-2 m-1 px-3 bg-primary ">
                                    <?php echo str_replace("_"," ","$permission->name");?>
                                </span>
                                @endforeach
                            </td>
                            @else
                            <td class="align-items-center">
                                <span>
                                    No Permissions Assigned!
                                </span>
                            </td>
                            @endif
                            <td class="align-items-center">
                                <div class="d-flex">
                                    <a href="/roles/edit/{{$role->id}}" class="card-link"><i class='bx bxs-edit'></i></a>
                                    <a href="" type="button" id="delete-todo" data-id="{{$role->id}}" class="card-link mx-4" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class='bx bxs-trash'></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel2">Warning!</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Role?</p>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '#delete-todo', function() {
        var id = $(this).data('id');
        $('#deleteModal').modal('show'); // show the confirmation modal
        $('#deleteModal').on('click', '#confirmDelete', function() {
            $.ajax({
                url: '/roles/destroy/' + id,
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
                    toastr.error('There was a problem deleting the role.');
                }
            });
        });
    });
</script>

@endsection