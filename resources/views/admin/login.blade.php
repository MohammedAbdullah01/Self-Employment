@extends('admin.layouts.app')
@section('title', 'Elancer | AdminLogin')

@section('content')

    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">{{ __('EduCenter') }}</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">
                                        {{ __('Login to Your Account') }}
                                    </h5>

                                    <p class="text-center small">
                                        {{ __('Enter your email & password to login') }}
                                    </p>
                                </div>

                                <form class="row g-3 needs-validation" novalidate action="{{ route('admin.store.login') }}"
                                    method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="bi bi-envelope-fill"></i>
                                            </div>
                                        </div>
                                        <x-form.input-lable-error type="email" name="email" placeholder="Email" />

                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="bi bi-lock-fill"></i>
                                            </div>
                                        </div>
                                        <x-form.input-lable-error type="password" name="password" placeholder="password" />

                                    </div>

                                    <div class="row">
                                        {{-- <div class="col-8">
                                            <div class="icheck-primary">
                                                <input type="checkbox" id="remember">
                                                <label for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div> --}}
                                        <div class="col-4 d-grid gap-2 col-6 mx-auto">
                                            <button type="submit" class="btn btn-outline-primary btn-sm btn-block">
                                                {{ __('Sign In') }}
                                            </button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                        <div class="credits">
                            Designed by <a href="https://github.com/MohammedAbdullah01">Mohamed Abdullah 01</a>
                        </div>

                    </div>
                </div>

        </section>

    </div>
@endsection
