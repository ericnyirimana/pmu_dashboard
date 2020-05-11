@extends('admin.layouts.master')

@section('content')


    @include('components.notification')

{{--<div class="row m-b-10">
    <div class="col-12">
        {{--<a h"{{ route('timeslots.create' )}}" class="btn btn-success waves-effect w-md waves-light
        pull-right">{{ __('button.new_hour') }}</a>
        </div>
    </div>--}}
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <datatable route='timeslots' :collection='$timeslots' :fields="[
                  'datatable.headers.meal' => 'name',
                  'datatable.headers.opening_hours'  => 'hour_ini',
                  'datatable.headers.closing_time'  => 'hour_end',
                  'datatable.headers.restaurant' => 'restaurant_name'
              ]"
                           actions="edit, delete" />
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
			$(document).ready(function() {

				$('#datatable').DataTable({});

			});

    </script>
@endpush
