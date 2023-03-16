<!-- Navbar -->
@auth
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="nav-item d-flex align-items-center">
            <form method="GET" action="/search" class="d-flex align-items-center mx-0">
                <button type="submit" class="btn btn-default"><i class="bx bx-search fs-4 lh-0"></i></button>
                <input type="text" name="query" value="<?php if(isset($query)){print_r($query);} ?>"  class="form-control border-0 shadow-none" id="search-input" placeholder="Search...">
            </form>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">


            <li class="nav-item navbar-dropdown dropdown-user dropdown mt-3 mx-2">
                <p class="nav-item">Hi, {{auth()->user()->first_name}}</p>
            </li>
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('/photos/no-image.png')}}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('/photos/1.png')}}" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</span>
                                    <small class="text-muted text-capitalize">
                                        {{auth()->user()->getRoleNames()->first()}}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/account/{{ auth()->user()->id }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form action="/logout" method="POST" class="dropdown-item">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bx bx-log-out-circle"></i> Logout</button>

                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
@else
@endauth

<!-- / Navbar -->