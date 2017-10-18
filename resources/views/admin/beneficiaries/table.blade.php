<table class="table table-responsive" id="beneficiaries-table">
    <thead>
     <tr>
        <th>Name</th>
        <th>Address</th>
        <th>User Id</th>
        <th colspan="3">Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($beneficiaries as $beneficiary)
        <tr>
            <td>{!! $beneficiary->name !!}</td>
            <td>{!! $beneficiary->address !!}</td>
            <td>{!! $beneficiary->user_id !!}</td>
            <td>
                 <a href="{{ route('admin.beneficiaries.show', $beneficiary->id) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view beneficiary"></i>
                 </a>
                 <a href="{{ route('admin.beneficiaries.edit', $beneficiary->id) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit beneficiary"></i>
                 </a>
                 <a href="{{ route('admin.beneficiaries.confirm-delete', $beneficiary->id) }}" data-toggle="modal" data-target="#delete_confirm">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete beneficiary"></i>
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