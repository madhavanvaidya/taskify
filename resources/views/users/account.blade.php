@extends('layout')

@section('title')
<?php echo auth()->user()->first_name."'s Account" ?>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<div>
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">{{auth()->user()->first_name}} {{auth()->user()->last_name}} /</span> Account Settings
        </h4>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <div class="card-body">
                    <form action="{{url('/users/update_photo/' . auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('/photos/no-image.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <div class="input-group d-flex">
                                    <input type="file" class="form-control" id="inputGroupFile02" name="upload">
                                    <button class="btn btn-outline-primary" type="submit" id="inputGroupFileAddon04">Update profile photo</button>
                                </div>

                                @error('upload')
                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror

                                <p class="text-muted mt-2">Allowed JPG or PNG.</p>
                            </div>

                        </div>
                    </form>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="/users/update/{{auth()->user()->id}}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input class="form-control" type="text" id="first_name" name="first_name" value="{{ auth()->user()->first_name }}" autofocus />

                                @error('first_name')
                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror

                            </div>



                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input class="form-control" type="text" name="last_name" id="last_name" value="{{auth()->user()->last_name}}" />


                                @error('last_name')
                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror

                            </div>


                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phone">Phone Number</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="" value="{{auth()->user()->phone}}" />
                                </div>


                                @error('phone')
                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror

                            </div>


                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" value="{{auth()->user()->email}}" readonly="">
                                </div>

                                @error('email')
                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror

                            </div>



                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="role_id">Role</label>
                                <div class="input-group">
                                    <select class="form-select" id="role_id" name="role_id">
                                        @foreach ($roles as $role)

                                        <option value="{{$role->id}}" <?php if($user->role->id == $role->id){ echo 'selected'; }  ?>>{{$role->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('role')
                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror

                            </div>



                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="address">Address</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="text" id="address" placeholder="" name="address" value="{{auth()->user()->address}}">
                                </div>

                                @error('address')
                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror

                            </div>



                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="city">City</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="text" id="city" placeholder="" name="city" value="{{auth()->user()->city}}">
                                </div>

                                @error('city')
                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror

                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="state">State</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="text" id="state" placeholder="" name="state" value="{{auth()->user()->state}}">
                                </div>

                                @error('state')
                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror

                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="country">Country</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="text" id="country" placeholder="" name="country" value="{{auth()->user()->country}}">
                                </div>

                                @error('country')
                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror

                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="zip">Zip Code</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="text" id="zip" placeholder="" name="zip" value="{{auth()->user()->zip}}">
                                </div>

                                @error('zip')
                                <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror

                            </div>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
            <div class="card">
                <h5 class="card-header">Delete Account</h5>
                <div class="card-body">
                    <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                            <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger deactivate-account" data-bs-toggle="modal" data-bs-target="#smallModal">Deactivate Account</button>

                </div>

                <!-- Delete account modal -->

                <div class="modal fade" id="smallModal" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalLabel2">Warning!</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to deactivate your account?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <form id="formAccountDeactivation" action="/users/destroy/{{auth()->user()->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary">Yes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- -------------------- -->

            </div>
        </div>
    </div>
</div>
@endsection