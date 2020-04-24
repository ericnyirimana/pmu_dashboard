@extends('admin.layouts.master')

@section('content')


    @include('components.notification')

    <div class="row m-b-10">
        <div class="col-12">
            <a href="{{ route('showcases.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">Nuova vetrina</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">

                <h4 class="m-t-0 header-title"><b>Vetrine</b></h4>

                <datatable route='showcases' :collection="$showcase" :fields="[
                'Titolo'    => 'title',
                'Tipo'  => 'type'
                ]"
                           actions="edit,delete" />
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
