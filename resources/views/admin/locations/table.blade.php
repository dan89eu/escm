<table class="table table-responsive" id="locations-table">
    <thead>
     <tr>
        <th>Formatted Address</th>
        <th>County Name</th>
        <th>Country Name</th>
        <th>Locality Name</th>
        <th colspan="3">Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($locations as $location)
        <tr>
            <td>{!! $location->formatted_address !!}</td>
            <td>{!! $location->county_name !!}</td>
            <td>{!! $location->country_name !!}</td>
            <td>{!! $location->locality_name !!}</td>
            <td>
                 <a href="{{ route('admin.locations.show', $location->id) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view location"></i>
                 </a>
                 <a href="{{ route('admin.locations.edit', $location->id) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit location"></i>
                 </a>
                 <a href="{{ route('admin.locations.confirm-delete', $location->id) }}" data-toggle="modal" data-target="#delete_confirm">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete location"></i>
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