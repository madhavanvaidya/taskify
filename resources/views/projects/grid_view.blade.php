@extends('layout')

@section('title')
<?php echo "Projects - Grid View" ?>
@endsection

@section('content')
<div class="container">
    <div class="mt-4 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Projects /</span> Grid View
            </h4>
        </div>
        <div>
            <a href="{{url('/projects/create')}}"><button type="button" class="btn btn-sm btn-primary">Create new Project</button></a>
            <a href="{{url('/projects')}}"><button type="button" class="btn btn-sm btn-primary"><i class='bx bxs-grid-alt'></i> Grid View</button></a>
            <a href="{{url('/projects/list_view')}}"><button type="button" class="btn btn-sm btn-primary"><i class='bx bx-list-ul'></i> List View</button></a>
        </div>
    </div>

    <div class="mt-4 d-flex row">
        @foreach ($projects as $project)
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title"><a href="{{url('/projects/information/' . $project->id)}}"><strong>{{$project->title}}</strong></a></h4>
                        <div>
                            <div class="input-group">
                                <a href="" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bxs-cog'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">
                                        <a href="{{url('/projects/edit/' . $project->id)}}" class="card-link m-2"><i class='menu-icon tf-icons bx bxs-edit'></i> Edit project</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="" class="m-2" data-bs-toggle="modal" data-bs-target="#smallModal">
                                            <i class='menu-icon tf-icons bx bxs-trash'></i> Delete project
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- delete project modal -->
                            <div class="modal fade" id="smallModal" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLabel2">Warning!</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this project?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <a href="/projects/destroy/{{$project->id}}">
                                                <button type="submit" class="btn btn-primary">Yes</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- -------------------- -->

                        </div>
                    </div>
                    <span class='badge bg-label-{{config("taskhub.project_status_labels")[$project->status]}} me-1'> {{$project->status}}</span>

                    <div class="my-4 d-flex justify-content-between">
                        <span><i class='bx bx-task'></i> <b>{{count($project->tasks)}} </b>Task(s)</span>
                        <a href="{{url('/projects/tasks/list/' . $project->id)}}"><button type="button" class="btn btn-sm rounded-pill btn-outline-primary">Tasks Details</button></a>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <p class="card-text">
                                Users:
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <?php
                                $users = $project->users;
                                $count = count($users);
                                $displayed = 0;
                                ?>
                                @foreach($users as $user)
                                    @if($displayed < 3) <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-md pull-up mx-1" title="{{$user->first_name}} {{$user->last_name}}">
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
                        </div>

                        <div class="col-md-6">
                            <p class="card-text">
                                Clients:
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <?php
                                $clients = $project->clients;
                                $count = count($clients);
                                $displayed = 0;
                                ?>
                                @foreach($clients as $client)
                                @if($displayed < 3) <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-md pull-up mx-1" title="{{$client->first_name}} {{$client->last_name}}">
                                    <img src="{{asset('storage/' . $client->profile)}}" alt="Avatar" class="rounded-circle" />
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
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <i class='bx bxs-calendar'></i> Start Date: {{$project->start_date}}
                        </div>

                        <div class="col-md-6">
                            <i class='bx bxs-calendar'></i> End Date: {{$project->end_date}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach

        <div>
            {{$projects->links()}}
        </div>
    </div>

</div>

@endsection