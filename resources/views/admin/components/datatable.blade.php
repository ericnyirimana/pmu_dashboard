<table id="datatable" class="table ">
    <thead>
      <tr>
        @foreach ($fields as $key=>$field)
        <th>{{ $key }}</th>
        @endforeach
        <th style="width: 320px;">Actions</th>
    </tr>
    </thead>

    <tbody>

    @foreach ($collection as $model)
    <tr>
        @foreach ($fields as $field)

          @php $params = explode(':', $field) @endphp

          @if( isset($params[1]) )

            @php
              $item = $params[1];
              $type = $params[0];
            @endphp;

            @switch( $type )

                @case ('image')
                    <td><img src="{{ $model->getImageSize($item) }}" class="thumbnail-list" /></td>
                @break
                @default
                    <td><i class="fa fa-camera"></i></td>


            @endswitch

          @else
            <td>{{ $model->$field }}</td>
          @endif
        @endforeach
        <td>
          <a href="{{ route($route.'.edit', $model->id )}}" class="btn btn-icon waves-effect waves-light btn-success"><i class="fa fa-search" aria-hidden="true"></i></a>
          <a href="#remove-register" class="btn btn-icon waves-effect waves-light btn-danger rm-register" data-name="{{ $model->name }}" data-register="{{ $model->id }}" data-toggle="modal" data-target=".remove-register"><i class="fa fa-trash" aria-hidden="true"></i></a>
      </td>
    </tr>
    @endforeach
    </tbody>
</table>

@include('admin.components.modal-remove')

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
