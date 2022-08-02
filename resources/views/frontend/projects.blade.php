@extends('frontend.layouts.app_front')

@section('title', 'Browse | projects')
@section('content')








    <!-- page title -->
    <section class="page-title-section overlay" data-background="{{ asset('frontend/images/backgrounds/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb mb-2">
                        <li class="list-inline-item"><a class="h2 text-primary font-secondary"
                                href="{{ route('front.home') }}">{{ __('Home') }}</a></li>
                        <li class="list-inline-item text-white h3 font-secondary nasted">
                            {{ __('ProJects') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <!-- Projects -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled">
                        <!-- Project item -->
                        @forelse ($projects as $project)
                            <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                                <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0 col-lg-1">
                                    <span class="h2 d-block">{{ $project->created_at->format('d') }}</span>
                                    {{ $project->created_at->format('M,Y') }}</div>
                                <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                    <a href="{{ route('front.show.project', $project->title) }}" class="h4 mb-3 d-block">
                                        {{ $project->title }}
                                    </a>
                                    <p class="mb-0">{{ Str::limit($project->description, 40, '...') }}</p>
                                    <p class="mb-0">
                                        <i
                                            class="ti-comment-alt">{{ $project->comments_count ? ' ' . $project->comments_count : ' Add The First Offer' }}</i>
                                    </p>
                                </div>
                                <div class="d-md-table-cell text-right pr-0" style="margin-bottom: 5px">
                                    <img src="{{ $project->client->PictureClient }}" height="50" width="50"
                                        class="rounded-circle">
                                    <a href="notice-single.html" class="btn btn-primary">
                                        {{ $project->client->name }}
                                    </a>
                                </div>
                            </li>
                        @empty
                            <div class=" alert alert-danger text-center w-50 mt-3 mb-3 m-auto">
                                <b>{{ __('There Are No Projects ') }}</b> <i class="ti-face-sad"></i>
                            </div>
                        @endforelse
                    </ul>
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- /Projects -->
















    {{-- ============================================================= --}}
    {{-- <main id="main" class="container">

        <div class="pagetitle">
            <h1>Projects</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item">Projects</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview">

                        @forelse ($projects as $project)
                            <div class="card  m-auto mb-4 mt-4">
                                <a class="nav-link" href="{{ route('front.show.project', $project->title) }}">
                                    <h5 class="card-header text-primary"><b>{{ $project->title }}</b></h5>
                                    <div class="card-body">
                                        <p class="card-text overflow-visible ">
                                            {{ Str::limit($project->description, 40, '...') }}
                                        </p>
                                </a>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    @if (Auth::guard('web')->check())
                                    @else
                                        <h6>You Must Freelancer <a href="{{ route('user.login') }}">Sign
                                                In</a> Or <a href="{{ route('user.register') }}">Sign Up</a>
                                            To Comment On The Project </h6>
                                    @endif
                                </div>

                            </div>
                            <div class="card-footer">
                                <small class="text-muted">
                                    <i class="bi bi-person-fill ">
                                        <a class="nav-link d-inline-block" href="">
                                            {{ $project->client->name }}
                                        </a>
                                    </i>
                                    <i class="bi bi-clock-fill m-1">
                                        {{ $project->created_at->diffForHumans() }}</i>
                                    <i
                                        class="bi bi-chat-text-fill m-1">{{ $project->comments_count ? ' ' . $project->comments_count : ' Add The First Offer' }}</i>
                                </small>
                            </div>
                        @empty
                            <div class=" alert alert-danger text-center w-50 mt-3 mb-3 m-auto">
                                <b>{{ __('There Are No Projects ! :(') }}</b>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </main> --}}
@endsection
