@extends('admin.layouts.app')
@section('title', 'Elancer | Comments')

@section('content')

    @include('admin.layouts.inc.nav_sidebar')


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Comments</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item">{{ 'Comments' }}</li>
                    {{-- <li class="breadcrumb-item active">Data</li> --}}
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>

                                        <th colspan="5">
                                            {{ 'Comment' }}
                                        </th>

                                        <th>
                                            {{ 'Project' }}
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
                                    @forelse ($comments as $comment)
                                        <tr>
                                            <td>
                                                {{ $comment->id }}
                                            </td>
                                            <td colspan="5">
                                                {{ Str::limit($comment->comment, 15, '...') }}
                                            </td>

                                            <td>
                                                {{ $comment->project->title }}
                                            </td>

                                            <td>
                                                {{ $comment->user->name }}
                                            </td>

                                            <td>
                                                {{ $comment->created_at->diffForhumans() }}
                                            </td>

                                            <td class="text-center">

                                                @include('admin.pages.comments.show')

                                                @include('admin.pages.comments.delete')

                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="12">
                                            <div class="alert alert-danger text-center w-50 m-auto">
                                                <b>
                                                    {{ __('There Are No Comments !!') }}
                                                </b>
                                            </div>
                                        </td>
                                    @endforelse
                                </tbody>

                            </table>
                            <span class="float-end">

                                {{ $comments->links() }}
                            </span>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    @include('admin.layouts.inc.footer')

@endsection
