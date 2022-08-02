@extends('admin.layouts.app')
@section('title', 'Elancer | Dashboard')

@section('content')

    @include('admin.layouts.inc.nav_sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Project</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item">Project</li>
                    <li class="breadcrumb-item active">{{ $project->title }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
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
                                                        class="badge bg-primary">{{ $comment->created_at->diffForHumans() }}</small>
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
    </main>

    @include('admin.layouts.inc.footer')

@endsection
