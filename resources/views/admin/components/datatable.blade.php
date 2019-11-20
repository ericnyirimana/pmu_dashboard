<table id="datatable" class="table ">
    <thead>
      <tr>
        @foreach ($fields as $field)
        <th>{{ $field }}</th>
        @endforeach
        <th style="width: 320px;">Actions</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($users as $user)
    <tr>
        @foreach ($fields as $key=>$field)
          <th>{{ $user->$key }}</th>
        @endforeach
        <td>
          <a href="{{ route('users.edit', $user->id )}}" class="btn btn-icon waves-effect waves-light btn-success"><i class="fa fa-search" aria-hidden="true"></i></a>
          <a href="#remove-register" class="btn btn-icon waves-effect waves-light btn-danger rm-register" data-name="{{ $user->name }}" data-register="{{ $user->id }}" data-toggle="modal" data-target=".remove-register"><i class="fa fa-trash" aria-hidden="true"></i></a>
      </td>
    </tr>
    @endforeach
    </tbody>
</table>

@include('admin.components.remove')

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

    $(document).on('click', '.rm-register', function(){

            var id = $(this).data('register');
            var name = $(this).data('name');

            $('.register-name').text(name);

            $('.rm-accept').attr('action', '/{{ $route }}/'+id);
    });

});
</script>
@endpush
