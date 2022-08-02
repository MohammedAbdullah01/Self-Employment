<!-- header -->
<header class="fixed-top header">
    <!-- top header -->
    <div class="top-header py-2 bg-white">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-4 text-center text-lg-left">
                    <a class="text-color mr-3" href="tel:+443003030266"><strong>CALL</strong> +44 300 303 0266</a>
                    <ul class="list-inline d-inline">
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color"
                                href="https://facebook.com/themefisher/"><i class="ti-facebook"></i></a></li>
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color"
                                href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color"
                                href="https://github.com/themefisher"><i class="ti-github"></i></a></li>
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color"
                                href="https://instagram.com/themefisher/"><i class="ti-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-8 text-center text-lg-right">
                    <ul class="list-inline">
                        @if (Auth::guard('web')->check())
                            <li class="list-inline-item">
                                <img src="{{ Auth::guard('web')->user()->PictureFreelancer }}" height="30"
                                    width="40" alt="Profile" class="rounded-circle">
                                <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                                    href="{{ route('user.profile', Auth::guard('web')->user()->name) }}">{{ Auth::guard('web')->user()->name }}</a>
                                    <form class="d-inline-block" action="{{ route('user.logout') }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <button class="btn btn-outline-danger btn-sm" type="submit">
                                            <i class="ti-lock"></i>
                                            {{'Log Out'}}
                                        </button>
                                    </form>
                            </li>
                        @endif

                        @if (Auth::guard('client')->check())
                            <li class="list-inline-item">
                                <img src="{{ Auth::guard('client')->user()->PictureClient }}" height="30"
                                    width="40" alt="Profile" class="rounded-circle">
                                <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                                    href="{{ route('client.profile', Auth::guard('client')->user()->name) }}">{{ Auth::guard('client')->user()->name }}</a>
                                    <form class="d-inline-block" action="{{ route('client.logout') }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <button class="btn btn-outline-danger btn-sm" type="submit">
                                            <i class="ti-lock"></i>
                                            {{'Log Out'}}
                                        </button>
                                    </form>
                            </li>
                        @endif
                        @if (!Auth::guard('client')->check() && !Auth::guard('web')->check())
                            <li class="list-inline-item"><a
                                    class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{route('user.login')}}">login</a></li>
                            <li class="list-inline-item"><a
                                    class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{route('user.register')}}" >register</a></li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- navbar -->
    <div class="navigation w-100">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark p-0">
                <a class="navbar-brand" href="index.html"><img src="{{ asset('frontend/images/logo.png') }}"
                        alt="logo"></a>
                <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto text-center">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('front.projects') }}">
                                {{ __('Browse Projects') }}
                            </a>


                        </li>
                        <li class="nav-item @@about">
                            <a class="nav-link" href="about.html">{{ __('Find Independents') }}</a>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Categories') }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="teacher.html">Teacher</a></li>
                                <li><a class="dropdown-item" href="teacher-single.html">Teacher Single</a></li>
                                <li><a class="dropdown-item" href="notice.html">Notice</a></li>
                                <li><a class="dropdown-item" href="notice-single.html">Notice Details</a></li>
                                <li><a class="dropdown-item" href="research.html">Research</a></li>
                                <li><a class="dropdown-item" href="scholarship.html">Scholarship</a></li>
                                <li><a class="dropdown-item" href="course-single.html">Course Details</a></li>
                                <li><a class="dropdown-item" href="event-single.html">Event Details</a></li>
                                <li><a class="dropdown-item" href="blog-single.html">Blog Details</a></li>

                                <li class="dropdown-item dropdown dropleft">
                                    <a class="dropdown-toggle" href="#" id="navbarDropdownSubmenu"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Sub Menu
                                    </a>
                                    <ul class="dropdown-menu dropdown-submenu"
                                        aria-labelledby="navbarDropdownSubmenu">
                                        <li><a class="dropdown-item" href="#!">Sub Menu 01</a></li>
                                        <li><a class="dropdown-item" href="#!">Sub Menu 02</a></li>
                                        <li><a class="dropdown-item" href="#!">Sub Menu 03</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @@contact">
                            <a class="nav-link" href="contact.html">CONTACT</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- /header -->


<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>Register</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login">
                    <form action="#" class="row">
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="signupPhone" name="signupPhone"
                                placeholder="Phone">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="signupName" name="signupName"
                                placeholder="Name">
                        </div>
                        <div class="col-12">
                            <input type="email" class="form-control mb-3" id="signupEmail" name="signupEmail"
                                placeholder="Email">
                        </div>
                        <div class="col-12">
                            <input type="password" class="form-control mb-3" id="signupPassword"
                                name="signupPassword" placeholder="Password">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">SIGN UP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>Login</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.check') }}" method="POST" class="row">
                    @csrf
                    @method('POST')
                    <div class="col-12">
                        <x-form.input-lable-error type="email" name="email" placeholder="E-mail" />
                        <i class="bi bi-lock-fill"></i>
                    </div>
                    <div class="col-12">
                        <x-form.input-lable-error type="password" name="password" placeholder="Password" />
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">LOGIN</button>
                    </div>
                    <div class="col-12">
                        <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                            href="{{ route('user.forgot.password') }}">
                            <p>{{ __('Forgot Your Password ?') }}</p>
                        </a>
                        <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#loginModal"
                            data-toggle="modal" data-target="#loginModal">
                            {{ __('Forgot Your Password ?') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




{{-- ------------------------------ Old------------------------------------- --}}
{{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2  m-auto ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('front.home') }}">
                        {{ __('Home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('front.projects') }}">
                        {{ __('Browse Projects') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">
                        {{ __('Find Independents') }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('Categories') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav justify-content-end">

                @if (!Auth::guard('client')->check() && !Auth::guard('web')->check())
                    <li class="nav-item dropdown te">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false">
                            {{ __('Sig In') }}
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('user.login') }}">
                                    {{ __('Freelancer Sig In') }}</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('client.login') }}">
                                    {{ __('Client Sig In') }}</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false">
                            {{ __('Register') }}
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ __('Freelancer Register') }}">
                                    {{ __('Freelancer Register') }}</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('client.register') }}">
                                    {{ __('Client Register') }}</a></li>
                        </ul>
                    </li>
                @endif



                @if (Auth::guard('client')->check())
                    <x-notifications-menu />



                    <li class="nav-item dropdown te ">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false">
                            <img src="{{ Auth::guard('client')->user()->PictureClient }}" height="30"
                                alt="Profile" class="rounded-circle">
                            {{ Auth::guard('client')->user()->name }}
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="{{ route('client.profile', Auth::guard('client')->user()->name) }}">
                                    <i class="bi bi-person"></i> {{ __('My Profile') }}</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('client.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('client_logout').submit();">
                                    <i class="bi bi-box-arrow-right"></i>
                                    {{ __('Sign Out') }}
                                </a>
                                <form action="{{ route('client.logout') }}" method="post" id="client_logout">
                                    @csrf
                                    @method('POST')
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::guard('web')->check())
                    <li class="nav-item dropdown te ">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false">
                            <img src="{{ Auth::guard('web')->user()->PictureFreelancer }}" height="30"
                                alt="Profile" class="rounded-circle">
                            {{ Auth::guard('web')->user()->name }}
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="{{ route('client.profile', Auth::guard('web')->user()->name) }}">
                                    <i class="bi bi-person"></i> {{ __('My Profile') }}</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('user.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('user_logout').submit();">
                                    <i class="bi bi-box-arrow-right"></i>
                                    {{ __('Sign Out') }}
                                </a>
                                <form action="{{ route('user.logout') }}" method="post" id="user_logout">
                                    @csrf
                                    @method('POST')
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav> --}}
