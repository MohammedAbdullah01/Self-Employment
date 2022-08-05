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
                                        <x-form.input-lable-error type="hidden" name="project_id"
                                            value="{{ $project->id }}" />
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
                                                            <a href="{{ route('user.view.profile', $comment->user->slug) }}"
                                                                class="h4 mb-3 d-block">
                                                                {{ $comment->user->name }}
                                                                <p class="float-right">
                                                                    {{ $comment->created_at->diffForHumans() }}
                                                                </p>
                                                            </a>
                                                            <p class="mb-0">
                                                                {{ $comment->comment }}
                                                            </p>
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
