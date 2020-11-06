@if(Route::currentRouteName() == 'menu.edit' && !Auth::user()->is_super)
<div class="alert alert-primary" role="alert">
Il tuo menù è approvato. Se vuoi effettuare delle modifiche alla sua struttura, manda una email a <a href="mailto:ristoranti@pickmealup.com">ristoranti@pickmealup.com</a>
</div>
@endif
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

@if($menu->id && Auth::user()->is_super)
<div class="row mt-5">
    <div class="col-12">
          <button type="button" class="btn btn-primary btn-block btn-add-type-menu" data-toggle="modal" data-target="#modalTypeDish"><i class="fa fa-plus"></i> Add Type of plate</button>
    </div>
</div>
@endif

<div class="row mt-5">
  <div class="col-12">
        <div class="form-group d-flex align-items-center justify-content-between">
            <button type="submit" class="btn btn-block w-lg btn-success col-5" @if($menu->has_products_in_active_pickup) disabled @endif>
                @if($menu->id) {{ ucfirst(trans('button.save')) }} @else {{ ucfirst(trans('button.next')) }}
                @endif
            </button>
            @if($menu->id)
                @if(Auth::user()->is_super)
                    @if(!$menu->is_approved)
                        <button type="submit" name="status_menu" value="APPROVED" class="btn w-lg btn-primary col-5" @if($menu->has_products_in_active_pickup) disabled @endif>
                            {{ ucfirst(trans('button.approves')) }}
                        </button>
                    @else
                        <button type="submit" name="status_menu" value="DISABLED" class="btn w-lg btn-primary col-5" @if($menu->has_products_in_active_pickup) disabled @endif>
                            {{ ucfirst(trans('button.disable'))  }}
                        </button>
                    @endif
                @elseif(!Auth::user()->is_super && !$menu->is_approved)
                    <button type="submit"  name="status_menu" value="PENDING" class="btn w-lg btn-primary col-5" @if($menu->has_products_in_active_pickup) disabled @endif>
                        {{ ucfirst(trans('button.send_approves')) }}
                    </button>
                @endif
            @endif
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
