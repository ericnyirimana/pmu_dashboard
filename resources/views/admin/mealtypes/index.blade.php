@extends('admin.layouts.master')

@section('content')


    @include('components.notification')

    <div class="row m-b-10">
        <div class="col-12">
            <a href="{{ route('mealtypes.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">Nuovo orario</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <datatable route='mealtypes' :collection='$mealtype' :fields="[
                  'Pasto'        => 'name',
                  'Orario'      => 'range_clock',
              ]"
                           actions="edit, delete" />
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
