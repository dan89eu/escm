@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    European Smart City Map
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/only_dashboard.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/gmaps/css/examples.css') }}"/>
<link href="{{ asset('assets/css/pages/googlemaps_custom.css') }}" rel="stylesheet">

@stop

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1>Welcome to Dashboard</h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    Dashboard
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
                <!-- Trans label pie charts strats here-->
                <div class="lightbluebg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 text-right">
                                    <span>Projects</span>

                                    <div class="number" id="myTargetElement1"></div>
                                </div>
                                <i class="livicon  pull-right" data-name="thumbnails-big" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
                <!-- Trans label pie charts strats here-->
                <div class="redbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 pull-left">
                                    <span>Cities</span>

                                    <div class="number" id="myTargetElement2"></div>
                                </div>
                                <i class="livicon pull-right" data-name="globe" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
                <!-- Trans label pie charts strats here-->
                <div class="palebluecolorbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 pull-left">
                                    <span>Providers</span>

                                    <div class="number" id="myTargetElement3"></div>
                                </div>
                                <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
                <!-- Trans label pie charts strats here-->
                <div class="goldbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="col-xs-4">
                                    <small class="stat-label">Mobility</small>
                                    <h4 id="myTargetElement4.1"></h4>
                                </div>
                                <div class="col-xs-4 text-right">
                                    <small class="stat-label">Citizen</small>
                                    <h4 id="myTargetElement4.2"></h4>
                                </div>
                                <div class="col-xs-4">
                                    <small class="stat-label">Governance</small>
                                    <h4 id="myTargetElement4.3"></h4>
                                </div>
                                <div class="col-xs-4 text-right">
                                    <small class="stat-label">Economy</small>
                                    <h4 id="myTargetElement4.4"></h4>
                                </div>
                                <div class="col-xs-4">
                                    <small class="stat-label">Environment</small>
                                    <h4 id="myTargetElement4.5"></h4>
                                </div>
                                <div class="col-xs-4 text-right">
                                    <small class="stat-label">Living</small>
                                    <h4 id="myTargetElement4.6"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 animated fadeInUpBig">
                <div id="gmap" class="gmap"></div>
            </div>
        </div>
        <!--/row-->
    </section>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script>
	var locations = {!! App\Models\Location::get() !!}
	var count_projects = {!! App\Models\Project::count() !!}
	var count_cities = {!! App\Models\Location::count() !!}
	var count_providers = {!! App\Models\Provider::count() !!}
	var count_41 = {!! App\Models\ProjectVertical::where('vertical_id',2)->count() !!}
	var count_42 = {!! App\Models\ProjectVertical::where('vertical_id',4)->count() !!}
	var count_43 = {!! App\Models\ProjectVertical::where('vertical_id',6)->count() !!}
	var count_44 = {!! App\Models\ProjectVertical::where('vertical_id',11)->count() !!}
	var count_45 = {!! App\Models\ProjectVertical::where('vertical_id',12)->count() !!}
	var count_46 = {!! App\Models\ProjectVertical::where('vertical_id',13)->count() !!}
</script>
    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfNo1-CBPZt1Kg2MxAdEV23mzac6JYn2s&libraries=places"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/gmaps/js/gmaps.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/markerclusterer.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript" src="{{ asset('assets/vendors/countUp_js/js/countUp.js') }}"></script>

    <script src="{{ mix('assets/js/pages/dashboard.js') }}" type="text/javascript"></script>


@stop