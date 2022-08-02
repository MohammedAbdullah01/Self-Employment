@extends('admin.layouts.app')
@section('title', 'Elancer | Client Projects')

@section('content')

    @include('admin.layouts.inc.nav_sidebar')


    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Projects</li>
                    <li class="breadcrumb-item active">{{ $client->name }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="card  mt-5 ">
                    <div class="card-header">
                        <h4 class="nav-item float-start">
                            {{ __('Latest Projects') }}
                            @if ($client->projects_count)
                                <span class=" badge bg-primary">
                                    {{ $client->projects_count }}
                                </span>
                            @endif
                        </h4>

                    </div>
                    <div class="card-body">

                        <div class="row row-cols-1 row-cols-md-2 g-4">

                            @forelse ($projects as $project)
                                <div class="col-md-3">
                                    <div class="card">

                                        <div class="card-body">
                                            <span class="float-end badge rounded-pill text-bg-primary">
                                                {{ $project->created_at->diffForhumans() }}
                                            </span>
                                            <a class="nav-link" href="{{ route('admin.project.show', $project->title) }}">
                                                <h5 class="card-title">{{ $project->title }}
                                            </a>

                                            </h5>
                                            <span
                                                class="float-end {{ $project->statusProject }} ">{{ $project->status }}</span>
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
                                                @foreach ($project->skillsProject as $skill)
                                                    <span class="float-end text-right badge bg-primary m-1">
                                                        {{ $skill }}
                                                    </span>
                                                @endforeach
                                            </li>
                                        </ul>
                                        <div class="card-footer">
                                            <small>{{ 'Comments: ' . $project->comments()->count() }}</small>
                                            <small class="float-end">{{ $project->created_at->diffForHumans() }}</small>
                                        </div>

                                        {{-- <div class="card-footer"> --}}
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
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

                                        @if (Auth::guard('web')->check())
                                            @if ($project->status == 'open')
                                                @include('users.comments.create')
                                            @else
                                                <h6 class="text-danger text-center">
                                                    {{ 'The Project Cannot Be Commented On ! :( ' }}
                                                </h6>
                                            @endif
                                        @endif
                                        {{-- </div> --}}
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
    </main>





@endsection
