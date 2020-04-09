@extends('admin.layouts.master')

@section('content')


    @include('components.notification')

    <div class="row m-b-10">
        <div class="col-12">
            <a href="{{ route('timeslots.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">Nuovo orario</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                {{--<datatable route='timeslots' :collection='$timeslot' :fields="[--}}
                  {{--'Type'        => 'mealtype_id',--}}
                  {{--'Orario inizio'      => 'hour_ini',--}}
                  {{--'Orario fine'     => 'hour_end'--}}
              {{--]"--}}
                           {{--actions="edit, delete" />--}}
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
			$(document).ready(function() {

				$('#datatable').DataTable({


				});

			});

    </script>
@endpush
