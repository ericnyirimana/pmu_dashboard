@extends('admin.layouts.master')

@section('content')

@if (session('notification') )
  @component('components.notification')
      @slot('type')
          {{ session('type-notification') }}
      @endslot
      {{ session('notification') }}
  @endcomponent
@endif
<tag-form :action="route('filtering-orders.data')" method="get">
@include('admin.orders.parts.form-filter')
</tag-form>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.todays_orders')) }}</b></h4>
              <datatable route='orders' :collection="$order" :fields="[
                'datatable.headers.date'      => 'date_format',
                'datatable.headers.hour'      => 'hour_format',
                'ID' => 'id',
                'datatable.headers.payment_method' => 'payment:payment_method_types',
                'datatable.headers.total_amount' => 'total_amount',
                'datatable.headers.commission_to_pay' => 'commission_to_pay',
                'datatable.headers.status'      => 'status',
                ]"
              actions="view" />
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $('#datatable').DataTable({

            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
            }
        });

    });

</script>
@endpush