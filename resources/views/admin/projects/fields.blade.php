<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-12">
    <input id="pac-input" class="controls" type="text"
           placeholder="Enter a location">
    <div id="gmap" class="gmap"></div>
</div>
<!-- Verticals Field -->
<div class="form-group col-sm-12">
    {!! Form::label('verticals', 'Verticala:') !!}
    {!! Form::select('verticals[]', App\Models\Vertical::pluck('name','id'), null, ['class' => 'form-control select2','multiple', 'required']) !!}
</div>
<!-- Connectivity Field -->
<div class="form-group col-sm-12">
    {!! Form::label('conectivities', 'Connectivities:') !!}
    {!! Form::select('conectivities[]', App\Models\Conectivity::pluck('name','id'), null, ['class' => 'form-control select2','multiple', 'required']) !!}
</div>

<!-- Beneficiaries Field -->
<div class="form-group col-sm-12">
    {!! Form::label('beneficiaries', 'Beneficiary:') !!}
    {!! Form::select('beneficiaries[]', App\Models\Beneficiary::pluck('name','id'), null, ['class' => 'form-control select2','multiple', 'required']) !!}
</div>

<!-- Providers Field -->
<div class="form-group col-sm-12">
    {!! Form::label('providers', 'Provider:') !!}
    {!! Form::select('providers[]', App\Models\Provider::pluck('name','id'), null, ['class' => 'form-control select2','multiple', 'required']) !!}
</div>

<!-- Providers Field -->
<div class="form-group col-sm-12">
    {!! Form::label('infrastructures', 'Infrastructure:') !!}
    {!! Form::select('infrastructures[]', App\Models\Infrastructure::pluck('name','id'), null, ['class' => 'form-control select2','multiple', 'required']) !!}
</div>

<!-- Initialcost Field -->
<div class="form-group col-sm-12">
    {!! Form::label('initialCost', 'Initial cost (EUR):') !!}
    {!! Form::text('initialCost', null, ['class' => 'form-control']) !!}
</div>

<!-- Finalcost Field -->
<div class="form-group col-sm-12">
    {!! Form::label('finalCost', 'Final cost (EUR):') !!}
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
    <p>For the moment please use: <a href="https://developers.google.com/maps/documentation/utilities/polylineutility" target="_blank">Polyline</a> and COPY/PASTE the encoded polyline </p>
    {!! Form::text('gps_location', null, ['class' => 'form-control']) !!}
</div>

<!-- Details Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('details', 'Details:') !!}
    {!! Form::textarea('details', null, ['class' => 'form-control', 'rows' => '5']) !!}
</div>

<!-- Notes Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('notes', 'Notes (internal use only):') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '5']) !!}
</div>

{!! Form::hidden('g_place_id', $project->location->place_id??null, ['class' => 'form-control','id'=>'g_place_id']) !!}
{!! Form::hidden('g_locality_name', $project->location->locality_name??null, ['class' => 'form-control','id'=>'g_locality_name']) !!}
{!! Form::hidden('g_county_name', $project->location->county_name??null, ['class' => 'form-control','id'=>'g_county_name']) !!}
{!! Form::hidden('g_country_name', $project->location->country_name??null, ['class' => 'form-control','id'=>'g_country_name']) !!}
{!! Form::hidden('g_lat', $project->location->lat??null, ['class' => 'form-control','id'=>'g_lat']) !!}
{!! Form::hidden('g_lng', $project->location->lng??null, ['class' => 'form-control','id'=>'g_lng']) !!}
{!! Form::hidden('g_formatted_address', $project->location->formatted_address??null, ['class' => 'form-control','id'=>'g_formatted_address']) !!}


<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.projects.index') !!}" class="btn btn-default">Cancel</a>
</div>
