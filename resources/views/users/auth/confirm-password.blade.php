@extends('frontend.layouts.app_front')

@section('title', 'Freelancer | Confirm Password')
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
                            {{ __('Confirm Password') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <!-- Confirm Password Freelancer -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-2 order-md-1">
                    <h2 class="section-title">
                        {{ __('Confirm Password ') }}
                    </h2>
                    <form action="{{ route('user.confirm.password.update') }}" method="POST" class="row">
                        @csrf
                        @method('PUT')

                        @include('inc.__confirm-password')

                        <div class="col-12">
                            <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                                href="{{ route('user.login') }}">
                                <p>{{ __('Sign In') }}</p>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /Confirm Password Freelancer -->
@endsection
