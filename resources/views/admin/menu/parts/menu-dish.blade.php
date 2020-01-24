<div class="row mt-3">
    <div class="col-12">
        <div class="row bg-dark p-3">
            <div class="col-12">
                <h4 class="text-white">{{ $section->translation->name }}</h4>
            </div>
            <div class="col-12 p-3" id="sortable_{{ $section->id }}">
                  @if( isset($section->products) )
                      @foreach($section->products as $product)
                        @include('admin.menu.parts.menu-dish-item')
                      @endforeach
                  @endif
            </div>
            <div class="col-12 pb-2">

                  @if($section->type == 'Dish')
                  <button type="button" class="btn btn-primary btn-block"  data-toggle="modal" data-target="#modalDish"><i class="fa fa-plus"></i> Add Plate</button>
                  @else
                  <button type="button" class="btn btn-primary btn-block"  data-toggle="modal" data-target="#modalDrink"><i class="fa fa-plus"></i> Add Drink</button>
                  @endif
            </div>
       </div>
    </div>
</div>
@push('scripts')
<script>
 $( function() {
   $( "#sortable_{{ $section->id }}" ).sortable({
     axis: "y",
     update: function( event, ui ) {

        $(this).children('.container-plate-preview').each(function(item, element) {

            $.ajax({
                url: "/admin/products/position/"+$(element).data('id'),
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

 } );
 </script>
@endpush
