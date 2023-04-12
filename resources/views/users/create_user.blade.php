@extends('layout')

@section('title')
<?php echo "New User" ?>
@endsection

@section('content')
<div class="container">
    <div class="mt-4">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Users /</span> Create New User
        </h4>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="fw-bold">New User</h4>
            <form action="{{url('/users/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input class="form-control" type="text" id="first_name" name="first_name" placeholder="Enter First name">

                        @error('first_name')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Enter Last name">

                        @error('last_name')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="text" id="email" name="email" placeholder="Enter E-mail">

                        @error('email')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone">Phone Number</label>
                        <div class="input-group input-group-merge">
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Phone number">

                            @error('phone')
                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                            @enderror


                        </div>
                    </div>


                    <div class="mb-3 col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Enter Password">

                        @error('password')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Re enter Password">

                        @error('password_confirmation')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                                <label class="form-label" for="role">Role</label>
                                <div class="input-group">
                                    <select class="form-select text-capitalize" id="role" name="role">
                                        @foreach ($roles as $role)

                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('role')
                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror

                            </div>

                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input class="form-control" type="text" id="address" name="address" placeholder="Enter Address">

                        @error('address')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input class="form-control" type="text" id="city" name="city" placeholder="Enter City">

                        @error('city')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="state" class="form-label">State</label>
                        <input class="form-control" type="text" id="state" name="state" placeholder="Enter State">

                        @error('state')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <input class="form-control" type="text" id="country" name="country" placeholder="Enter Country">

                        @error('country')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="zip" class="form-label">Zip code</label>
                        <input class="form-control" type="text" id="zip" name="zip" placeholder="Enter Zip Code">

                        @error('zip')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="photo" class="form-label">Profile Picture</label>
                        <input class="form-control" type="file" id="photo" name="profile">

                        @error('profile')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save User</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection