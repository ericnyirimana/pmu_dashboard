@extends('admin.layouts.master')

@section('content')


    @include('components.notification')

    <div class="row m-b-10">
        <div class="col-12">
            <a href="{{ route('mealtypes.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.new_mealtype')) }}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <datatable route='mealtypes' :collection='$mealtype' :fields="[
                  'datatable.headers.meal'        => 'name',
                  'datatable.headers.opening_hours'  => 'hour_ini',
                  'datatable.headers.closing_time'  => 'hour_end'
              ]"
                           actions="edit" />
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
			$(document).ready(function() {

				$('#datatable').DataTable({
                    "language": {
                        "url": "cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
                    }

				});

			});

    </script>
@endpush
