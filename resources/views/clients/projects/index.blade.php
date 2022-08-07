@extends('clients.layouts.client_layouts')

@section('title', 'Projects')

@section('content')

    <div class="row page-titles mx-0 mb-1">
        <h4 class="card-title">
            {{ __('Projects') }}
        </h4>
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <a href="{{ route('client.create.project') }}" class="btn btn-flat btn-outline-secondary btn-sm">
                    {{ __('Create Project') }}
                </a>
            </ol>
        </div>
    </div>

    {{-- My Projects --}}
    <div class="col-lg-12">
        @forelse ($projects as $project)
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $project->title }}
                        <a href="{{ route('client.edit.project', $project->title) }}"
                            class="btn btn-outline-success btn-sm m-1 ">
                            {{ __('Edit') }}
                        </a>
                        <span class="float-right label label-pill label-dark">
                            {{ $project->created_at->diffForhumans() }}
                        </span>

                    </h4>

                    <div class="bootstrap-media">
                        <ul class="list-unstyled">
                            <li class="media">
                                {{-- <img class="mr-3" src="images/avatar/1.jpg" alt="Generic placeholder image"> --}}
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1"></h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item ">
                                            {{ __('Type') }}
                                            <span class="float-right text-primary">
                                                {{ $project->type }}
                                            </span>
                                        </li>
                                        <li class="list-group-item ">
                                            {{ __('Budget') }}
                                            <span class="float-right text-primary">
                                                {{ $project->budget }}
                                            </span>
                                        </li>
                                        <li class="list-group-item ">
                                            {{ __('Delivery time') }}
                                            <span class="float-right text-primary">
                                                {{ $project->delivery . ' Days' }}
                                            </span>
                                        </li>

                                        <li class="list-group-item ">
                                            {{ __('Category') }}
                                            <span class="float-right text-primary">
                                                {{ $project->category->parent->name }} / {{ $project->category->name }}
                                            </span>
                                        </li>
                                        <li class="list-group-item  ">
                                            {{ __('Skills') }}
                                            @foreach (explode(',', $project->skills) as $item)
                                                <span class="float-right label label-pill label-primary m-1">
                                                    {{ Str::upper($item) }}
                                                </span>
                                            @endforeach
                                        </li>
                                    </ul>
                                    <p class="mb-0">
                                    <form action="{{ route('client.delete.project', $project->id) }}" method="post">
                                        <button class="btn btn-outline-primary btn-sm mt-2 " type="button"
                                            data-bs-toggle="collapse" data-bs-target="#more_details" aria-expanded="false"
                                            aria-controls="collapseWidthExample">
                                            {{ __('More Details ') }}
                                        </button>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm mt-2" type="submit">
                                            {{ __('Remove') }}
                                        </button>
                                    </form>
                                    </p>
                                    <div>
                                        <div class="collapse collapse-horizontal" id="more_details">
                                            <div class="card card-body" style="width: 300px;">
                                                {{ $project->description }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-danger text-center w-75 m-auto">
                <b>{{ __('No Projects Added ! :(') }}</b>
            </div>
        @endforelse

    </div>
@endsection
