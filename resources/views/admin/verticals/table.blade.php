<table class="table table-responsive" id="verticals-table">
    <thead>
     <tr>
        <th>Name</th>
        <th colspan="3">Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($verticals as $vertical)
        <tr>
            <td>{!! $vertical->name !!}</td>
            <td>
                 <a href="{{ route('admin.verticals.show', $vertical->id) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view vertical"></i>
                 </a>
                 <a href="{{ route('admin.verticals.edit', $vertical->id) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit vertical"></i>
                 </a>
                 <a href="{{ route('admin.verticals.confirm-delete', $vertical->id) }}" data-toggle="modal" data-target="#delete_confirm">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete vertical"></i>
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