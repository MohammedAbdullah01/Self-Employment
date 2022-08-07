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
                    <p class="mb-5">{{ Str::limit($client->profile->about_me, 100, '...') }}</p>
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
                                        {{ $client->profile->phone }}
                                    </a>
                                </li>

                                <li class="mb-3">
                                    <a class="text-color">
                                        <i class="ti-location-pin mr-2"></i>
                                        {{ $client->profile->country }}
                                    </a>
                                </li>

                                <li class="mb-3">
                                    <a class="text-color">
                                        <i class="ti-home mr-2"></i>
                                        {{ $client->profile->company }}
                                    </a>
                                </li>

                                <li class="mb-3">
                                    <a class="text-color">
                                        <i class="ti-world mr-2"></i>
                                        {{ $client->profile->link }}
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
                    <p class="mb-2">{{ $client->profile->about_me }} </p>
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
                        ( {{ $client->projects_count ?? '' }} )
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

















