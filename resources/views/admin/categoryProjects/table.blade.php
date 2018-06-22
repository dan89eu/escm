<table class="table table-responsive" id="categoryProjects-table">
    <thead>
     <tr>
        <th>Category Id</th>
        <th>Project Id</th>
        <th>User Id</th>
        <th colspan="3">Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($categoryProjects as $categoryProject)
        <tr>
            <td>{!! $categoryProject->category_id !!}</td>
            <td>{!! $categoryProject->project_id !!}</td>
            <td>{!! $categoryProject->user_id !!}</td>
            <td>
                 <a href="{{ route('admin.categoryProjects.show', $categoryProject->id) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view categoryProject"></i>
                 </a>
                 <a href="{{ route('admin.categoryProjects.edit', $categoryProject->id) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit categoryProject"></i>
                 </a>
                 <a href="{{ route('admin.categoryProjects.confirm-delete', $categoryProject->id) }}" data-toggle="modal" data-target="#delete_confirm">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete categoryProject"></i>
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