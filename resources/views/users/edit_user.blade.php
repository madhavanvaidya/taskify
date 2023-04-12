@extends('layout')

@section('title')
<?php echo "Update " . $user->first_name . "'s Profile" ?>
@endsection

@section('content')
<div class="container">
    <div class="mt-4">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">{{$user->first_name}} {{$user->last_name}} /</span> Update Details
        </h4>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <form action="{{url('/users/update_user/' . $user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input class="form-control" type="text" id="first_name" name="first_name" value="{{ $user->first_name }}">

                        @error('first_name')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" value="{{ $user->last_name }}">

                        @error('last_name')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="role">Role</label>
                        <div class="input-group">
                            <select class="form-select text-capitalize" id="role" name="role">
                                @foreach ($roles as $role)

                                <option value="{{$role->id}}" <?php if ($user->getRoleNames()->first() == $role->name) {
                                                                    echo 'selected';
                                                                }  ?>>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('role')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}">

                        @error('email')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone">Phone Number</label>
                        <div class="input-group input-group-merge">
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="" value="{{ $user->phone }}">

                            @error('phone')
                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                            @enderror


                        </div>
                    </div>


                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input class="form-control" type="text" id="address" name="address" value="{{ $user->address }}">

                        @error('address')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input class="form-control" type="text" id="city" name="city" value="{{ $user->city }}">

                        @error('city')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="state" class="form-label">State</label>
                        <input class="form-control" type="text" id="state" name="state" value="{{ $user->state }}">

                        @error('state')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <input class="form-control" type="text" id="country" name="country" value="{{ $user->country }}">

                        @error('country')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="zip" class="form-label">Zip code</label>
                        <input class="form-control" type="text" id="zip" name="zip" value="{{ $user->zip }}">

                        @error('zip')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="d-flex align-items-start align-items-sm-center gap-4 my-3">
                        <img src="{{$user->photo ? asset('storage/' . $user->photo) : asset('/photos/no-image.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                        <div class="button-wrapper">
                            <div class="input-group d-flex">
                                <input type="file" class="form-control" id="inputGroupFile02" name="upload">
                            </div>

                            @error('upload')
                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <p class="text-muted mt-2">Allowed JPG or PNG.</p>
                        </div>

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