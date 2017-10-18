@extends('admin./layouts/default')

@section('title')
Providers
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Providers</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Providers</li>
        <li class="active">Providers List</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
     @include('flash::message')
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Providers List
                </h4>
                <div class="pull-right">
                    <a href="{{ route('admin.providers.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body table-responsive">
                 @include('admin.providers.table')
                 
            </div>
        </div>
 </div>
</section>
@stop
