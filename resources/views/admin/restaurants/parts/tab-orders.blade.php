<div class="row">
    <div class="col-12">
        <div class="table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.history_orders')) }}</b></h4>

                <datatable class='orders-datatable' route='orders-pickup' :collection="$ordersPickup" :fields="[
                'datatable.headers.date'      => 'order:date_format',
                'datatable.headers.hour'      => 'order:hour_format',
                'ID' => 'order:id',
                'datatable.headers.offer'      => 'pickup:name',
                'datatable.headers.price' => 'pickup:price',
                'datatable.headers.status'      => 'order:status',
                ]"
                actions='view' />
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
			$(document).ready(function() {

                $('.orders-datatable').dataTable({
                    "language": {
                        "url": "cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
                    }});

			});

    </script>
@endpush
