<!-- Formatted Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('formatted_address', 'Formatted Address:') !!}
    {!! Form::text('formatted_address', null, ['class' => 'form-control']) !!}
</div>

<!-- County Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('county_name', 'County Name:') !!}
    {!! Form::text('county_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('country_name', 'Country Name:') !!}
    {!! Form::text('country_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Locality Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('locality_name', 'Locality Name:') !!}
    {!! Form::text('locality_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.locations.index') !!}" class="btn btn-default">Cancel</a>
</div>
