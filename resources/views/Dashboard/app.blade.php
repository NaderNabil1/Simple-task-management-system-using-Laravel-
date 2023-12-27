<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="icon" type="image/png" href="{{ asset('BackEnd/img/favicon.png') }}">

        <!-- Title -->
        <title>@yield('title') - Soft Xpert</title>

        <!-- Vendor CSS -->

        <link rel="stylesheet" href="{{ asset('BackEnd/vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('BackEnd/vendor/themify-icons/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('BackEnd/vendor/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('BackEnd/vendor/animate.css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('BackEnd/vendor/jscrollpane/jquery.jscrollpane.css') }}">
        <link rel="stylesheet" href="{{ asset('BackEnd/vendor/waves/waves.min.css') }}">
        <link rel="stylesheet" href="{{ asset('BackEnd/vendor/switchery/dist/switchery.min.css') }}">

        <!-- Neptune CSS -->
        <link rel="stylesheet" href="{{ asset('BackEnd/css/core.css') }}">
        @yield('stylesheets')
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="large-sidebar fixed-sidebar fixed-header">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader"></div>

            <!-- Sidebar -->
            <div class="site-sidebar-overlay"></div>
            <div class="site-sidebar">
                <a class="logo" href="{{ Route('home') }}">
                    <img src="{{ asset('BackEnd/img/logo.png') }}" alt="Logo" style="width:100%" />
                </a>
                <div class="custom-scroll custom-scroll-light">
                    <ul class="sidebar-menu">
                        <li class="menu-title m-t-0-5">Admin Area</li>
                        <li @if(Route::current()->getName() == 'dashboard') class="active" @endif>
                            <a href="{{ Route('dashboard') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-dashboard"></i></span>
                                <span class="s-text">Dashboard</span>
                            </a>
                        </li>
                        <li @if(Route::current()->getName() == 'admin') class="active" @endif>
                            <a href="{{ Route('be-admins') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-crown"></i></span>
                                <span class="s-text">Admins</span>
                            </a>
                        </li>

                        <li class="menu-title m-t-0-5">Lists</li>
                        <li @if(Route::current()->getName() == 'countries' || Route::current()->getName() == 'add-country' || Route::current()->getName() == 'edit-country') class="active" @endif>
                            <a href="{{ Route('countries') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-flag-alt-2"></i></span>
                                <span class="s-text">Countries</span>
                            </a>
                        </li>
                        <li @if(Route::current()->getName() == 'be-categories' || Route::current()->getName() == 'add-category' || Route::current()->getName() == 'edit-category') class="active" @endif>
                            <a href="{{ Route('be-categories') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-menu-alt"></i></span>
                                <span class="s-text">Categories</span>
                            </a>
                        </li>

                        <li @if(Route::current()->getName() == 'colors' || Route::current()->getName() == 'add-color' || Route::current()->getName() == 'edit-color') class="active" @endif>
                            <a href="{{ Route('colors') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-palette"></i></span>
                                <span class="s-text">Colors</span>
                            </a>
                        </li>

                        <li @if(Route::current()->getName() == 'sizes' || Route::current()->getName() == 'add-size' || Route::current()->getName() == 'edit-size') class="active" @endif>
                            <a href="{{ Route('sizes') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-ruler-alt"></i></span>
                                <span class="s-text">Sizes</span>
                            </a>
                        </li>
                        <li @if(Route::current()->getName() == 'payment-methods' || Route::current()->getName() == 'add-method' || Route::current()->getName() == 'edit-method') class="active" @endif>
                            <a href="{{ Route('payment-methods') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-wallet"></i></span>
                                <span class="s-text">Payment methods</span>
                            </a>
                        </li>

                        <li class="menu-title m-t-0-5">Products & Orders</li>
                        <li @if(Route::current()->getName() == 'be-products' || Route::current()->getName() == 'add-product' || Route::current()->getName() == 'edit-product') class="active" @endif>
                            <a href="{{ Route('be-products') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-menu"></i></span>
                                <span class="s-text">Products</span>
                            </a>
                        </li>

                        <li @if(Route::current()->getName() == 'stocks' || Route::current()->getName() == 'add-stock' || Route::current()->getName() == 'edit-stock') class="active" @endif>
                            <a href="{{ Route('stocks') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-package"></i></span>
                                <span class="s-text">Stocks</span>
                            </a>
                        </li>

                        <li class="menu-title m-t-0-5">E-Commerce</li>
                        <li @if(Route::current()->getName() == 'users' || Route::current()->getName() == 'add-user' || Route::current()->getName() == 'edit-user') class="active" @endif>
                            <a href="{{ Route('users') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-user"></i></span>
                                <span class="s-text">Users</span>
                            </a>
                        </li>

                        <li @if(Route::current()->getName() == 'be-orders' || Route::current()->getName() == 'edit-order') class="active" @endif>
                            <a href="{{ Route('be-orders') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-shopping-cart"></i></span>
                                <span class="s-text">Orders</span>
                            </a>
                        </li>

                        <li class="menu-title m-t-0-5">Website Data</li>
                        <li @if(Route::current()->getName() == 'pages' || Route::current()->getName() == 'add-page' || Route::current()->getName() == 'edit-page') class="active" @endif>
                            <a href="{{ Route('pages') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-layers"></i></span>
                                <span class="s-text">Pages</span>
                            </a>
                        </li>
                        <li @if(Route::current()->getName() == 'banners' || Route::current()->getName() == 'add-banner' || Route::current()->getName() == 'edit-banner') class="active" @endif>
                            <a href="{{ Route('banners') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-image"></i></span>
                                <span class="s-text">Banners</span>
                            </a>
                        </li>

                        <li @if(Route::current()->getName() == 'be-blog' || Route::current()->getName() == 'add-blog' || Route::current()->getName() == 'edit-blog') class="active" @endif>
                            <a href="{{ Route('be-blog') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-pencil-alt"></i></span>
                                <span class="s-text">Blog</span>
                            </a>
                        </li>

                        <li @if(Route::current()->getName() == 'be-careers' || Route::current()->getName() == 'add-career' || Route::current()->getName() == 'edit-career') class="active" @endif>
                            <a href="{{ Route('be-careers') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-files"></i></span>
                                <span class="s-text">Careers</span>
                            </a>
                        </li>

                        <li @if(Route::current()->getName() == 'be-events' || Route::current()->getName() == 'add-event' || Route::current()->getName() == 'edit-event') class="active" @endif>
                            <a href="{{ Route('be-events') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-calendar"></i></span>
                                <span class="s-text">Events</span>
                            </a>
                        </li>

                        <li @if(Route::current()->getName() == 'be-testimonials' || Route::current()->getName() == 'add-testimonial' || Route::current()->getName() == 'edit-testimonial') class="active" @endif>
                            <a href="{{ Route('be-testimonials') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-comments"></i></span>
                                <span class="s-text">Testimonials</span>
                            </a>
                        </li>

                        <li class="menu-title">Website</li>
                        <li>
                            <a href="{{ Route('home') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-world"></i></span>
                                <span class="s-text">Back To Website</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- Header -->
            <div class="site-header">
                <nav class="navbar navbar-light">
                    <ul class="nav navbar-nav">
                        <li class="nav-item m-r-1 hidden-lg-up">
                            <a class="nav-link collapse-button" href="#">
                                <i class="ti-menu"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav pull-xs-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="" data-toggle="dropdown" aria-expanded="false">
                                <div class="avatar box-32">
                                    <img src="{{ asset('BackEnd/img/avatars/2.png') }}" alt="">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                @if(auth()->check())
                                <a class="dropdown-item" href="{{ Route('edit-user', $auth_user) }}">
                                    <i class="ti-user m-r-0-5"></i> Edit Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="post" action="{{ Route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="ti-power-off m-r-0-5"></i> Sign out</button>
                                </form>
                                @endif
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="site-content">
                <!-- Content -->

                @yield('content')

                <!-- Footer -->
                <footer class="footer">
                    <div class="container-fluid">
                        {{ date('Y') }} © La Plain All Rights Reserved, <a href="https://innovationscope.com" target="_blank">Developed By Innovation Scope</a>
                    </div>
                </footer>
            </div>

        </div>

        <!-- Vendor JS -->
        <script type="text/javascript" src="{{ asset('BackEnd/vendor/jquery/jquery-1.12.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('BackEnd/vendor/tether/js/tether.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('BackEnd/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('BackEnd/vendor/detectmobilebrowser/detectmobilebrowser.js') }}"></script>
        <script type="text/javascript" src="{{ asset('BackEnd/vendor/jscrollpane/jquery.mousewheel.js') }}"></script>
        <script type="text/javascript" src="{{ asset('BackEnd/vendor/jscrollpane/mwheelIntent.js') }}"></script>
        <script type="text/javascript" src="{{ asset('BackEnd/vendor/jscrollpane/jquery.jscrollpane.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('BackEnd/vendor/waves/waves.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('BackEnd/vendor/switchery/dist/switchery.min.js') }}"></script>

        <!-- Neptune JS -->
        <script type="text/javascript" src="{{ asset('BackEnd/js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('BackEnd/js/demo.js') }}"></script>
        @yield('javascripts')
    </body>
</html>
