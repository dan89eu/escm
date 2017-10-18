<table class="table table-responsive" id="projects-table">
    <thead>
     <tr>
        <th>Name</th>
        <th>Initialcost</th>
        <th>Contracting Date</th>
        <th>Eta Delivery Date</th>
        <th colspan="3">Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($projects as $project)
        <tr>
            <td>{!! $project->name !!}</td>
            <td>{!! $project->initialCost !!}</td>
            <td>{!! $project->contracting_date !!}</td>
            <td>{!! $project->eta_delivery_date !!}</td>
            <td>
                 <a href="{{ route('admin.projects.show', $project->id) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view project"></i>
                 </a>
                 <a href="{{ route('admin.projects.edit', $project->id) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit project"></i>
                 </a>
                 <a href="{{ route('admin.projects.confirm-delete', $project->id) }}" data-toggle="modal" data-target="#delete_confirm">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete project"></i>
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