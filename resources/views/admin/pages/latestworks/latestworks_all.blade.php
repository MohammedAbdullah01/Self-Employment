@extends('admin.layouts.app')
@section('title', 'Latest Works')

@section('content')

    @include('admin.layouts.inc.nav_sidebar')


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Latest Works</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item">{{ __('users') }}</li>
                    <li class="breadcrumb-item ">{{ __('Latest Works') }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>

                                        <th class="text-center">
                                            {{ 'Main Photo' }}
                                        </th>

                                        <th>
                                            {{ 'title' }}
                                        </th>

                                        <th colspan="5">
                                            {{ 'Description' }}
                                        </th>

                                        <th>
                                            {{ 'User' }}
                                        </th>

                                        <th>
                                            {{ 'created At' }}
                                        </th>

                                        <th class="text-center">
                                            {{ 'Actions' }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($latestworks as $latestwork)
                                        <tr>
                                            <td>
                                                {{ $latestwork->id }}
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ $latestwork->pictureLatestWorks }}" width="100px" height="70px">
                                            </td>

                                            <td>
                                                {{ $latestwork->title }}
                                            </td>

                                            <td colspan="5">
                                                {{ Str::limit($latestwork->description, 15, '...') }}
                                            </td>

                                            <td>
                                                {{ $latestwork->user->name }}
                                            </td>

                                            <td>
                                                {{ $latestwork->created_at->diffForhumans() }}
                                            </td>

                                            <td class="text-center">

                                                @include('admin.pages.latestworks.delete')

                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="12">
                                            <div class="alert alert-danger text-center w-50 m-auto">
                                                <b>
                                                    {{ __('There Are No latestworks !!') }}
                                                </b>
                                            </div>
                                        </td>
                                    @endforelse
                                </tbody>

                            </table>
                            <span class="float-end">

                                {{ $latestworks->links() }}
                            </span>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    @include('admin.layouts.inc.footer')

@endsection
