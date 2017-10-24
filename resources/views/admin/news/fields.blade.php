<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<!-- Projects Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('project_id', 'Project:') !!}
    {!! Form::select('project_id', App\Models\Project::pluck('name','id'), null, ['class' => 'form-control select2', 'required']) !!}
</div>
<!-- Projects Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('project_id', 'Project:') !!}
    {!! Form::select('project_id', App\Models\Project::pluck('name','id'), null, ['class' => 'form-control select2', 'required']) !!}
</div>
<!-- Url Field -->
<div class="form-group col-sm-12">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '5']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.news.index') !!}" class="btn btn-default">Cancel</a>
</div>
