@extends('admin./layouts/default')

@section('title')
Projects
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Projects</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Projects</li>
        <li class="active">Projects List</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
     @include('flash::message')
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Projects List
                </h4>
                <div class="pull-right">
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body table-responsive">
                 @include('admin.projects.table')
                 
            </div>
        </div>
 </div>
</section>
@stop
