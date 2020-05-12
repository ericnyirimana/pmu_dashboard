<div class="row justify-content-end">
    <div class="col-2">
        <p>{{ __('labels.entries_to_be_welded') }}</p>
{{--        <p>{{ __('labels.orders_suspend') }}</p>--}}
{{--        <p>{{ __('labels.orders_deleted') }}</p>--}}
    </div>
    <div class="col-2">
        <p class="text-reset">{{ number_format(($balance->pending[0]->amount/100), 2, ',', '.').'€' }}</p>
{{--        <p class="text-right"></p>--}}
{{--        <p class="text-right"></p>--}}
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.history_payments')) }}</b></h4>

            <datatable class='payment-datatable' route='payments' parent='$restaurant->id' :collection="$payments"
                       :fields="[
                'datatable.headers.processing_date'  => 'created',
                'datatable.headers.total'            => 'amount',
                ]"
                  />
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
			$(document).ready(function() {
                $('.payment-datatable').dataTable({
                    "language": {
                        "url": "cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
                    }});

			});

    </script>
@endpush
