<table id="datatable" class="table @if(isset($class)) {{ $class }} @endif">
    <thead>
    <tr>
        @foreach ($fields as $key=>$field)
            <th>{{ __($key) }}</th>
        @endforeach
        @if(!empty($actions))
            <th style="cursor: inherit;"
                class="sorting_desc_disabled sorting_asc_disabled">{{ __('datatable.headers.actions') }}</th>
        @endif
    </tr>
    </thead>

    <tbody>

    @if($collection->count() > 0)
        @foreach ($collection as $model)
            <tr @if(!empty($model->deleted_at)) class="bg-danger text-white" @endif
                @if(isset($checkRow)) @if($model->commission_to_pay > 0.00 &&
                $model->payment->payment_method_types == "PROMO_CODE" &&
                $model->status == "COMPLETED")
                style="background-color: #c9e2b2;"
                @endif
                @endif
            >
                @foreach ($fields as $field)
                    @php $params = explode(':', $field) @endphp
                    @if( isset($params[1]) )
                        @php
                            $item = $params[1];
                            $type = $params[0];
                        @endphp
                        @switch( $type )
                            @case ('image')
                            <td><img src="{{ $model->getImageSize($item) }}" class="thumbnail-list"/></td>
                            @break
                            @case ('boolean')
                            <td><span class="label label-{{ $model->{$params[2]} }}">{{ $model->$item }}</span></td>
                            @break
                            @case ('color')
                            <td><span class="label label-{{ $model->{$params[2]} }}">{{ $model->$item }}</span></td>
                            @break
                            @default
                            <td>
                                @if(isset($model->$type->$item))
                                    @if(($item == 'payment_method_types'))
                                        {{ __('labels.' . $model->$type->$item) }}
                                    @else
                                        {{ $model->$type->$item }}
                                    @endif
                                @endif
                            </td>
                            @break
                        @endswitch
                    @else
                        <td>
                            @if(($model instanceof \App\Models\Showcase && $field == 'type') || ($model instanceof \App\Models\Order && $field == 'type_pickup') || ($model instanceof \App\Models\Order && $field == 'status'))
                                {{ __('labels.' . $model->{$field}) }}
                            @else
                                {{ $model->{$field} }}
                            @endif
                        </td>
                    @endif
                @endforeach
                @if(!empty($actions))
                    <td class="actions">
                        @if(!empty($actions) && strstr($actions, 'view') )
                            @if(!empty($parent))
                                <a href="{{ route($route.'.show', ['payout_id' => $model->id, 'restaurant_id'
                            => '5'] )}}">
                                    <img src="{{ URL::to('/') }}/img/pmu_icon_search.png" alt="">
                                </a>
                            @else
                                <a href="{{ route($route.'.show', $model->id )}}">
                                    <img src="{{ URL::to('/') }}/img/pmu_icon_search.png" alt="View" title="View">
                                </a>
                            @endif
                        @endif
                        @if(!empty($actions) && strstr($actions, 'edit'))
                            <a href="{{ route($route.'.edit', $model->id )}}">
                                <img src="{{ URL::to('/') }}/img/pmu_icon_edit.png" alt="Edit" title="Edit">
                            </a>
                        @endif
                        @if( !empty($actions) && strstr($actions, 'delete'))
                            @if(empty($model->deleted_at))
                                <a href="#remove-register"
                                   class="rm-register"
                                   data-name="{{ $model->name }}" data-register="{{ $model->id }}" data-toggle="modal"
                                   data-target=".remove-register">
                                    <img src="{{ URL::to('/') }}/img/pmu_icon_bin.png" alt="Delete" title="Delete">
                                </a>
                            @else
                                <a href="#remove-register"
                                   class="rm-register"
                                   data-name="{{ $model->name }}" data-register="{{ $model->id }}" data-toggle="modal"
                                   data-target=".remove-register">

                                    <img src="{{ URL::to('/') }}/img/pmu_icon_deny.png" alt="Delete" title="Delete">
                                </a>
                            @endif
                        @endif
                        @if(!empty($actions) && strstr($actions, 'replicate'))
                            <a href="{{ route($route.'.replicate', $model->id )}}">
                                <img src="{{ URL::to('/') }}/img/pmu_icon_copy.png" alt="Copy" title="Copy">
                            </a>
                        @endif

                    </td>
                @endif
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
@if( !empty($actions) && strstr($actions, 'delete'))
    <modal-remove :route='$route'/>
@endif
@push('styles')
    <!-- DataTables -->
    <link href="{{ asset("/plugins/datatables/dataTables.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("/plugins/datatables/buttons.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
@endpush
@push('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset("/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{ asset("/plugins/datatables/dataTables.bootstrap4.min.js")}}"></script>
@endpush
