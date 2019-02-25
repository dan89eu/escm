<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Dan Petrescu">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <title>
        @section('title')
            | ESCM
        @show
    </title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/elegant-fonts.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900,400italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/zabuto_calendar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/trackpad-scroll-emulator.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.nouislider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">


    <!--global css starts
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib.css') }}">
    <!--end of global css-->
    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->

</head>

<body class="homepage">

<div class="page-wrapper">
    <!-- Header Start -->
    <header id="page-header">
        <nav>
            <div class="left">
                <a href="index.html" class="brand"><img src="assets/img/logo.png" alt=""></a>
            </div>
            <!--end left-->
            <div class="right">
                <div class="primary-nav has-mega-menu">
                    <ul class="navigation">
                        <li class="active has-child"><a href="#nav-homepages">Home</a>
                            <div class="wrapper">
                                <div id="nav-homepages" class="nav-wrapper">
                                    <ul>
                                        <li><a href="index-map-version-1.html">Map Full Screen Sidebar Results</a></li>
                                        <li><a href="index-map-version-2.html">Map Horizontal Form</a></li>
                                        <li><a href="index-map-version-3.html">Map Full Screen Form in Sidebar</a></li>
                                        <li><a href="index-map-version-4.html">Map Form Under</a></li>
                                        <li><a href="index-map-version-5.html">Map Sidebar Grid</a></li>
                                        <li><a href="index-map-version-6.html">Map Full Screen Collapse Form</a></li>
                                        <li><a href="index-hero-version-1.html">Hero One Input Form</a></li>
                                        <li><a href="index-hero-version-2.html">Hero Multiple Inputs</a></li>
                                        <li><a href="index-hero-version-3.html">Hero Form Under</a></li>
                                        <li><a href="index-hero-version-4.html">Hero Full Screen Slider</a></li>
                                        <li><a href="index-hero-version-5.html">Hero Coupon Slider</a></li>
                                        <li><a href="index-hero-version-6.html">Hero Interactive Slider</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="has-child"><a href="#nav-listing">Listing</a>
                            <div class="wrapper">
                                <div id="nav-listing" class="nav-wrapper">
                                    <ul>
                                        <li class="has-child"><a href="#nav-grid-listing">Grid Listing</a>
                                            <div id="nav-grid-listing" class="nav-wrapper">
                                                <ul>
                                                    <li><a href="listing-grid-right-sidebar.html">With Right Sidebar</a></li>
                                                    <li><a href="listing-grid-left-sidebar.html">With Left Sidebar</a></li>
                                                    <li><a href="listing-grid-full-width.html">Full Width</a></li>
                                                    <li><a href="listing-grid-different-widths.html">Different Widths</a></li>
                                                    <li><a href="listing-grid-3-items.html">3 Items in Row</a></li>
                                                    <li><a href="listing-grid-4-items.html">4 Items in Row</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="has-child"><a href="#nav-row-listing">Row Listing</a>
                                            <div id="nav-row-listing" class="nav-wrapper">
                                                <ul>
                                                    <li><a href="listing-row-right-sidebar.html">Row Right Sidebar</a></li>
                                                    <li><a href="listing-row-left-sidebar.html">Row Left Sidebar</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li class="mega-menu-parent has-child"><a href="#nav-pages">Pages</a>
                            <div class="wrapper">
                                <div class="mega-menu">
                                    <div class="nav-wrapper" id="nav-pages">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-3 col-sm-3">
                                                    <h4 class="heading">General</h4>
                                                    <ul>
                                                        <li><a href="faq.html">Faq</a></li>
                                                        <li><a href="pricing.html">Pricing</a></li>
                                                        <li><a href="submit.html">Submit Listing</a></li>
                                                        <li><a href="detail.html">Listing Detail</a></li>
                                                        <li><a href="detail-2.html">Listing Detail v2</a></li>
                                                        <li><a href="agents-listing.html">Agents Listing</a></li>
                                                        <li><a href="agent-detail.html">Agent Detail</a></li>
                                                    </ul>
                                                </div>
                                                <!--end col-md-3-->
                                                <div class="col-md-3 col-sm-3">
                                                    <h4 class="heading">User</h4>
                                                    <ul>
                                                        <li><a href="profile.html">Profile Edit</a></li>
                                                        <li><a href="sign-in.html">Sign In</a></li>
                                                        <li><a href="register.html">Register</a></li>
                                                        <li><a href="reset-password.html">Reset Password</a></li>
                                                        <li><a href="my-listings.html">My Listings</a></li>
                                                        <li><a href="edit-listing.html">Edit Listing</a></li>
                                                        <li><a href="reviews.html">Reviews</a></li>
                                                    </ul>
                                                </div>
                                                <!--end col-md-3-->
                                                <div class="col-md-3 col-sm-3">
                                                    <h4 class="heading">Other</h4>
                                                    <ul>
                                                        <li><a href="elements.html">Elements / Shortcodes</a></li>
                                                        <li><a href="404.html">404 Error Page</a></li>
                                                        <li><a href="sticky-footer.html">Sticky Footer</a></li>
                                                        <li><a href="terms-and-conditions.html">Terms & Conditions</a></li>
                                                        <li><a href="grid-system.html">Grid System</a></li>
                                                        <li><a href="how-it-works.html">How it Works</a></li>
                                                        <li><a href="rtl.html">RTL Support</a></li>
                                                    </ul>
                                                </div>
                                                <!--end col-md-3-->
                                                <div class="col-md-3 col-sm-3">
                                                    <div class="image center overlay">
                                                        <div class="vertical-aligned-elements">
                                                            <div class="element">
                                                                <a href="#" class="btn btn-default btn-framed">Submit Your Listing</a>
                                                            </div>
                                                        </div>
                                                        <div class="bg-transfer"><img src="assets/img/items/10.jpg" alt=""></div>
                                                    </div>
                                                </div>
                                                <!--end col-md-3-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end container-->
                                    </div>
                                    <!--end collapse-->
                                </div>
                                <!--end wrapper-->
                            </div>
                            <!--end mega-menu-->
                        </li>
                        <li class="has-child"><a href="#nav-locations">Locations</a>
                            <div class="wrapper">
                                <div id="nav-locations" class="nav-wrapper">
                                    <ul>
                                        @foreach(App\Models\Location::groupBy('country_name')->get() as $location)
                                            <li><a href="#nav-locations-{{ $location->country_name }}">{{ $location->country_name }}</a>
                                                <!--<div class="nav-wrapper" id="nav-locations-{{ $location->country_name }}">
                                                    <ul>
                                                        @foreach(App\Models\Location::where('country_name',$location->country_name)->groupBy('locality_name')->get() as $loc)
                                                            <li><a href="#">{{ $loc->locality_name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>-->
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!--end nav-wrapper-->
                            </div>
                            <!--end wrapper-->
                        </li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                    <!--end navigation-->
                </div>
                <!--end primary-nav-->
                <div class="secondary-nav">
                    <a href="#" data-modal-external-file="modal_sign_in.php" data-target="modal-sign-in">Sign In</a>
                    <a href="#" class="promoted" data-modal-external-file="modal_register.php" data-target="modal-register">Register</a>
                </div>
                <!--end secondary-nav-->
                <a href="#" class="btn btn-primary btn-small btn-rounded icon shadow add-listing" data-modal-external-file="modal_submit.php" data-target="modal-submit"><i class="fa fa-plus"></i><span>Add listing</span></a>
                <div class="nav-btn">
                    <i></i>
                    <i></i>
                    <i></i>
                </div>
                <!--end nav-btn-->
            </div>
            <!--end right-->
        </nav>
        <!--end nav-->
    </header>
    <!-- //Header End -->
    
    <!-- slider / breadcrumbs section -->
    @yield('top')

    <!-- Content -->
    @yield('content')

    <!-- Footer Section Start -->
    <footer id="page-footer">
        <div class="footer-wrapper">
            <div class="block">
                <div class="container">
                    <div class="vertical-aligned-elements">
                        <div class="element width-50">
                            <p data-toggle="modal" data-target="#myModal">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque aliquam at neque sit amet vestibulum. <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</p>
                        </div>
                        <div class="element width-50 text-align-right">
                            <a href="#" class="circle-icon"><i class="social_twitter"></i></a>
                            <a href="#" class="circle-icon"><i class="social_facebook"></i></a>
                            <a href="#" class="circle-icon"><i class="social_youtube"></i></a>
                        </div>
                    </div>
                    <div class="background-wrapper">
                        <div class="bg-transfer opacity-50">
                            <img src="assets/img/footer-bg.png" alt="">
                        </div>
                    </div>
                    <!--end background-wrapper-->
                </div>
            </div>
            <div class="footer-navigation">
                <div class="container">
                    <div class="vertical-aligned-elements">
                        <div class="element width-50">(C) 2016 Your Company, All right reserved</div>
                        <div class="element width-50 text-align-right">
                            <a href="index.html">Home</a>
                            <a href="listing-grid-right-sidebar.html">Listings</a>
                            <a href="submit.html">Submit Item</a>
                            <a href="contact.html">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- //Footer Section End -->
</div>
    <!--end page-wrapper-->
    <a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>
    <!--global js starts
    <script type="text/javascript" src="{{ asset('assets/js/frontend/lib.js') }}"></script>
    <!--global js end-->
    <script type="text/javascript" src="{{ asset('assets/js/jquery-2.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <!-- begin page level js -->
    @yield('footer_scripts')
    <!-- end page level js -->
</body>

</html>
