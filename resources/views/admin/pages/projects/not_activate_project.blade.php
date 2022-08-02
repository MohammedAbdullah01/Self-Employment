@extends('admin.layouts.app')
@section('title', 'Elancer | Not Activated Projects')

@section('content')

    @include('admin.layouts.inc.nav_sidebar')


    <main id="main" class="main">
        <div class="pagetitle">
            <h1>All Not Activated Projects</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Projects</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="card  mt-5 ">
                    <div class="card-header">
                        <h4 class="nav-item ">
                            {{ __('Latest Projects') }}
                            <span class=" badge bg-primary float-end">
                                {{ $projects_not_activate->count() }}
                            </span>
                        </h4>

                    </div>
                    <div class="card-body">

                        <div class="row row-cols-1 row-cols-md-2 g-4">

                            @forelse ($projects_not_activate as $project)
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
                                                action="{{ route('admin.project.activat', $project->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-outline-warning btn-sm">
                                                    <i class="bi bi-check2-square"></i>
                                                </button>
                                            </form>

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
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-danger text-center w-50 m-auto mt-4">
                                    <b>{{ __('There Are No Not Active Projects :(') }}</b>
                                </div>
                            @endforelse

                        </div>

                    </div>
                    <span class="m-auto">
                        {{ $projects_not_activate->links() }}
                    </span>
                </div>


            </div>
        </section>
    </main>
@endsection
