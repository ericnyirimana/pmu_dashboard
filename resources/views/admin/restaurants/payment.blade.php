@extends('admin.layouts.master')

@section('content')

@include('components.fields-require-alert')

<div class="row">
    <div class="col-12">
      <div class="card-box">
        <a href="{{ route('companies.show', $restaurant->company) }}" class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row justify-content-end">
            <div class="col-2">
                <p>{{ __('labels.processing_date') }}</p>
                <p>{{ __('labels.total') }}</p>
            </div>
            <div class="col-2">
                <p class="text-right">{{ date('d/m/Y', $payout->created) }}</p>
                <p class="text-right">{{ number_format(($payout->amount/100), 2, ',', '.').'€'  }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">

                    <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.history_payments')) }}</b></h4>

                    <datatable :collection="$transfers" :fields="[
                'datatable.headers.id'   => '',
                'datatable.headers.date' => '',
                'datatable.headers.offers' => '',
                'datatable.headers.gross' => '',
                'datatable.headers.pmu_fee' => '',
                'datatable.headers.net' => ''
                 ]"
                    />
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').dataTable({
                "language": {
                    "url": "cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
                }});

        });

    </script>
@endpush

@endsection
