@extends('admin.layouts.app')
@section('title', 'Elancer | Clients')

@section('content')

    @include('admin.layouts.inc.nav_sidebar')


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Clients</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item">{{ 'Clients' }}</li>
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
                                            {{ 'Projects' }}
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
                                    @forelse ($clients as $client)
                                        <tr>
                                            <td>
                                                {{ $client->id }}
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ $client->PictureClient }}" width="70px" height="50px">
                                            </td>

                                            <td>
                                                {{ $client->name }}
                                            </td>

                                            <td>
                                                {{ $client->email }}
                                            </td>

                                            <td>
                                                <a href="{{ route('admin.client.projects', $client->name) }}">
                                                    {{ $client->projects_count }}
                                                </a>
                                            </td>

                                            <td>
                                                {{ $client->created_at->diffForhumans() }}
                                            </td>

                                            <td class="text-center">

                                                @include('admin.pages.clients.show')

                                                @include('admin.pages.clients.delete')

                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="12">
                                            <div class="alert alert-danger text-center w-50 m-auto">
                                                <b>
                                                    {{ __('There Are No Clients !!') }}
                                                </b>
                                            </div>
                                        </td>
                                    @endforelse
                                </tbody>

                            </table>
                            <span class="float-end">

                                {{ $clients->links() }}
                            </span>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    @include('admin.layouts.inc.footer')

@endsection
