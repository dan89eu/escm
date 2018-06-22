<table class="table table-responsive" id="categories-table">
    <thead>
     <tr>
        <th>Code</th>
        <th>Name</th>
        <th>User Id</th>
        <th colspan="3">Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>{!! $category->code !!}</td>
            <td>{!! $category->name !!}</td>
            <td>{!! $category->user_id !!}</td>
            <td>
                 <a href="{{ route('admin.categories.show', $category->id) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view category"></i>
                 </a>
                 <a href="{{ route('admin.categories.edit', $category->id) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit category"></i>
                 </a>
                 <a href="{{ route('admin.categories.confirm-delete', $category->id) }}" data-toggle="modal" data-target="#delete_confirm">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete category"></i>
                 </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@section('footer_scripts')
    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
@stop