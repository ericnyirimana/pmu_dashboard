<div class="d-flex flex-row row mt-3">
    <div class="col-12">
        <div class="row bg-dark p-3">
            <div class="col-12">
                <h4 class="text-white">Primo</h4>
            </div>
            <div class="col-12 p-3" id="sortable">
                  @include('admin.menu.parts.menu-dish-item')
                  @include('admin.menu.parts.menu-dish-item')
                  @include('admin.menu.parts.menu-dish-item')

            </div>
            <div class="col-12 pb-2">
                  <button type="button" class="btn btn-primary btn-block"  data-toggle="modal" data-target="#modalDish"><i class="fa fa-plus"></i> Add plate</button>
            </div>
       </div>
    </div>
</div>
@include('admin.menu.parts.modal-dish')
@push('scripts')
<script>
 $( function() {
   $( "#sortable" ).sortable();

 } );
 </script>
@endpush
