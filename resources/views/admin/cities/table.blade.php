<table class="table table-responsive" id="cities-table">
    <thead>
     <tr>
        <th>Name</th>
        <th>User Id</th>
        <th>Lat</th>
        <th>Lng</th>
        <th colspan="3">Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($cities as $city)
        <tr>
            <td>{!! $city->name !!}</td>
            <td>{!! $city->user_id !!}</td>
            <td>{!! $city->lat !!}</td>
            <td>{!! $city->lng !!}</td>
            <td>
                 <a href="{{ route('admin.cities.show', $city->id) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view city"></i>
                 </a>
                 <a href="{{ route('admin.cities.edit', $city->id) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit city"></i>
                 </a>
                 <a href="{{ route('admin.cities.confirm-delete', $city->id) }}" data-toggle="modal" data-target="#delete_confirm">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete city"></i>
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