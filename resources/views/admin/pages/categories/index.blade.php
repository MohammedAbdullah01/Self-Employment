@extends('admin.layouts.app')
@section('title', 'Elancer | Dashboard')

@section('content')

    @include('admin.layouts.inc.nav_sidebar')


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Categories</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item">{{ 'Categories' }}</li>
                    {{-- <li class="breadcrumb-item active">Data</li> --}}
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            @include('admin.pages.categories.create')

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

                                        <th colspan="5">
                                            {{ 'Description' }}
                                        </th>

                                        <th>

                                            {{ 'Parent Categorie' }}
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
                                    @forelse ($categories as $cate)
                                        <tr>
                                            <td>
                                                {{ $cate->id }}
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ $cate->PictureCategory }}" width="100px" height="70px">
                                            </td>

                                            <td>
                                                {{ $cate->name }}
                                            </td>

                                            <td colspan="5">
                                                {{ Str::limit($cate->description, 15, '...') }}
                                            </td>

                                            <td>
                                                {{ $cate->parent->name }}
                                            </td>

                                            <td>
                                                {{ $cate->created_at->diffForhumans() }}
                                            </td>

                                            <td class="text-center">

                                                @include('admin.pages.categories.edit')

                                                @include('admin.pages.categories.show')

                                                @include('admin.pages.categories.delete')

                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="12">
                                            <div class="alert alert-danger text-center w-50 m-auto">
                                                <b>
                                                    {{ __('There Are No Categories !!') }}
                                                </b>
                                            </div>
                                        </td>
                                    @endforelse
                                </tbody>

                            </table>
                            <span class="float-end">

                                {{ $categories->links() }}
                            </span>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    @include('admin.layouts.inc.footer')

@endsection
