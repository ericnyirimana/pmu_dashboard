<div class="row">
    <div class="col-12">
        <div class="table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.history_orders')) }}</b></h4>

            @if(isset($allTickets))
                <datatable class='tickets-datatable' route="ticket" :collection="$allTickets" :fields="[
                'ID'                        => 'id_formatted',
                'datatable.headers.date'    => 'date_formatted',
                'datatable.headers.hour'    => 'hour_formatted',
                'datatable.headers.offer'   => 'pickup_name',
                'datatable.headers.status'      => 'restaurant_status',
                ]"
                actions="view"           />
            @endif
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            $('.tickets-datatable').DataTable({
                "language": {
                    "url": "cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
                },
                "order": [[1, 'desc']]
            });

        });

    </script>
@endpush
