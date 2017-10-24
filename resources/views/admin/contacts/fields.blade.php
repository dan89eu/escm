<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-12">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Department Field -->
<div class="form-group col-sm-12">
    {!! Form::label('department', 'Department:') !!}
    {!! Form::text('department', null, ['class' => 'form-control']) !!}
</div>
<!-- Projects Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('beneficiaries_id', 'Beneficiary:') !!}
    {!! Form::select('beneficiaries_id', App\Models\Beneficiary::pluck('name','id'), null, ['class' => 'form-control select2', 'placeholder'=>'Select a value']) !!}
</div>
<!-- Projects Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('providers_id', 'Provider:') !!}
    {!! Form::select('providers_id', App\Models\Provider::pluck('name','id'), null, ['class' => 'form-control select2', 'placeholder'=>'Select a value']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.contacts.index') !!}" class="btn btn-default">Cancel</a>
</div>
