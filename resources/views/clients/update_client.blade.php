@extends('layout')

@section('title')
<?php echo "Update " . $client->first_name . "'s Profile" ?>
@endsection

@section('content')
<div class="container">
    <div class="mt-4">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">{{$client->first_name}} {{$client->last_name}} /</span> Update Details
        </h4>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <form action="{{url('/clients/update/' . $client->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input class="form-control" type="text" id="first_name" name="first_name" value="{{ $client->first_name }}">

                        @error('first_name')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" value="{{ $client->last_name }}">

                        @error('last_name')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="text" id="email" name="email" value="{{ $client->email }}">


                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone">Phone Number</label>
                        <div class="input-group input-group-merge">
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="" value="{{ $client->phone }}">

                            @error('phone')
                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                            @enderror


                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="company" class="form-label">Company</label>
                        <input class="form-control" type="text" id="company" name="company" value="{{ $client->company }}">

                        @error('company')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input class="form-control" type="text" id="address" name="address" value="{{ $client->address }}">

                        @error('address')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input class="form-control" type="text" id="city" name="city" value="{{ $client->city }}">

                        @error('city')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="state" class="form-label">State</label>
                        <input class="form-control" type="text" id="state" name="state" value="{{ $client->state }}">

                        @error('state')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <input class="form-control" type="text" id="country" name="country" value="{{ $client->country }}">

                        @error('country')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="zip" class="form-label">Zip code</label>
                        <input class="form-control" type="text" id="zip" name="zip" value="{{ $client->zip }}">

                        @error('zip')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save Client</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection