@props(['projects', 'users'])
<!-- projects -->

<div class="card mx-4 my-4">
    <div class="table-responsive text-nowrap">
        
    <div class="d-flex">
            <h4 class="fw-bold p-4">All Projects</h4>
        </div>
        
        @if (count($projects)==0)
        <h5 class="card-header">No projects Found!</h5>
        @else

        <table class="table">
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Clients</th>
                    <th>Users</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($projects as $project)
                <tr>

                    <td><a href="/projects/information/{{$project->id}}"><strong>{{$project->title}}</strong></a></td>
                    <td>
                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            @php
                            $cid = explode(',', $project->client_id)
                            @endphp
                            @foreach($cid as $id)
                            @php
                            $clients = "App\Models\Client";
                            $client = $clients::find($id);
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
                            $uid = explode(',', $project->user_id)
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
                    <?php $project_status = config("taskhub.project_status_labels");?>
                    <td><span class="badge bg-label-{{$project_status[$project->status] ?? 'info'}} me-1">{{$project->status}}</span></td>
                    <td>
                        <a href="/projects/edit/{{$project->id}}">
                            <i class='bx bx-edit-alt mx-1'></i>
                        </a>
                        <a href="/projects/destroy/{{$project->id}}">
                            <i class='bx bx-trash mx-1'></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <div class="m-4 justify-content-end">{{$projects->links()}}</div>
    </div>
</div>
<!-- / projects -->