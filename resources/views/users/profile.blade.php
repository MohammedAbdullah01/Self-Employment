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
                                    <a class="text-color">
                                        <i class="ti-email mr-2"></i>
                                        {{ $user->email }}
                                    </a>
                                </li>


                                <li class="mb-3">
                                    <a class="text-color">
                                        <i class="ti-user mr-2"></i>
                                        {{ $user->profile->gander }}
                                    </a>
                                </li>

                                <li class="mb-3">
                                    <a class="text-color">
                                        <i class="ti-mobile mr-2"></i>
                                        {{ $user->profile->phone }}
                                    </a>
                                </li>

                                <li class="mb-3">
                                    <a class="text-color">
                                        <i class="ti-alarm-clock mr-2"></i>
                                        {{ $user->profile->hourlyRates }}
                                    </a>
                                </li>

                                <li class="mb-3">
                                    <a class="text-color">
                                        <i class="ti-location-pin mr-2"></i>
                                        {{ $user->profile->country }}
                                    </a>
                                </li>

                                <li class="mb-3">
                                    <a class="text-color" href="{{ $user->profile->github }}">
                                        <i class="ti-github mr-2"></i>
                                    </a>
                                </li>

                                <li class="mb-3">
                                    <a class="text-color" href="{{ $user->profile->twitter }}">
                                        <i class="ti-twitter-alt mr-2"></i>
                                    </a>
                                </li>

                                <li class="mb-3">
                                    <a class="text-color" href="{{ $user->profile->linkedin }}">
                                        <i class="ti-linkedin mr-2"></i>
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
                        {{ __('My Latest Work') }}

                        <!-- Count Lattest Works -->
                        ({{ $user->latestwork_count ?? '' }})
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
                            <img class="card-img-top rounded-0" src="{{ $work->pictureLatestWorks }}" height="300px"
                                alt="course thumb">
                            <div class="card-body">
                                <ul class="list-inline mb-2">
                                    <li class="list-inline-item">
                                        <i class="ti-calendar mr-1 text-info"></i>
                                        {{ $work->created_at->diffForhumans() }}
                                    </li>
                                    <li class="list-inline-item"><a class="text-color" href="#">
                                            <i class="ti-archive mr-1 text-info"></i>
                                            {{ $work->category->name }}
                                        </a>
                                    </li>
                                </ul>
                                <a>
                                    <h4 class="card-title">{{ Str::limit($work->title, 30, '...') }}</h4>
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
                            ( {{ $user->commendProjects()->count() }} )
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
