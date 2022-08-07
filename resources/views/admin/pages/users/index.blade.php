@extends('admin.layouts.app')
@section('title', 'Elancer | Freelancers')

@section('content')

    @include('admin.layouts.inc.nav_sidebar')


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Freelancers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item">{{ 'Freelancers' }}</li>
                    {{-- <li class="breadcrumb-item active">Data</li> --}}
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            {{-- @include('admin.pages.categories.create') --}}

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>

                                        <th class="text-center">
                                            {{ 'Image' }}
                                        </th>

                                        <th>
                                            {{ 'Name' }}
                                        </th>

                                        <th>
                                            {{ 'Email' }}
                                        </th>

                                        <th>
                                            {{ 'Latest Works' }}
                                        </th>

                                        <th>
                                            {{ 'Comments' }}
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
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>

                                                {{ $user->id }}

                                            </td>
                                            <td class="text-center">
                                                <img src="{{ $user->PictureFreelancer }}" width="70 px" height="50px">
                                            </td>

                                            <td>
                                                {{ $user->name }}
                                            </td>

                                            <td>
                                                {{ $user->email }}
                                            </td>

                                            <td>
                                                <a href="{{ route('user.view.profile', $user->slug) }}">
                                                    {{ $user->latestwork_count }}
                                                </a>
                                            </td>

                                            <td>
                                                {{ $user->comments_count }}
                                            </td>

                                            <td>
                                                {{ $user->created_at->diffForhumans() }}
                                            </td>

                                            <td class="text-center">

                                                @include('admin.pages.users.show')

                                                @include('admin.pages.users.delete')

                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="12">
                                            <div class="alert alert-danger text-center w-50 m-auto">
                                                <b>
                                                    {{ __('There Are No Users !!') }}
                                                </b>
                                            </div>
                                        </td>
                                    @endforelse
                                </tbody>

                            </table>
                            <span class="float-end">

                                {{ $users->links() }}
                            </span>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    @include('admin.layouts.inc.footer')

@endsection
