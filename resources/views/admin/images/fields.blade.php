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
<!-- Path Field -->
<div class="form-group col-sm-12">
    {!! Form::label('path', 'Path:') !!}
    {!! Form::file('path') !!}
</div>
<div class="clearfix"></div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.images.index') !!}" class="btn btn-default">Cancel</a>
</div>
