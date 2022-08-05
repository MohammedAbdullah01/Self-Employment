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
                    <img class="img-thumbnail w-100" src="{{ $user->PictureFreelancer }}" alt="teacher">
                    @include('users.modal.edit_profile')
                    @include('users.modal.change_password')

                </div>
                <!-- Freelancer details -->
                <div class="col-md-6 mb-5">
                    <h3>{{ $user->name }}</h3>
                    <h6 class="text-color">{{ $user->profile->title_job }}</h6>
                    <p class="mb-5">{{ Str::limit($user->profile->about_me, 100, '...') }}</p>
                    <div class="row">
                        <div class="col-md-6 mb-5 mb-md-0">
                            <h4 class="mb-4">{{ __('Information About Me') }}</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <a class="text-color" ">
                                                                    <i class="ti-email mr-2"></i>
                                                                    {{ $user->email }}
                                                                </a>
                                                            </li>


                                                            <li class="mb-3">
                                                                <a class="text-color" >
                                                                    <i class="ti-user mr-2"></i>
                                                                    {{ $user->gander }}
                                                                </a>
                                                            </li>

                                                            <li class="mb-3">
                                                                <a class="text-color" >
                                                                    <i class="ti-mobile mr-2"></i>
                                                                    {{ $user->profile->phone }}
                                                                </a>
                                                            </li>

                                                            <li class="mb-3">
                                                                <a class="text-color" >
                                                                    <i class="ti-github mr-2"></i>
                                                                    {{ $user->profile->github }}
                                                                </a>
                                                            </li>

                                                            <li class="mb-3">
                                                                <a class="text-color" >
                                                                    <i class="ti-twitter-alt mr-2"></i>
                                                                    {{ $user->profile->twitter }}
                                                                </a>
                                                            </li>

                                                            <li class="mb-3">
                                                                <a class="text-color" >
                                                                    <i class="ti-linkedin mr-2"></i>
                                                                    {{ $user->profile->linkedin }}
                                                                </a>
                                                            </li>

                                                            <li class="mb-3">
                                                                <a class="text-color">
                                                                    <i class="ti-alarm-clock mr-2"></i>
                                                                    {{ $user->profile->hourlyRates }}
                                                                </a>
                                                            </li>

                                                            <li class="mb-3">
                                                                <a class="text-color" >
                                                                    <i class="ti-location-pin mr-2"></i>
                                                                    {{ $user->profile->country }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4 class="mb-4">Skills</h4>
                                                        <ul class="list-unstyled">

                                                                   @foreach (explode(',', $user->profile->skills) as $skill)
                                <li class="mb-3">{{ $skill }}</li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>

                {{-- BIOGRAPHY --}}
                <div class="col-12">
                    <h4 class="mb-4">
                        {{ __('BIOGRAPHY') }}
                    </h4>
                    <p class="mb-5">{{ $user->profile->about_me }} </p>
                </div>
            </div>
        </div>
    </section>

    {{-- My Latest Work --}}
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="mb-4">
                        {{__('My Latest Work')}}

                        <!-- Count Lattest Works -->
                        <span class="float-end">
                            ({{ $user->latestwork_count ?? '' }})
                        </span>
                    </h4>

                    <!-- Create Lattest Works -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                        @if (Auth::guard('web')->check())

                            @if ($user->id == Auth::guard('web')->user()->id)
                                @include('users.modal.add_latest_work')
                            @endif
                        @endif
                    </div>
                </div>


                <!-- Latest Work item -->
                @forelse ($latestwork as $work)
                    <div class="col-lg-4 col-sm-6 mb-5">
                        <div class="card p-0 border-primary rounded-0 hover-shadow">
                            <img class="card-img-top rounded-0" src="{{ $work->pictureLatestWorks }}" height="300px" alt="course thumb">
                            <div class="card-body">
                                <ul class="list-inline mb-2">
                                    <li class="list-inline-item">
                                        <i class="ti-calendar mr-1 text-color"></i>
                                        {{ $work->created_at->diffForhumans() }}
                                    </li>
                                    <li class="list-inline-item"><a class="text-color"
                                            href="course-single.html">Humanities</a>
                                    </li>
                                </ul>
                                <a>
                                    <h4 class="card-title">{{ $work->title }}</h4>
                                </a>
                                <p class="card-text mb-4"> {{ Str::limit($work->description, 50, '...') }}</p>

                                @include('users.modal.show')

                                @if (Auth::guard('web')->check())
                                    @if ($user->id == Auth::guard('web')->user()->id)
                                        @include('users.modal.edite')
                                        @include('users.modal.delete')
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class=" alert alert-danger text-center mt-3 w-50 mb-2 m-auto">
                        <b>{{ __('There Are No Works ') }}</b> <i class="ti-face-sad"></i>
                    </div>
                @endforelse
            </div>
        </div>
    </section>


    <!-- Projects Submitted -->
    @if (Auth::guard('web')->check())

        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4 class="mb-4">{{ __('Projects Submitted') }}
                            <span class="float-end">({{ $commented_projects['comments_count'] ?? '0' }})</span>
                        </h4>
                        <ul class="list-unstyled">
                            <!-- Projects Submitted item -->
                            @forelse ($commented_projects as $comment)
                                <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                                    <div class="d-md-table-cell text-center p-2 bg-primary text-white  mb-md-0">
                                        <span class="h2 d-block">
                                            <img class="img-thumbnail" src="{{ $comment->client->PictureClient }}"
                                                height="100" width="120" alt="Profile" class="rounded-circle">
                                        </span>
                                        {{ $comment->client->name }}
                                    </div>
                                    <div class="d-md-table-cell px-4 vertical-align-middle mb-4  mb-md-0">

                                        <a href="{{ route('front.show.project', $comment->title) }}"
                                            class="h4 mb-3 d-block mt-2">
                                            {{ $comment->title }}
                                        </a>
                                        <p class="mb-0">{{ Str::limit($comment->pivot->comment, 40, '...') }}</p>
                                        <p>
                                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#comment_project"
                                                role="button" aria-expanded="false" aria-controls="comment_project">
                                                {{ __('Show Comment') }}
                                            </a>
                                        </p>
                                        <div class="collapse" id="comment_project">
                                            <div class="card card-body mb-2">
                                                {{ $comment->pivot->comment }}
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                    @include('users.comments.edite')
                                                    @include('users.comments.delete')


                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="d-md-table-cell text-right pr-0 pr-md-4">
                                        <a href="{{ route('front.show.project', $comment->title) }}">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </a>
                                    </div>
                                </li>
                            @empty
                                <div class=" alert alert-danger text-center mt-2 mb-2 w-50 m-auto">
                                    <b>{{ __('There Are No Projects Ahead Of Them. ') }}</b> <i class="ti-face-sad"></i>
                                </div>
                            @endforelse

                        </ul>
                        {{ $commented_projects->links() }}
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection








{{-- <div class="container">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{ $user->PictureFreelancer }}" height="120px" alt="Profile"
                                class="rounded-circle">
                            <h2>{{ $user->name }}</h2>
                            <h3>{{ $user->profile->title_job }}</h3>
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

                                @if (Auth::guard('web')->check())

                                    @if ($user->id == Auth::guard('web')->user()->id)
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
                                    <p class="small fst-italic">{{ $user->profile->about_me }}</p>

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Job</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->profile->title_job }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Skills</div>
                                        <div class="col-lg-9 col-md-8">
                                            @foreach (explode(',', $user->profile->skills) as $skill)
                                                <span class="badge bg-success">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Gander</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->profile->gander }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Country</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->profile->country }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Hourly Rate</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->profile->hourlyRates }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->profile->phone }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                    </div>
                                </div>

                                @if (Auth::guard('web')->check())



                                    @if ($user->id == Auth::guard('web')->user()->id)
                                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                            <!-- Profile Edit Form -->
                                            <form action="{{ route('user.update') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row mb-3">
                                                    <label for="profileImage"
                                                        class="col-md-4 col-lg-3 col-form-label">Profile
                                                        Image</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <img name="avatar" src="{{ $user->PictureFreelancer }}"
                                                            height="120px" alt="Profile">

                                                        <div class="pt-2">
                                                            <x-form.input-lable-error class="w-25" type="file"
                                                                name="avatar" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label mt-4">
                                                        FullName</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error name="name" :value="$user->name"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="about"
                                                        class="col-md-4 col-lg-3 col-form-label mt-4">About</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.textarea-lable-error name="about_me" rows="6"
                                                            :value="$user->profile->about_me"
                                                            placeholder="Enter A Detailed Description Of Your Project And Attach Examples Of What You Want If Possible." />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Job"
                                                        class="col-md-4 col-lg-3 col-form-label ">Job</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error name="title_job" :value="$user->profile->title_job"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Job"
                                                        class="col-md-4 col-lg-3 col-form-label">Skills</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error name="skills" data-role="tagsinput"
                                                            :value="$user->profile->skills"
                                                            placeholder="Determine The Most Important Skills Required To Implement Your Project." />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="about"
                                                        class="col-md-4 col-lg-3 col-form-label mt-4 ">Gander</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.select-lable-error name="gander" :options="$user->ganders()"
                                                            :selected="$user->profile->gander" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Country"
                                                        class="col-md-4 col-lg-3 col-form-label ">Country</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-country-select name="country" :selected="$user->profile->country" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label ">Hourly
                                                        Rate</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error type="number" name="hourly_rate"
                                                            :value="$user->profile->hourly_rate"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Phone"
                                                        class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error type="tel" name="phone"
                                                            :value="$user->profile->phone"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Email"
                                                        class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error type="email" name="email"
                                                            :value="$user->email"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                                        Profile</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error type="url" name="twitter"
                                                            :value="$user->profile->twitter"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Github
                                                        Profile</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error type="url" name="github"
                                                            :value="$user->profile->github"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Linkedin"
                                                        class="col-md-4 col-lg-3 col-form-label">Linkedin
                                                        Profile</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <x-form.input-lable-error type="url" name="linkedin"
                                                            :value="$user->profile->linkedin"
                                                            placeholder="When Do You Need To Receive Your Project ?" />
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('Update Profile') }}</button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane fade pt-3" id="profile-settings">

                                            <!-- Settings Form -->
                                            <form>

                                                <div class="row mb-3">
                                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
                                                        Notifications</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="changesMade" checked>
                                                            <label class="form-check-label" for="changesMade">
                                                                Changes made to your account
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="newProducts" checked>
                                                            <label class="form-check-label" for="newProducts">
                                                                Information on new products and services
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="proOffers">
                                                            <label class="form-check-label" for="proOffers">
                                                                Marketing and promo offers
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="securityNotify" checked disabled>
                                                            <label class="form-check-label" for="securityNotify">
                                                                Security alerts
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form><!-- End settings Form -->

                                        </div>

                                        <div class="tab-pane fade pt-3" id="profile-change-password">
                                            <!-- Change Password Form -->
                                            <form action="{{ route('user.change.Password') }}" method="post">
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

                <div class="card text-center mt-5 ">
                    <div class="card-header">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                            @if (Auth::guard('web')->check())

                                @if ($user->id == Auth::guard('web')->user()->id)
                                    @include('users.modal.add_latest_work')
                                @endif
                            @endif

                        </div>
                        <h4 class="nav-item float-start">
                            {{ __('Business Exhibition') }}
                            {{ $user->latestwork_count ? '( ' . $user->latestwork_count . ' )' : '' }}
                        </h4>

                    </div>
                    <div class="card-body">

                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            @forelse ($latestwork as $work)
                                <div class="col-md-3">
                                    <div class="card" style="height: 23rem">
                                        <img src="{{ $work->pictureLatestWorks }}" class="card-img-top " height="150px"
                                            width="100%" alt="...">
                                        <div class="card-body">

                                            <a href="#" class="card-link text-primary">
                                                <h5 class="card-title" data-bs-toggle="modal"
                                                    data-bs-target="#show_gallery{{ $work->id }}">
                                                    {{ $work->title }}
                                                </h5>
                                            </a>
                                            @include('users.modal.show')

                                        </div>
                                        @if (Auth::guard('web')->check())
                                            @if ($user->id == Auth::guard('web')->user()->id)
                                                <div class="card-footer">
                                                    @include('users.modal.edite')
                                                    @include('users.modal.delete')
                                                </div>
                                            @endif
                                        @endif

                                        <div class="card-footer">
                                            <small class="text-muted">{{ $work->created_at->diffForhumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            @empty

                                <div class=" alert alert-danger text-center mt-3 mb-2 m-auto">
                                    <b>{{ __('There Are No Works ! :(') }}</b>
                                </div>
                            @endforelse

                        </div>

                    </div>
                    <span class="m-auto">
                        {{ $latestwork->links() }}
                    </span>
                </div>

                @if (Auth::guard('web')->check())
                    <div class="card mt-5 ">
                        <div class="card-header">
                            <h4 class="nav-item float-start">
                                {{ __('Commented Projects') }}
                            </h4>

                        </div>
                        <div class="card-body mt-2 col-md-12">


                            <div class="row ">
                                @forelse ($commented_projects as $work)
                                    <div class="col-sm-6 ">
                                        <div class="card">
                                            <div class="card-body">
                                                <a class="nav-link"
                                                    href="{{ route('front.show.project', $work->title) }}">
                                                    <h5 class="card-header text-primary font-weight-bold">
                                                        {{ $work->title }}
                                                    </h5>
                                                    <p class="card-text">{{ Str::limit($work->description, 40, '...') }}
                                                    </p>
                                                </a>
                                            </div>

                                            <div class="card-footer" style="height: 13rem;">
                                                <p class="card-header text-primary">{{ 'Comment' }}
                                                    <small class="text-muted float-end"><i class="bi bi-clock-fill m-1">
                                                            {{ $work->created_at->diffForHumans() }}</i></small>
                                                </p>
                                                <p class="card-text">{{ $work->pivot->comment }}</p>
                                            </div>

                                            <div class="card-footer">

                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                    @include('users.comments.edite')
                                                    @include('users.comments.delete')
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <small class="text-muted">
                                                    <i class="bi bi-person-fill ">
                                                        <a class="nav-link d-inline-block" href="">
                                                            {{ $work->client->name }}
                                                        </a>
                                                    </i>
                                                    <i class="bi bi-clock-fill m-1">
                                                        {{ $work->created_at->diffForHumans() }}</i>

                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @empty

                                    <div class=" alert alert-danger text-center mt-2 mb-2 w-50 m-auto">
                                        <b>{{ __('There Are No Commented Projects ! :(') }}</b>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <span class="m-auto">
                            {{ $commented_projects->links() }}
                        </span>
                    </div>
                @endif
            </div>
        </section>
    </div> --}}
