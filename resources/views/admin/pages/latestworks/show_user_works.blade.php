@extends('admin.layouts.app')
@section('title', 'Elancer | Dashboard')

@section('content')

    @include('admin.layouts.inc.nav_sidebar')


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Latest Works Freelancer</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item">{{ 'LatestWorks' }}</li>
                    <li class="breadcrumb-item active">{{$user->name}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row ">
                <div class="card text-center mt-5 ">
                    <div class="card-header">
                        <h4 class="nav-item float-start">
                            {{ __('Business Exhibition') }}
                            {{ $user->latestwork_count ? '( ' . $user->latestwork_count . ' )' : '' }}
                        </h4>

                    </div>
                    <div class="card-body">

                        <div class="row ">
                            @forelse ($latestwork as $work)
                                <div class="col-md-3">
                                    <div class="card" >
                                        <img src="{{ $work->pictureLatestWorks }}" class="card-img-top img-thumbnail "
                                            height="100px" width="100" alt="...">
                                        <div class="card-body">

                                            <a href="#" class="card-link text-primary">
                                                <h5 class="card-title" data-bs-toggle="modal"
                                                    data-bs-target="#show_gallery{{ $work->id }}">{{ $work->title }}
                                                </h5>
                                            </a>
                                            @include('users.modal.show')

                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">{{ $work->created_at->diffForhumans() }}</small>
                                            <span class="float-end">
                                                @include('admin.pages.latestworks.delete')
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @empty

                                <div class=" alert alert-danger text-center mt-3 m-auto">
                                    <b>{{ __('There Are No Works ! :(') }}</b>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <span class="m-auto">
                        {{ $latestwork->links() }}
                    </span>
                </div>
            </div>
        </section>
    </main>

    @include('admin.layouts.inc.footer')

@endsection
