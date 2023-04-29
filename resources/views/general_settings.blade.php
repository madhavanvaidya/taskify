@extends('layout')

@section('title')
<?php echo "General Settings" ?>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Settings /</span> General Settings
        </h4>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="company_title" class="form-label">Company Title</label>
                        <input class="form-control" type="text" id="company_title" name="company_title" value="">

                        @error('company_title')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="full_logo" class="form-label">Full Logo</label>
                        <input type="file" class="form-control" id="inputGroupFile02" name="full_logo">

                        @error('full_logo')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="half_logo" class="form-label">Half Logo</label>
                        <input type="file" class="form-control" id="inputGroupFile02" name="half_logo">

                        @error('half_logo')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="favicon" class="form-label">Favicon</label>
                        <input type="file" class="form-control" id="inputGroupFile02" name="favicon">

                        @error('favicon')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="timezone">Timezone</label>
                        <div class="input-group input-group-merge">
                            <input type="text" id="timezone" name="timezone" class="form-control">

                            @error('timezone')
                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                            @enderror


                        </div>
                    </div>


                    <div class="mb-3 col-md-6">
                        <label for="fonts" class="form-label">System Fonts</label>
                        <input class="form-control" type="text" id="fonts" name="fonts">

                        @error('fonts')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="currency_full_form" class="form-label">Currency Full Form</label>
                        <input class="form-control" type="text" id="currency_full_form" name="currency_full_form">

                        @error('currency_full_form')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="currency_symbol" class="form-label">Currency Symbol</label>
                        <input class="form-control" type="text" id="currency_symbol" name="currency_symbol">

                        @error('currency_symbol')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="currency_code" class="form-label">Currency Code</label>
                        <input class="form-control" type="text" id="currency_code" name="currency_code">

                        @error('currency_code')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror


                    </div>


                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection