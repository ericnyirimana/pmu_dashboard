<div class="row">
    <div class="col-12">
        <div class="table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.history_payments')) }}</b></h4>

            {{--<datatable route='payments' :collection="$payments" :fields="[--}}
                {{--'datatable.headers.date_hour'      => 'created_at',--}}
                {{--'datatable.headers.total'      => '',--}}
                {{--]"--}}
                       {{--actions='view' />--}}
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
			$(document).ready(function() {


			});

    </script>
@endpush
