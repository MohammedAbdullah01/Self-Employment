@extends('frontend.layouts.app_front')

@section('title', 'My-Profile')
@section('content')


    <!-- page title -->
    <section class="page-title-section overlay" data-background="{{ asset('frontend/images/backgrounds/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb mb-2">
                        <li class="list-inline-item"><a class="h2 text-primary font-secondary"
                                href="{{ route('front.home') }}">
                                {{ __('Home') }}
                            </a>
                        </li>

                        <li class="list-inline-item text-white h3 font-secondary nasted">
                            {{ __('My Profile') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <!-- Freelancer details -->
    <section class="section pb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-5">
                    <img class="img-thumbnail w-100" src="{{ $client->PictureClient }}" alt="teacher">
                    @if (Auth::guard('client')->check())
                        @if ($client->id == Auth::guard('client')->id())
                            @include('clients.modal.edit_profile')
                            @include('clients.modal.change_password')
                        @endif
                    @endif

                </div>
                <!-- Client details -->
                <div class="col-md-6 mb-5">
                    <h3>{{ $client->name }}</h3>
                    <h6 class="text-color">{{ $client->company }}</h6>
                    <p class="mb-5">{{ Str::limit($client->about_me, 100, '...') }}</p>
                    <div class="row">
                        <div class="col-md-6 mb-5 mb-md-0">
                            <h4 class="mb-4">{{ __('Information About Me') }}</h4>
                            <ul class="list-unstyled">

                                <li class="mb-3">
                                    <a class="text-color">
                                        <i class="ti-email mr-2"></i>
                                        {{ $client->email }}
                                    </a>
                                </li>

                                <li class="mb-3">
                                    <a class="text-color">
                                        <i class="ti-mobile mr-2"></i>
                                        {{ $client->phone }}
                                    </a>
                                </li>

                                <li class="mb-3">
                                    <a class="text-color">
                                        <i class="ti-location-pin mr-2"></i>
                                        {{ $client->country }}
                                    </a>
                                </li>

                                <li class="mb-3">
                                    <a class="text-color">
                                        <i class="ti-home mr-2"></i>
                                        {{ $client->company }}
                                    </a>
                                </li>

                                <li class="mb-3">
                                    <a class="text-color">
                                        <i class="ti-world mr-2"></i>
                                        {{ $client->link }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- BIOGRAPHY --}}
                <div class="col-12">
                    <h4 class="mb-4">
                        {{ __('BIOGRAPHY') }}
                    </h4>
                    <p class="mb-2">{{ $client->about_me }} </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Projects -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="mb-2">
                        {{ __('My Latest Projects') }}

                        <!-- Count Projects  -->
                        <span class="float-end">
                            ( {{ $client->projects_count ?? '' }} )
                        </span>

                    </h4>

                    <!-- Create Project  -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">

                        @if (Auth::guard('client')->check())
                            @if ($client->id == Auth::guard('client')->id())
                                @include('clients.projects.create')
                            @endif
                        @endif

                    </div>

                    <!-- My Projects -->
                    <ul class="list-unstyled">
                        <!-- Project item -->
                        @forelse ($projects as $project)
                            <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                                <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0">
                                    <span class="h2 d-block">{{ $project->created_at->format('d') }}</span>
                                    {{ $project->created_at->format('M,Y') }}
                                </div>
                                <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">


                                    <a href="{{ route('front.show.project', $project->title) }}" class="h4 mb-3 d-block">
                                        {{ $project->title }}
                                    </a>


                                    <p class="mb-0 d-inline-block">
                                        {{ Str::limit($project->description, 40, '...') }}
                                    </p>
                                    <p class="mb-0">
                                        <i
                                            class="ti-comment-alt text-info">{{ $project->comments_count ? ' ' . $project->comments_count : ' There Are Added Offers' }}</i>
                                    </p>


                                    <div class="mt-1 mb-0 ">

                                        @if (Auth::guard('client')->check())
                                            @if ($client->id == Auth::guard('client')->id())
                                                @include('clients.projects.edit')
                                                @include('clients.projects.delete')
                                            @endif
                                        @endif

                                    </div>
                                </div>



                                <div class="d-md-table-cell text-right pr-0 pr-md-4"><a
                                        href="{{ route('front.show.project', $project->title) }}"
                                        class="btn btn-primary btn-sm">
                                        {{ __('Read More') }}
                                    </a>
                                </div>

                            </li>
                        @empty
                            <div class="alert alert-danger text-center w-75 m-auto mt-4">
                                <b>{{ __('No Projects Added ') }}</b> <i class="ti-face-sad"></i>
                            </div>
                        @endforelse
                    </ul>
                </div>
                {{ $projects->links() }}
            </div>
        </div>
    </section>

@endsection




















{{-- ======================= Old============================ --}}

{{-- <div class="container">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Client</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{ $client->PictureClient }}" height="120px" alt="Profile" class="rounded-circle">
                            <h2>{{ $client->name }}</h2>
                            <h3>{{ $client->coompany }}</h3>
                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">


                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>
                                @if (Auth::guard('client')->check())
                                    @if ($client->id == Auth::guard('client')->id())
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#profile-edit">Edit
                                                Profile</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#profile-settings">Settings</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#profile-change-password">Change Password</button>
                                        </li>
                                    @endif
                                @endif
                            </ul>

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">About</h5>
                                    <p class="small fst-italic">{{ $client->about_me }}</p>

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">{{ $client->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Company</div>
                                        <div class="col-lg-9 col-md-8">{{ $client->company }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Country</div>
                                        <div class="col-lg-9 col-md-8">{{ $client->country }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">{{ $client->phone }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $client->email }}</div>
                                    </div>

                                </div>

                                @if (Auth::guard('client')->check())

                                    @if ($client->id == Auth::guard('client')->id())
                                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                            <!-- Profile Edit Form -->
                                            <form action="{{ route('client.update') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row mb-3">
                                                    <label for="profileImage"
                                                        class="col-md-4 col-lg-3 col-form-label">Profile
                                                        Image</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <img name="avatar" src="{{ $client->PictureClient }}"
                                                            height="120px" alt="Profile">

                                                        <div class="pt-2">
                                                            <x-form.input-lable-error class="w-25" type="file"
                                                                name="avatar" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">
                                                        FullName</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error name="name" :value="$client->name"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="about"
                                                        class="col-md-4 col-lg-3 col-form-label ">About</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.textarea-lable-error name="about_me" rows="6"
                                                            :value="$client->about_me"
                                                            placeholder="Enter A Detailed Description Of Your Project And Attach Examples Of What You Want If Possible." />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Job"
                                                        class="col-md-4 col-lg-3 col-form-label">Company</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error name="company" :value="$client->company"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Country"
                                                        class="col-md-4 col-lg-3 col-form-label">Country</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-country-select name="country" :selected="$client->country" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Address"
                                                        class="col-md-4 col-lg-3 col-form-label mt-4">Hourly
                                                        Rate</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error type="number" name="hourly_rate"
                                                            :value="$client->hourly_rate"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Phone"
                                                        class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error type="tel" name="phone"
                                                            :value="$client->phone"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Email"
                                                        class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error type="email" name="email"
                                                            :value="$client->email"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                                        Profile</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error type="url" name="link"
                                                            :value="$client->link"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-sm">{{ __('Update Profile') }}</button>
                                                </div>
                                            </form>
                                        </div>


                                        <div class="tab-pane fade pt-3" id="profile-change-password">
                                            <!-- Change Password Form -->
                                            <form action="{{ route('client.change.Password') }}" method="post">
                                                @csrf
                                                @method('PUT')

                                                <div class="row mb-3">
                                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">
                                                        {{ __('CurrentPassword') }}
                                                    </label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error type="password" name="oldpassword" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">
                                                        {{ __('NewPassword') }}
                                                    </label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error type="password" name="password" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">
                                                        {{ __('Re-enter NewPassword') }}
                                                    </label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error type="password"
                                                            name="password_confirmation" />
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                                        {{ __('Change Password') }}
                                                    </button>
                                                </div>
                                            </form><!-- End Change Password Form -->

                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card  mt-5 ">
                    <div class="card-header">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            @if (Auth::guard('client')->check())
                                @if ($client->id == Auth::guard('client')->id())
                                    @include('clients.projects.create')
                                @endif
                            @endif

                        </div>
                        <h4 class="nav-item float-start">
                            {{ __('Latest Projects') }}

                            @if ($client->projects_count > 0)
                                <span class="badge rounded-pill text-bg-primary">
                                    {{ $client->projects_count }}
                                </span>
                            @endif
                        </h4>

                    </div>
                    <div class="card-body">

                        <div class="row row-cols-1 row-cols-md-2 g-4">

                            @forelse ($projects as $project)

                                <div class="col-sm-6">
                                    <div class="card">

                                        <div class="card-body">
                                            <span class="float-end badge rounded-pill text-bg-primary">
                                                {{ $project->created_at->diffForhumans() }}
                                            </span>
                                            <a class="nav-link"
                                                href="{{ route('front.show.project', $project->title) }}">
                                                <h5 class="card-title">{{ $project->title }}
                                            </a>

                                            <span class=" m-3 {{ $project->statusProject }} ">{{ $project->status }}</a>
                                                </h5>
                                                <p class="card-text">{{ Str::limit($project->description, 20, '...') }}
                                                </p>

                                        </div>
                                        <ul class="list-group list-group-flush">

                                            <li class="list-group-item ">
                                                {{ __('Type') }}
                                                <span class="float-end text-primary">
                                                    {{ $project->type }}
                                                </span>
                                            </li>

                                            <li class="list-group-item ">
                                                {{ __('Budget') }}
                                                <span class="float-end text-primary">
                                                    {{ $project->budget }}
                                                </span>
                                            </li>

                                            <li class="list-group-item ">
                                                {{ __('Delivery time') }}
                                                <span class="float-end text-primary">
                                                    {{ $project->deliveryPeriodProject }}
                                                </span>
                                            </li>

                                            <li class="list-group-item ">
                                                {{ __('Category') }}
                                                <span class="float-end text-primary">
                                                    {{ $project->category->name }}/
                                                    {{ $project->category->parent->name }}
                                                </span>
                                            </li>

                                            <li class="list-group-item ">
                                                {{ __('Skills') }}
                                                @foreach ($project->skillsProject as $item)
                                                    <span class="float-end badge rounded-pill text-bg-primary m-1">
                                                        {{ $item }}
                                                    </span>
                                                @endforeach
                                            </li>
                                        </ul>

                                        <div class="card-footer">
                                            @if (Auth::guard('client')->check())
                                                @if ($client->id == Auth::guard('client')->id())
                                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                                        @include('clients.projects.edit')
                                                        <form class="d-inline-block"
                                                            action="{{ route('client.delete.project', $project->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-outline-danger btn-sm " type="submit">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-danger text-center w-75 m-auto mt-4">
                                    <b>{{ __('No Projects Added ! :(') }}</b>
                                </div>
                            @endforelse

                        </div>

                    </div>
                    <span class="m-auto">
                        {{ $projects->links() }}
                    </span>
                </div>


            </div>
        </section>
    </div> --}}
