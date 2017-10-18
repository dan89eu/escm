@extends('admin./layouts/default')

@section('title')
Beneficiaries
@parent
@stop
@section('content')
  @include('core-templates::common.errors')
    <section class="content-header">
     <h1>Beneficiaries Edit</h1>
     <ol class="breadcrumb">
         <li>
             <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                 Dashboard
             </a>
         </li>
         <li>Beneficiaries</li>
         <li class="active">Edit Beneficiaries </li>
     </ol>
    </section>
    <section class="content paddingleft_right15">
      <div class="row">
      <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Edit  Beneficiary
                </h4></div>
            <br />
        <div class="panel-body">
        {!! Form::model($beneficiary, ['route' => ['admin.beneficiaries.update', $beneficiary->id], 'method' => 'patch']) !!}

        @include('admin.beneficiaries.fields')

        {!! Form::close() !!}
        </div>
      </div>
    </div>
   </section>
 @stop
