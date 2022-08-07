@extends('frontend.layouts.app_front')

@section('title', 'Freelancers')
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
                            {{ __('Freelancers') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->


    {{-- Find Freelancers --}}
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-5">{{ __('Find Freelancers') }}</h3>
                    <ul class="list-unstyled col-lg-10 m-auto">
                        <!-- Project item -->
                        @forelse ($freelancers as $freelancer)
                            <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                                <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0 col-lg-1">
                                    <img src="{{ $freelancer->PictureFreelancer }}" class="rounded-circle h2 d-block"
                                        width="70px" height="70px">
                                </div>
                                <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                    <a href="{{ route('user.view.profile', $freelancer->slug) }}" class="h4 mb-3 d-block">
                                        {{ $freelancer->name }}
                                    </a>
                                    <p class="mb-0">{{ $freelancer->profile->title_job }}</p>
                                    <p class="mb-0">
                                        {{ $freelancer->profile->about_me }}
                                    </p>
                                </div>
                                <div class="d-md-table-cell mb-3 pr-0 pr-md-4 float-end">
                                    <a href="{{ route('user.view.profile', $freelancer->slug) }}" class="btn btn-primary">
                                        {{ 'View Profile' }}
                                    </a>
                                </div>
                            </li>
                        @empty
                            <div class=" alert alert-danger text-center w-50 mt-3 mb-3 m-auto">
                                <b>{{ __('There Are No Projects ') }}</b> <i class="ti-face-sad"></i>
                            </div>
                        @endforelse
                    </ul>
                    {{ $freelancers->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- /Find Freelancers -->

@endsection
