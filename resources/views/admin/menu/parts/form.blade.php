<div class="row">
    <div class="col-12 col-md-4">
          <field-text label="name" field="name" :model="$menu" required  />
    </div>

</div>
<div class="row">
  <company-restaurant-select :model="$menu" showedIn="menu" />
</div>

<div class="row">
  <div class="col-12">
    @include('admin.menu.parts.menu-sections')
  </div>
</div>

@if($menu->id)
<div class="row mt-5">
    <div class="col-12">
          <button type="button" class="btn btn-primary btn-block btn-add-type-menu" data-toggle="modal" data-target="#modalTypeDish"><i class="fa fa-plus"></i> Add Type of plate</button>
    </div>
</div>
@endif

<div class="row mt-5">
  <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">@if($menu->id) {{ ucfirst(trans('button.save')) }} @else {{ ucfirst(trans('button.next')) }} @endif</button>
        </div>
  </div>
</div>
@push('scripts')
<script>
$(document).ready(function(){

    $(document).on('click', '.btn-add-type-menu', function(){
      $('#formType')[0].reset();
      $('#formType .parsley-errors-list').remove();
    });


});
</script>
@endpush
