@extends('admin.layouts.master')

@section('content')


    @include('components.notification')

    <div class="row m-b-10">
        <div class="col-12">
            <a href="{{ route('showcases.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.new_showcase')) }}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">

                <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_showcases')) }}</b></h4>

                <datatable route='showcases' :collection="$showcase" :fields="[
                'datatable.headers.title'    => 'title',
                'datatable.headers.type'  => 'type'
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
                    "language": {
                        "url": "cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
                    }
				});

			});

    </script>
@endpush
