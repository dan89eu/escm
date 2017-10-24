@extends('admin./layouts/default')

@section('title')
Projects
@parent
@stop
{{-- page level styles --}}
@section('header_styles')

<link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/gmaps/css/examples.css') }}"/>
<link href="{{ asset('assets/css/pages/googlemaps_custom.css') }}" rel="stylesheet">
<!--end of page level css-->
<!--end of page level css-->
@stop
@section('content')
@include('core-templates::common.errors')
<section class="content-header">
    <h1>Projects</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Projects</li>
        <li class="active">Create Projects </li>
    </ol>
</section>
<section class="content paddingleft_right15">
<div class="row">
 <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Create New  Project
            </h4></div>
        <br />
        <div class="panel-body">
        {!! Form::open(['route' => 'admin.projects.store']) !!}

            @include('admin.projects.fields')

        {!! Form::close() !!}
    </div>
  </div>
 </div>
</section>
 @stop
{{-- page level scripts --}}
@section('footer_scripts')
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfNo1-CBPZt1Kg2MxAdEV23mzac6JYn2s&libraries=places"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/gmaps/js/gmaps.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/custommaps.js') }}"></script>
<script language="javascript" type="text/javascript">

	$(".select2").select2({
		theme:"bootstrap",
		placeholder:"Select a value"
	});

</script>

@stop
