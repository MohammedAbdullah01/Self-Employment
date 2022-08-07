@extends('frontend.layouts.app_front')

@section('title', 'ProJects IN Category')
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
                            {{ __('ProJects IN Category') }}
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
                                    {{ $project->created_at->format('M,Y') }}
                                </div>
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
                                    <a href="{{route('client.view.profile' ,$project->client->slug )}}" class="btn btn-primary">
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
@endsection
