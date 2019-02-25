@extends('layouts/default')

{{-- Page title --}}
@section('title')
Home
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.theme.css') }}">

    <!--end of page level css-->
@stop

{{-- content --}}
@section('content')
    <div id="page-content">
        <div class="hero-section full-screen has-map has-sidebar">
            <div class="map-wrapper">
                <div class="geo-location">
                    <i class="fa fa-map-marker"></i>
                </div>
                <div class="map" id="map-homepage"></div>
            </div>
            <!--end map-wrapper-->
            <div class="results-wrapper">
                <div class="form search-form inputs-underline">
                    <form>
                        <div class="section-title">
                            <h2>Search</h2>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="keyword" placeholder="Enter keyword">
                        </div>
                        <!--end form-group-->
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select class="form-control selectpicker" name="location">
                                        <option value="">Location</option>
                                        @foreach(App\Models\Location::get(['id','locality_name']) as $location)
                                            <option value="{{ $location->id }}">{{ $location->locality_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--end form-group-->
                            </div>
                            <!--end col-md-6-->
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select class="form-control selectpicker" name="vertical">
                                        <option value="">Category</option>
                                        @foreach(App\Models\Vertical::get() as $vertical)
                                            <option value="{{ $vertical->id }}">{{ $vertical->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--end form-group-->
                            </div>
                            <!--end col-md-6-->
                        </div>
                        <!--end row-->
                        <div class="form-group">
                            <button id="submit_search" type="submit" data-ajax-response="map" data-ajax-data-file="api/admin/projects" data-ajax-auto-zoom="1" class="btn btn-primary pull-right"><i class="fa fa-search"></i></button>
                        </div>
                        <!--end form-group-->
                    </form>
                    <!--end form-hero-->
                </div>
                <div class="results">
                    <div class="tse-scrollable">
                        <div class="tse-content">
                            <div class="section-title">
                                <h2>Search Results<span class="results-number"></span></h2>
                            </div>
                            <!--end section-title-->
                            <div class="results-content"></div>
                            <!--end results-content-->
                        </div>
                        <!--end tse-content-->
                    </div>
                    <!--end tse-scrollable-->
                </div>
                <!--end results-->
            </div>
            <!--end results-wrapper-->
        </div>
        <!--end hero-section-->

        <div class="block">
            <div class="container">
                <div class="center">
                    <div class="section-title">
                        <div class="center">
                            <h2>Recent Places</h2>
                            <h3 class="subtitle">Fusce eu mollis dui, varius convallis mauris. Nam dictum id</h3>
                        </div>
                    </div>
                    <!--end section-title-->
                </div>
                <!--end center-->
                <div class="row">

                    @foreach(App\Models\Project::inRandomOrder()->limit(6)->get() as $project)
                        <div class="col-md-4 col-sm-4">
                            <div class="item" data-id="{{$project->id}}">
                                <a href="detail.html">
                                    <div class="description">
                                        <figure>{{\Illuminate\Support\Str::words($project->details,20)}}</figure>
                                        <div class="label label-default">{{$project->verticals->pluck('name')->implode(', ')}}</div>
                                        <h3>{{$project->name}}</h3>
                                        <h4>{{$project->location->formatted_address}}</h4>
                                    </div>
                                    <!--end description-->
                                    <div class="image bg-transfer">
                                        <img src="assets/img/items/1.jpg" alt="">
                                    </div>
                                    <!--end image-->
                                </a>
                                <div class="additional-info">
                                    <div class="rating-passive" data-rating="{{rand(10,100)%2+4}}">
                                        <span class="stars"></span>
                                        <span class="reviews">{{rand(5,20)}}</span>
                                    </div>
                                    <div class="controls-more">
                                        <ul>
                                            <li><a href="#">Add to favorites</a></li>
                                            <li><a href="#">Add to watchlist</a></li>
                                            <li><a href="#" class="quick-detail">Quick detail</a></li>
                                        </ul>
                                    </div>
                                    <!--end controls-more-->
                                </div>
                                <!--end additional-info-->
                            </div>
                            <!--end item-->
                        </div>
                    @endforeach
                </div>
                <!--end row-->
                <div class="center">
                    <a href="listing.html" class="btn btn-primary btn-light-frame btn-rounded btn-framed arrow">View all listings</a>
                </div>
                <!--end center-->
            </div>
            <!--end container-->
        </div>
        <!--end block-->
        <div class="container"><hr></div>
        <div class="block">
            <div class="container">
                <div class="section-title">
                    <div class="center">
                        <h2>Browse Our Listings</h2>
                    </div>
                </div>
                <!--end section-title-->
                <div class="categories-list">
                    <div class="row">

                        @foreach(App\Models\Vertical::get() as $vertical)
                            <div class="col-md-3 col-sm-3">
                                <div class="list-item">
                                    <div class="title">
                                        <div class="icon"><i class="fa fa-paint-brush"></i></div>
                                        <h3><a href="#">{{$vertical->name}}</a></h3>
                                    </div>
                                    <!--end title-->
                                    <ul>
                                        <li><a href="">{{$vertical->name}}</a><figure class="count">{{App\Models\ProjectVertical::where('vertical_id',$vertical->id)->count()}}</figure></li>
                                    </ul>
                                </div>
                                <!--end list-item-->
                            </div>
                        @endforeach
                    </div>
                    <!--end row-->
                </div>
                <!--end categories-list-->
            </div>
            <!--end container-->
        </div>
        <!--end block-->
        <div class="block big-padding">
            <div class="container">
                <div class="vertical-aligned-elements">
                    <div class="element width-50">
                        <h3>Subscribe and be notified about new locations</h3>
                    </div>
                    <!--end element-->
                    <div class="element width-50">
                        <form class="form form-email inputs-underline" id="form-subscribe">
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" placeholder="Your email" required="">
                                <span class="input-group-btn">
                                    <button class="btn" type="submit"><i class="arrow_right"></i></button>
                                </span>
                            </div><!-- /input-group -->
                        </form>
                        <!--end form-->
                    </div>
                    <!--end element-->
                </div>
                <!--end vertical-aligned-elements-->
            </div>
            <!--end container-->
            <div class="background-wrapper">
                <div class="background-color background-color-black opacity-5"></div>
            </div>
            <!--end background-wrapper-->
        </div>
        <!--end block-->
        <div class="block background-is-dark">
            <div class="container">
                <div class="section-title vertical-aligned-elements">
                    <div class="element">
                        <h2>Promoted Locations</h2>
                    </div>
                    <div class="element text-align-right">
                        <a href="#" class="btn btn-framed btn-rounded btn-default invisible-on-mobile">Promote yours</a>
                        <div id="gallery-nav"></div>
                    </div>
                </div>
                <!--end section-title-->
            </div>
            <div class="gallery featured">
                <div class="owl-carousel" data-owl-items="9" data-owl-loop="1" data-owl-auto-width="1" data-owl-nav="1" data-owl-dots="1" data-owl-nav-container="#gallery-nav">
                    @foreach(App\Models\Project::inRandomOrder()->limit(9)->get() as $project)
                            <div class="item featured" data-id="{{$project->id}}">
                                <a href="detail.html">
                                    <div class="description">
                                        <figure>{{\Illuminate\Support\Str::words($project->details,20)}}</figure>
                                        <div class="label label-default">{{$project->verticals->pluck('name')->implode(', ')}}</div>
                                        <h3>{{$project->name}}</h3>
                                        <h4>{{$project->location->formatted_address}}</h4>
                                    </div>
                                    <!--end description-->
                                    <div class="image bg-transfer">
                                        <img src="assets/img/items/1.jpg" alt="">
                                    </div>
                                    <!--end image-->
                                </a>
                                <div class="additional-info">
                                    <div class="rating-passive" data-rating="{{rand(10,100)%2+4}}">
                                        <span class="stars"></span>
                                        <span class="reviews">{{rand(5,20)}}</span>
                                    </div>
                                    <div class="controls-more">
                                        <ul>
                                            <li><a href="#">Add to favorites</a></li>
                                            <li><a href="#">Add to watchlist</a></li>
                                            <li><a href="#" class="quick-detail">Quick detail</a></li>
                                        </ul>
                                    </div>
                                    <!--end controls-more-->
                                </div>
                                <!--end additional-info-->
                            </div>
                    @endforeach
                </div>
            </div>
            <!--end gallery-->
            <div class="background-wrapper">
                <div class="background-color background-color-default"></div>
            </div>
            <!--end background-wrapper-->
        </div>
        <!--end block-->

        <div class="block">
            <div class="container">
                <div class="section-title">
                    <h2>Events Near You</h2>
                </div>
                <!--end section-title-->
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="text-element event">
                            <div class="date-icon">
                                <figure class="day">22</figure>
                                <figure class="month">Jun</figure>
                            </div>
                            <h4><a href="detail.html">Lorem ipsum dolor sit amet</a></h4>
                            <figure class="date"><i class="icon_clock_alt"></i>08:00</figure>
                            <p>Ut nec vulputate enim. Nulla faucibus convallis dui. Donec arcu enim, scelerisque.</p>
                            <a href="detail.html" class="link arrow">More</a>
                        </div>
                        <!--end text-element-->
                    </div>
                    <!--end col-md-4-->
                    <div class="col-md-4 col-sm-4">
                        <div class="text-element event">
                            <div class="date-icon">
                                <figure class="day">04</figure>
                                <figure class="month">Jul</figure>
                            </div>
                            <h4><a href="detail.html">Donec mattis mi vitae volutpat</a></h4>
                            <figure class="date"><i class="icon_clock_alt"></i>12:00</figure>
                            <p>Nullam vitae ex ac neque viverra ullamcorper eu at nunc. Morbi imperdiet.</p>
                            <a href="detail.html" class="link arrow">More</a>
                        </div>
                        <!--end text-element-->
                    </div>
                    <!--end col-md-4-->
                    <div class="col-md-4 col-sm-4">
                        <div class="text-element event">
                            <div class="date-icon">
                                <figure class="day">12</figure>
                                <figure class="month">Aug</figure>
                            </div>
                            <h4><a href="detail.html">Vivamus placerat</a></h4>
                            <figure class="date"><i class="icon_clock_alt"></i>12:00</figure>
                            <p>Aenean sed purus ut massa scelerisque bibendum eget vel massa.</p>
                            <a href="detail.html" class="link arrow">More</a>
                        </div>
                        <!--end text-element-->
                    </div>
                    <!--end col-md-4-->
                </div>
                <!--end row-->
                <div class="background-wrapper">
                    <div class="background-color background-color-black opacity-5"></div>
                </div>
                <!--end background-wrapper-->
            </div>
            <!--end container-->
        </div>
        <!--end block-->

        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-9">
                        <div class="section-title">
                            <h2>Recently Rated Items</h2>
                        </div>
                        <!--end section-title-->
                        <div class="row">
                            @foreach(App\Models\Project::inRandomOrder()->limit(3)->get() as $project)
                                <div class="col-md-4 col-sm-4">
                                    <div class="item" data-id="{{$project->id}}">
                                        <a href="detail.html">
                                            <div class="description">
                                                <figure>{{\Illuminate\Support\Str::words($project->details,20)}}</figure>
                                                <div class="label label-default">{{$project->verticals->pluck('name')->implode(', ')}}</div>
                                                <h3>{{$project->name}}</h3>
                                                <h4>{{$project->location->formatted_address}}</h4>
                                            </div>
                                            <!--end description-->
                                            <div class="image bg-transfer">
                                                <img src="assets/img/items/1.jpg" alt="">
                                            </div>
                                            <!--end image-->
                                        </a>
                                        <div class="additional-info">
                                            <div class="rating-passive" data-rating="{{rand(10,100)%2+4}}">
                                                <span class="stars"></span>
                                                <span class="reviews">{{rand(5,20)}}</span>
                                            </div>
                                            <div class="controls-more">
                                                <ul>
                                                    <li><a href="#">Add to favorites</a></li>
                                                    <li><a href="#">Add to watchlist</a></li>
                                                    <li><a href="#" class="quick-detail">Quick detail</a></li>
                                                </ul>
                                            </div>
                                            <!--end controls-more-->
                                        </div>
                                        <!--end additional-info-->
                                    </div>
                                    <!--end item-->
                                </div>
                            @endforeach
                            <!--<end col-md-3-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end col-md-9-->
                    <div class="col-md-3 col-sm-3">
                        <div class="section-title">
                            <h2>Client’s Word</h2>
                        </div>
                        <div class="testimonials center box">
                            <div class="owl-carousel" data-owl-items="1" data-owl-nav="0" data-owl-dots="1">
                                <blockquote>
                                    <div class="image">
                                        <div class="bg-transfer">
                                            <img src="assets/img/person-01.jpg" alt="">
                                        </div>
                                    </div>
                                    <h3>Jane Woodstock</h3>
                                    <h4>CEO at ArtBrands</h4>
                                    <p>Ut nec vulputate enim. Nulla faucibus convallis dui. Donec arcu enim, scelerisque gravida lacus vel.</p>
                                </blockquote>
                                <blockquote>
                                    <div class="image">
                                        <div class="bg-transfer">
                                            <img src="assets/img/person-04.jpg" alt="">
                                        </div>
                                    </div>
                                    <h3>Peter Doe</h3>
                                    <h4>CEO at ArtBrands</h4>
                                    <p>Donec arcu enim, scelerisque gravida lacus vel, dignissim cursus lectus. Aliquam laoreet purus in iaculis sodales.</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <!--end col-md-3-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </div>
        <!--end block-->
        <div class="block">
            <div class="container">
                <div class="section-title">
                    <h2>From the Blog</h2>
                </div>
                <!--end section-title-->
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="text-element">
                            <h4><a href="blog-detail.html">Lorem ipsum dolor sit amet</a></h4>
                            <figure class="date">21.06.2015</figure>
                            <p>Ut nec vulputate enim. Nulla faucibus convallis dui. Donec arcu enim, scelerisque gravida lacus vel, dignissim cursus</p>
                            <a href="blog-detail.html"><i class="arrow_right"></i></a>
                        </div>
                        <!--end text-element-->
                    </div>
                    <!--end col-md-4-->
                    <div class="col-md-4 col-sm-4">
                        <div class="text-element">
                            <h4><a href="blog-detail.html">Sed et justo ut nibh condimentum lacinia</a></h4>
                            <figure class="date">13.06.2015</figure>
                            <p>Donec arcu enim, scelerisque gravida lacus vel, dignissim cursus lectus. Aliquam laoreet purus in iaculis sodales. </p>
                            <a href="blog-detail.html"><i class="arrow_right"></i></a>
                        </div>
                        <!--end text-element-->
                    </div>
                    <!--end col-md-4-->
                    <div class="col-md-4 col-sm-4">
                        <div class="text-element">
                            <h4><a href="blog-detail.html">Suspendisse varius eros id enim </a></h4>
                            <figure class="date">03.04.2015</figure>
                            <p>Nullam nec turpis blandit, sodales risus vitae, tincidunt velit. Vestibulum ac ipsum tincidunt, vestibulum leo eget, </p>
                            <a href="blog-detail.html"><i class="arrow_right"></i></a>
                        </div>
                        <!--end text-element-->
                    </div>
                    <!--end col-md-4-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </div>
        <!--end block-->

        <div class="container">
            <hr>
        </div>
        <!--end container-->

        <div class="block">
            <div class="container">
                <div class="logos">
                    <div class="logo">
                        <a href="#"><img src="assets/img/logo-1.png" alt=""></a>
                    </div>
                    <div class="logo">
                        <a href="#"><img src="assets/img/logo-2.png" alt=""></a>
                    </div>
                    <div class="logo">
                        <a href="#"><img src="assets/img/logo-3.png" alt=""></a>
                    </div>
                    <div class="logo">
                        <a href="#"><img src="assets/img/logo-4.png" alt=""></a>
                    </div>
                    <div class="logo">
                        <a href="#"><img src="assets/img/logo-5.png" alt=""></a>
                    </div>
                </div>
                <!--/ .logos-->
            </div>
            <!--end container-->
        </div>
        <!--end block-->
    </div>
@stop
{{-- footer scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfNo1-CBPZt1Kg2MxAdEV23mzac6JYn2s&libraries=places"></script>
    <script type="text/javascript" src="{{ asset('assets/js/richmarker-compiled.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/markerclusterer_packed.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/infobox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.fitvids.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.trackpad-scroll-emulator.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.nouislider.all.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/maps.js') }}"></script>
    <!--page level js ends-->
    <script>
	    var optimizedDatabaseLoading = 0;
	    var _latitude = 51.76337764681005;
	    var _longitude = 5.30614885;
	    var element = "map-homepage";
	    var markerTarget = "modal"; // use "sidebar", "infobox" or "modal" - defines the action after click on marker
	    var sidebarResultTarget = "modal"; // use "sidebar", "modal" or "new_page" - defines the action after click on marker
	    var showMarkerLabels = false; // next to every marker will be a bubble with title
	    var mapDefaultZoom = 4; // default zoom
	    heroMap(_latitude,_longitude, element, markerTarget, sidebarResultTarget, showMarkerLabels, mapDefaultZoom);
    </script>
@stop
