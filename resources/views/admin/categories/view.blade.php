@extends('admin.layouts.master')

@section('content')


@include('components.notification')
<div class="row m-b-10 card-box ">
      <div class="col-md-4 col-lg-2">
          <figure>
            @if ( empty($company->image) )
            <i class="fa fa-file-image-o fa-2x"></i>
          @else
              <img src="{{ $company->getImageSize('medium') }}" class="rounded" />
          @endif
        </figure>
    </div>
    <div class="col-md-8 col-lg-10">
          <h2>{{ $company->name }}</h2>
          <p>{{ $company->corporate_name }}  </p>
          <p><label>VAT</label> {{ $company->vat }}</p>

    </div>
    <div class="col-12">{{ $company->description }}</div>
</div>

<div class="row card-box">
    <div class="col-12">
        <a href="{{ route('restaurants.create') }}" class="btn btn-success waves-effect w-md waves-light pull-right">New Restaurant</a>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <h4 class="m-t-0 header-title"><b>List restaurants</b></h4>
                <datatable route='restaurants' :collection="$company->restaurants" :fields="[
                'ID' => 'id',
                'Name' => 'name',
                'City' => 'city'
                ]" />
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
