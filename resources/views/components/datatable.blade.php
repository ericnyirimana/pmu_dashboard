<table id="datatable" class="table">
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
            @endphp
            @switch( $type )
                @case ('image')
                    <td><img src="{{ $model->getImageSize($item) }}" class="thumbnail-list" /></td>
                @break
                @case ('boolean')
                    <td><span class="label label-{{ $model->{$params[2]} }}">{{ $model->$item }}</span></td>
                @break
                @case ('color')
                    <td><span class="label label-{{ $model->{$params[2]} }}">{{ $model->$item }}</span></td>
                @break
                @default
                    <td>{{ $model->$type->$item }}</td>
                @break
            @endswitch
          @else
            <td>{{ $model->{$field} }}</td>
          @endif
        @endforeach
        <td class="actions">

          @if( empty($actions) || strstr($actions, 'view') )
          <a href="{{ route($route.'.show', $model->id )}}" class="btn btn-icon waves-effect waves-light btn-info"><i class="fa fa-search" aria-hidden="true"></i></a>
          @endif
          @if( empty($actions) || strstr($actions, 'edit'))
          <a href="{{ route($route.'.edit', $model->id )}}" class="btn btn-icon waves-effect waves-light btn-success"><i class="fa fa-edit" aria-hidden="true"></i></a>
          @endif
          @if( empty($actions) || strstr($actions, 'delete'))
          <a href="#remove-register" class="btn btn-icon waves-effect waves-light btn-danger rm-register" data-name="{{ $model->name }}" data-register="{{ $model->id }}" data-toggle="modal" data-target=".remove-register"><i class="fa fa-trash" aria-hidden="true"></i></a>
          @endif
      </td>
    </tr>
    @endforeach
    </tbody>
</table>

<modal-remove :route='$route' />

@push('styles')
<!-- DataTables -->
<link href="{{ asset("/plugins/datatables/dataTables.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{ asset("/plugins/datatables/buttons.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
<!-- Required datatable js -->
<script src="{{ asset("/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("/plugins/datatables/dataTables.bootstrap4.min.js")}}"></script>
@endpush