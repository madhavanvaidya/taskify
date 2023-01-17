@extends('layout')
@section('content')
<div class="card m-4">
    <div class="table-responsive text-nowrap">
        <div class="d-flex">
            <h4 class="fw-bold p-4">All Clients</h4>
            <a href="/clients/create" class="m-4"><button type="button" class="btn btn-sm btn-primary">Create new Client</button></a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Profile</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($clients as $client)
                <tr>
                    <td>
                        <strong>{{$client->first_name}} {{$client->last_name}}</strong>
                    </td>
                    <td><strong>{{$client->company}}</strong></td>
                    <td>{{$client->email}}</td>
                    <td>{{$client->phone}}</td>
                    <td>
                        <!-- Profile Modal -->

                        <div class="avatar avatar-md pull-up " title="{{$client->first_name}} {{$client->last_name}}">
                            <a href="/clients/profile/show/{{$client->id}}"><img src="{{asset('storage/' . $client->profile)}}" alt="Avatar" class="rounded-circle" /></a>
                        </div>

                        <!-- / PROFILE MODAL -->
                    </td>
                    <td>
                        <a href="/clients/edit/{{$client->id}}">
                            <i class='bx bx-edit-alt mx-1'></i>
                        </a>
                        <a href="/clients/destroy/{{$client->id}}">
                            <i class='bx bx-trash mx-1'></i>
                        </a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection