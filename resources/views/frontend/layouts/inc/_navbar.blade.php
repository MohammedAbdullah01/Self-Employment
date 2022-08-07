<!-- header -->
<header class="fixed-top header">
    <!-- top header -->
    <div class="top-header py-2 bg-white">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-4  text-lg-left">

                    @if (Auth::guard('client')->check())
                        <x-notifications-menu />
                    @endif
                </div>

                <div class="col-lg-8  text-lg-right">
                    <ul class="nav justify-content-end">
                        @if (Auth::guard('web')->check())
                            <li class="list-inline-item">
                                <img src="{{ Auth::guard('web')->user()->PictureFreelancer }}" height="30"
                                    width="40" alt="Profile" class="rounded-circle">
                                <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                                    href="{{ route('user.profile', Auth::guard('web')->user()->slug) }}">{{ Auth::guard('web')->user()->name }}</a>
                                <form class="d-inline-block" action="{{ route('user.logout') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-outline-danger btn-sm" type="submit">
                                        <i class="ti-lock"></i>
                                        {{ 'Log Out' }}
                                    </button>
                                </form>
                            </li>
                        @endif

                        @if (Auth::guard('client')->check())
                            <li class="list-inline-item">
                                <img src="{{ Auth::guard('client')->user()->PictureClient }}" height="30"
                                    width="40" alt="Profile" class="rounded-circle">
                                <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                                    href="{{ route('client.profile', Auth::guard('client')->user()->slug) }}">{{ Auth::guard('client')->user()->name }}</a>
                                <form class="d-inline-block" action="{{ route('client.logout') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-outline-danger btn-sm" type="submit">
                                        <i class="ti-lock"></i>
                                        {{ 'Log Out' }}
                                    </button>
                                </form>
                            </li>
                        @endif
                        @if (!Auth::guard('client')->check() && !Auth::guard('web')->check())
                            <li class="list-inline-item"><a
                                    class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                                    href="{{ route('user.login') }}">login</a></li>
                            <li class="list-inline-item"><a
                                    class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                                    href="{{ route('user.register') }}">register</a></li>
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
                <a class="navbar-brand" href="{{ route('front.home') }}"><img
                        src="{{ asset('frontend/images/logo.png') }}" alt="logo"></a>
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
                            <a class="nav-link" href="{{ route('front.freelancers') }}">
                                {{ __('Find Independents') }}
                            </a>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Categories') }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <x-category />
                            </ul>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Pages') }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('client.register') }}">
                                        {{ __('Register As Client') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('client.login') }}">
                                        {{ __('Login As Client') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @@contact">
                            <a class="nav-link" href="{{ route('front.show.contact') }}">
                                {{ __('CONTACT') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- /header -->
