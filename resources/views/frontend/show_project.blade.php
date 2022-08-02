@extends('frontend.layouts.app_front')

@section('title', 'Show | project')
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
                            <a class="h2 text-primary font-secondary" href="{{ route('front.projects') }}">
                                {{ __('Projects') }}
                            </a>
                        </li>

                        <li class="list-inline-item text-white h3 font-secondary nasted">
                            {{ __('Project Details') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <!-- Project details -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex">

                        {{-- Created At Of The Project --}}
                        <div class="text-center mr-4">
                            <div class="p-4 bg-primary text-white">
                                <span class="h2 d-block">
                                    {{ $project->created_at->format('d') }}
                                </span>
                                {{ $project->created_at->format('M,Y') }}
                            </div>
                        </div>


                        <div>
                            <h3 class="mb-4 text-primary text-opacity-50">{{ $project->title }}</h3>
                            {{-- Owner Of The Project --}}
                            <p>
                                <a href="{{ route('client.view.profile', $project->client->name) }}" class="mb-4">
                                    <img src="{{ $project->client->PictureClient }}" height="50" width="50"
                                        class="rounded-circle">
                                    {{ Str::title($project->client->name) }}
                                </a>
                            </p>
                            <hr>

                            {{-- About Project --}}
                            <div class="col-12 mb-4">
                                <h3>
                                    {{ __('About Project') }}
                                </h3>
                                <p>{{ $project->description }}</p>
                            </div>
                            <hr>


                            {{-- Requirements --}}
                            <div class="col-12 mb-4">
                                <h3 class="mb-3">
                                    {{ __('Requirements') }}
                                </h3>
                                <div class="col-12 px-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-styled">
                                                @foreach ($project->skillsProject as $skill)
                                                    <li>{{ $skill }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>


                            {{-- Project details --}}
                            <div class="col-12 mb-4">
                                <h3 class="mb-3">{{ __('Other Details') }}</h3>
                                <ul class="list-styled">

                                    <li>
                                        <span class="text-info ">{{ __('Status') }}</span>
                                        <span
                                            class="float-right {{ $project->statusProject }}">{{ $project->status }}</span>
                                    </li>

                                    <li>
                                        <span class="text-info">{{ __('Budget') }}</span>
                                        <span class="float-right">{{ $project->budget }}</span>
                                    </li>

                                    <li>
                                        <span class="text-info">{{ __('Type') }}</span>
                                        <span class="float-right">{{ $project->type }}</span>
                                    </li>

                                    <li>
                                        <span class="text-info">{{ __('Delivery Period') }}</span>
                                        <span class="float-right">{{ $project->deliveryPeriodProject }}</span>
                                    </li>


                                    <li>
                                        <span class="text-info">{{ __('Number Of Offers') }}</span>
                                        <span
                                            class="float-right">{{ $project->comments_count ? $project->comments_count : 'There Are No Offers.' }}</span>
                                    </li>
                                </ul>
                            </div>
                            <hr>

                            {{-- Project Apply Now --}}
                            <h3 class="mb-3">{{ __('Apply Now') }}</h3>

                            @if (Auth::guard('web')->check())
                                @if ($project->status == 'open')
                                    <form action="{{ route('user.comment.store', $project->id) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <x-form.textarea-lable-error name="comment" rows="9"
                                            placeholder="Enter A Detailed Description On Your Submission To The Project" />
                                        <button class="btn btn-primary  mt-2" href="notice-single.html">
                                            {{ __('Send') }}
                                        </button>
                                    </form>
                                @else
                                    <h6 class="text-danger">
                                        {{ 'The Project Cannot Be Commented On Because It Has Been Closed  ' }} <i
                                            class="ti-face-sad"></i>
                                    </h6>
                                @endif
                            @else
                                <div class="col">
                                    <h6>{{ __('You Must Freelancer') }}
                                        <a href="{{ route('user.login') }}">
                                            {{ __('Sign In') }}
                                        </a>
                                        {{ __('Or') }}

                                        <a href="{{ route('user.register') }}">
                                            {{ __('Sign Up') }}
                                        </a>
                                        {{ __('To Comment On The Project') }}
                                    </h6>
                                </div>
                            @endif
                            <hr>

                            {{-- Project Presentations --}}
                            <section class="section pt-3">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="mb-3">{{ __('Presentations') }}</h3>
                                            <ul class="list-unstyled">
                                                <!-- Presentation item -->
                                                @forelse ($comments as $comment)
                                                    <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                                                        <div
                                                            class="d-md-table-cell text-center p-4 text-white mb-4 mb-md-0">
                                                            <img src="{{ $comment->user->PictureFreelancer }}"
                                                                class="rounded-circle" width="70px" height="70px">
                                                        </div>
                                                        <div
                                                            class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                                            <a href="{{ route('user.view.profile', $comment->user->name) }}"
                                                                class="h4 mb-3 d-block">
                                                                {{ $comment->user->name }}
                                                            </a>
                                                            <p class="mb-0">
                                                                {{ $comment->comment }}
                                                            </p>
                                                        </div>
                                                        <div class="d-md-table-cell text-right pr-0 pr-md-4">
                                                            <a>
                                                                {{ $comment->created_at->diffForHumans() }}
                                                            </a>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <div class="alert alert-danger m-auto w-100 text-center fw-bold ">
                                                        {{ 'There Are No Offers ' }} <i class="ti-face-sad"></i>
                                                    </div>
                                                @endforelse
                                            </ul>
                                            {{ $comments->links() }}
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- /Project Presentations -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Project details -->
@endsection






















{{-- ===================================================== --}}

{{-- <main class="container">

        <div class="pagetitle">
            <h1>Project</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Projects</li>
                    <li class="breadcrumb-item active">{{ $project->title }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card mb-3">
                        <div class="card-body pt-3">

                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <h5 class="card-title text-primary fw-bold">{{ 'Project Card ' }}</h5>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview">

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label ">Status</div>
                                        <div class="col-lg-2 col-md-8 {{ $project->statusProject }}">
                                            {{ $project->status }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Budget</div>
                                        <div class="col-lg-6 col-md-8">{{ $project->budget }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Type</div>
                                        <div class="col-lg-6 col-md-8">{{ $project->type }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Publishing Time</div>
                                        <div class="col-lg-6 col-md-8">{{ $project->created_at->diffForhumans() }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Delivery Period</div>
                                        <div class="col-lg-6 col-md-8">{{ $project->deliveryPeriodProject }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Number Of Offers</div>
                                        <div class="col-lg-6 col-md-8">
                                            {{ $project->comments_count ? $project->comments_count : 'There Are No Offers.' }}
                                        </div>
                                    </div>

                                </div>



                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body pt-3">

                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <h5 class="card-title text-primary fw-bold">{{ 'Owner Of The Project ' }}</h5>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">


                            <img src="{{ $project->client->PictureClient }}" alt="Profile" class="rounded-circle">
                            <a class="nav-link" href="">
                                <h2>{{ Str::title($project->client->name) }}</h2>
                            </a>
                            <h3>{{ Str::upper($project->client->company) }}</h3>
                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>



                </div>


                <div class="col-md-8">

                    <div class="card mb-3">
                        <div class="card-body pt-3">

                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">

                                    <h5 class="card-title text-primary fw-bold">{{ $project->title }}</h5>
                                </li>

                            </ul>

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">Project Details</h5>
                                    <p class="small fst-italic">{{ $project->description }}</p>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body pt-3">

                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <h5 class="card-title text-primary fw-bold">Skills Required</h5>
                                </li>

                            </ul>

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    @foreach ($project->skillsProject as $skill)
                                        <span class="badge rounded-pill text-bg-dark">{{ $skill }}</span>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mb-3">
                        <div class="card-body mb-1 ">

                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <h5 class="card-title text-primary fw-bold">Add Your Offer Now</h5>
                                </li>

                            </ul>

                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview">

                                    @if (Auth::guard('web')->check())
                                        <div class="col ">
                                            @if ($project->status == 'open')
                                                <form action="{{ route('user.comment.store', $project->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('POST')
                                                    <x-form.input-lable-error name="project_id" :value="$project->id"
                                                        type="hidden" />
                                                    <x-form.textarea-lable-error name="comment" rows="6"
                                                        placeholder="Enter A Detailed Description Of Your Project And Attach Examples Of What You Want If Possible." />
                                                    <div class="d-grid gap-2 col-6 mx-auto">
                                                        <button class="btn-outline-primary btn-sm w-25 m-auto mt-4"
                                                            type="submit">Send</button>
                                                    </div>
                                                </form>
                                            @else
                                                <h6 class="text-danger">
                                                    {{ 'The Project Cannot Be Commented On ! :( ' }}
                                                </h6>
                                            @endif
                                        </div>
                                    @else
                                        <div class="col">
                                            <h6>You Must Freelancer <a href="{{ route('user.login') }}">Sign
                                                    In</a> Or <a href="{{ route('user.register') }}">Sign Up</a>
                                                To Comment On The Project </h6>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mb-3">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <h5 class="card-title text-primary fw-bold">Presentations </h5>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview">
                                    @forelse ($comments as $comment)
                                        <div class="card mb-1">
                                            <div class="row g-0 ">
                                                <div class="col-md-1">
                                                    <small
                                                        class="badge rounded-pill text-bg-primary">{{ $comment->created_at->diffForHumans() }}</small>
                                                    <img src="{{ $comment->user->PictureFreelancer }}"
                                                        class="img-fluid rounded-circle w-75 m-3 " alt="...">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body mt-2">
                                                        <a class="card-link"
                                                            href="{{ route('user.view.profile', $comment->user->name) }}">
                                                            <h5 class="card-title ml-1">
                                                                {{ $comment->user->name }}
                                                            </h5>
                                                        </a>
                                                        <p class="card-text">{{ $comment->comment }} </p>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="alert alert-danger m-auto w-50 text-center fw-bold ">
                                            {{ 'There Are No Offers ! :(' }}
                                        </div>
                                    @endforelse
                                </div>
                                {{ $comments->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main> --}}
