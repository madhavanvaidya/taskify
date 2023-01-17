@props(['projects', 'users', 'tasks', 'clients'])
<!-- tasks -->
<div class="card mx-4 my-4">
    <div class="table-responsive text-nowrap">
        <h4 class="fw-bold p-4">All Tasks</h4>
        @if (count($tasks)==0)
        <h5 class="card-header">No tasks Found!</h5>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Project</th>
                    <th>Clients</th>
                    <th>Users</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($tasks as $task)
                <tr>

                    <td><a href="/tasks/information/{{$task->id}}"><strong>{{$task->title}}</strong></a></td>
                    <td>
                        @php
                        $id = $task->project_id;
                        $projects = "App\Models\Project";
                        $project = $projects::find($id);
                        @endphp
                        <strong>{{$project->title}}</strong>
                    </td>
                    <td>
                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            @php
                            $cid = explode(',', $project->client_id)
                            @endphp
                            @foreach($cid as $id)
                            @php
                            $clients = "App\Models\Client";
                            $client = $clients::find($id);
                            if ($client==NULL){
                            continue;
                            }
                            @endphp
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" title="{{$client->first_name}} {{$client->last_name}}">
                                <img src="{{asset('storage/' . $client->profile)}}" alt="Avatar" class="rounded-circle" />
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            @php
                            $uid = explode(',', $task->user_id)
                            @endphp
                            @foreach($uid as $id)
                            @php
                            $users = "App\Models\User";
                            $user = $users::find($id);
                            if ($user==NULL){
                            continue;
                            }
                            @endphp
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" title="{{$user->first_name}} {{$user->last_name}}">
                                <img src="{{asset('storage/' . $user->photo)}}" alt="Avatar" class="rounded-circle" />
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <?php $task_status = config("taskhub.task_status_labels"); ?>
                    <td><span class="badge bg-label-{{$task_status[$task->status] ?? 'info'}} me-1">{{$task->status}}</span></td>
                    <td>
                        <a href="/tasks/edit/{{$task->id}}">
                            <i class='bx bx-edit-alt mx-1'></i>
                        </a>
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#smallModal">
                            <i class='bx bx-trash mx-1'></i>
                        </button>


                        <div class="modal fade" id="smallModal" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel2">Warning!</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this task?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <a href="/tasks/destroy/{{$task->id}}">
                                            <button type="submit" class="btn btn-primary">Yes</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <div class="m-4 justify-content-end">{{$tasks->links()}}</div>
    </div>
</div>
<!-- / tasks -->