<div class="row">
    <div class="col-12 col-md-4">
          <field-text label="Name" field="name" :model="$menu" required  />
    </div>
    <div class="col-6 col-md-4">
          @if($menu)
          <field-select label="Company" field="brand_id" type="relation" :model="$menu" :values="$menu->brand" foreignid="brand_id" required />
          @else
          <field-select label="Company" field="brand_id" type="relation" :model="$menu" :values="$brands" foreignid="brand_id" required />
          @endif
    </div>
    <div class="col-6 col-md-4">
          @if($menu)
          <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$menu" :values="$menu->restaurant" foreignid="restaurant_id" required />
          @else
          <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$menu" foreignid="restaurant_id" required />
          @endif
    </div>
</div>

<div class="list-menu-section" id="sortable_sections">
  @if( isset($menu->sections) )

      @foreach($menu->sections as $section)
          @include('admin.menu.parts.menu-dish')
      @endforeach
  @endif
</div>

@if($menu)
<div class="row mt-5">
    <div class="col-12">
          <button type="button" class="btn btn-primary btn-block btn-save-menu"  data-toggle="modal" data-target="#modalTypeDish"><i class="fa fa-plus"></i> Add Type of plate</button>
    </div>
</div>
@endif

<div class="row mt-5">
  <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">@if($menu) Save @else Next @endif</button>
        </div>
  </div>
</div>
@push('modal')
@if( $menu )
  @include('admin.menu.parts.modal-type-dish')

@endif
@endpush

@push('scripts')
<script>
$(document).ready(function(){

    $( "#sortable_sections" ).sortable({
      axis: "y",
      update: function( event, ui ) {

         $(this).children('.container-sections').each(function(item, element) {

             $.ajax({
                 url: "/admin/section/position/"+$(element).data('id'),
                 type: 'POST',
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 dataType: 'json',
                 data: {position: item},
                 success: function(data) {

                 }
             });

         })
      }
    });

    $(document).on('change', '#brand_id', function(){

        if ($(this).val()) {

          $.ajax({
              url: "{{ route('brand.restaurants.data') }}/"+$(this).val(),

              type: 'GET',
              success: function(data) {

                  $("#restaurant_id").html('');

                  $.each(data, function(i, restaurant){

                      $("#restaurant_id").append('<option value="' + restaurant.id + '">' + restaurant.name + '</option>')
                  });
              }
          });

        } else {
          $("#restaurant_id").html('<option>Select Company first</option>');
        }

    });

});
</script>
@endpush
