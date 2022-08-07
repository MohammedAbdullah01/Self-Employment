@extends('frontend.layouts.app_front')

@section('title', 'Contact')
@section('content')

    <!-- page title -->
    <section class="page-title-section overlay" data-background="{{ asset('frontend/images/backgrounds/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb mb-2">
                        <li class="list-inline-item"><a class="h2 text-primary font-secondary"
                                href="{{ route('front.home') }}">{{ __('Home') }}</a></li>
                        <li class="list-inline-item text-white h3 font-secondary nasted">
                            {{ __('Contact') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <!-- contact -->
    <section class="section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-title">Contact Us</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <form action="/contact.html" method="POST">
                        <input type="text" class="form-control mb-3" id="name" name="name"
                            placeholder="Your Name" required>
                        <input type="email" class="form-control mb-3" id="mail" name="mail"
                            placeholder="Your Email" required>
                        <input type="text" class="form-control mb-3" id="subject" name="subject" placeholder="Subject"
                            required>
                        <textarea name="message" id="message" class="form-control mb-3" placeholder="Your Message" required></textarea>
                        <button type="submit" value="send" class="btn btn-primary">SEND MESSAGE</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit recusandae voluptates
                        doloremque veniam temporibus porro culpa ipsa, nisi soluta minima saepe laboriosam debitis nesciunt.
                        Dolore, labore. Accusamus nulla sed cum aliquid exercitationem debitis error harum porro maxime quo
                        iusto aliquam dicta modi earum fugiat, vel possimus commodi, deleniti et veniam, fuga ipsum
                        praesentium. Odit unde optio nulla ipsum quae obcaecati! Quod esse natus quibusdam asperiores quam
                        vel, tempore itaque architecto ducimus expedita</p>
                    <a href="tel:+8802057843248" class="text-color h5 d-block">+880 20 5784 3248</a>
                    <a href="mailto:yourmail@email.com" class="mb-5 text-color h5 d-block">yourmail@email.com</a>
                    <p>71 Shelton Street<br>London WC2H 9JQ England</p>
                </div>
            </div>
        </div>
    </section>
    <!-- /contact -->
@endsection
