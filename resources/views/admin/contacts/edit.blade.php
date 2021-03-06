@extends('admin./layouts/default')

@section('title')
Contacts
@parent
@stop
{{-- page level styles --}}
@section('header_styles')

<link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet" />
<!--end of page level css-->
@stop
@section('content')
  @include('core-templates::common.errors')
    <section class="content-header">
     <h1>Contacts Edit</h1>
     <ol class="breadcrumb">
         <li>
             <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                 Dashboard
             </a>
         </li>
         <li>Contacts</li>
         <li class="active">Edit Contacts </li>
     </ol>
    </section>
    <section class="content paddingleft_right15">
      <div class="row">
      <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Edit  Contact
                </h4></div>
            <br />
        <div class="panel-body">
        {!! Form::model($contact, ['route' => ['admin.contacts.update', $contact->id], 'method' => 'patch']) !!}

        @include('admin.contacts.fields')

        {!! Form::close() !!}
        </div>
      </div>
    </div>
   </section>
 @stop
{{-- page level scripts --}}
@section('footer_scripts')
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
<script language="javascript" type="text/javascript">

	$(".select2").select2({
		theme:"bootstrap",
		placeholder:"Select a value"
	});

</script>

@stop
