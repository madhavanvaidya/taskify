@extends('layout')
@section('content')
<div class="card mx-4 my-4">
    <div class="table-responsive text-nowrap">
        <h4 class="fw-bold p-4">All Users</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Profile</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($users as $user)
                <tr>
                    <td>
                        <strong>{{$user->first_name}} {{$user->last_name}}</strong>
                    </td>
                    <td><strong>{{$user->role}}</strong></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>
                        <div class="avatar avatar-md pull-up " title="{{$user->first_name}} {{$user->last_name}}">
                            <a href="/users/profile/show/{{$user->id}}"><img src="{{asset('storage/' . $user->photo)}}" alt="Avatar" class="rounded-circle" /></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection