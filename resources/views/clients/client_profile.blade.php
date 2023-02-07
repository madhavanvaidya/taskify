@extends('layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Client Details</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">

                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{$client->profile ? asset('storage/' . $client->profile) : asset('/profiles/1.png')}}" alt="client-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                        <h4 class="card-header fw-bold">{{ $client->first_name }} {{$client->last_name}}</h4>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row">

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phone">Phone Number</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="" value="{{$client->phone}}" readonly />
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" value="{{$client->email}}" readonly="">
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="address">Address</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="address" placeholder="" value="{{$client->address}}" readonly="">
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="city">City</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="city" placeholder="" value="{{$client->city}}" readonly="">
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="state">State</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="state" placeholder="" value="{{$client->state}}" readonly="">
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="country">Country</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="country" placeholder="" value="{{$client->country}}" readonly="">
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="zip">Zip Code</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="text" id="zip" placeholder="" value="{{$client->zip}}" readonly="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-projects-card/>

@endsection