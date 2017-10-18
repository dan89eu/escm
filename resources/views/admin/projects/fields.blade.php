<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Initialcost Field -->
<div class="form-group col-sm-12">
    {!! Form::label('initialCost', 'Initialcost:') !!}
    {!! Form::text('initialCost', null, ['class' => 'form-control']) !!}
</div>

<!-- Finalcost Field -->
<div class="form-group col-sm-12">
    {!! Form::label('finalCost', 'Finalcost:') !!}
    {!! Form::text('finalCost', null, ['class' => 'form-control']) !!}
</div>

<!-- Contracting Date Field -->
<div class="form-group col-sm-12">
    {!! Form::label('contracting_date', 'Contracting Date:') !!}
    {!! Form::date('contracting_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Eta Delivery Date Field -->
<div class="form-group col-sm-12">
    {!! Form::label('eta_delivery_date', 'Eta Delivery Date:') !!}
    {!! Form::date('eta_delivery_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Final Delivery Date Field -->
<div class="form-group col-sm-12">
    {!! Form::label('final_delivery_date', 'Final Delivery Date:') !!}
    {!! Form::date('final_delivery_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Gps Location Field -->
<div class="form-group col-sm-12">
    {!! Form::label('gps_location', 'Gps Location:') !!}
    {!! Form::text('gps_location', null, ['class' => 'form-control']) !!}
</div>

<!-- Details Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('details', 'Details:') !!}
    {!! Form::textarea('details', null, ['class' => 'form-control', 'rows' => '5']) !!}
</div>


<!-- Notes Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('notes', 'Notes:') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '5']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.projects.index') !!}" class="btn btn-default">Cancel</a>
</div>
