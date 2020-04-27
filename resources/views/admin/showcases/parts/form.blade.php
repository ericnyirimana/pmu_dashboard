<div class="d-flex flex-row row mb-5">
    <div class="col-md-12 col-lg-6 mb-3">
        <field-text label="Titolo" field="title" :model="$showcase" required />
    </div>
    <div class="col-md-12 col-lg-6 mb-3">
        <field-select id="showcase_type" label="Tipo" field="type" :model="$showcase" type="simple"
                      :values="['categories' => 'Categoria', 'mealtypes' => 'Fasce orarie', 'restaurants' =>
                      'Ristorante' ]"  required />
    </div>
    <div class="col-12" style="@if(!$showcase->id || $showcase->type != 'categories') display:none @endif" id="categories">
        <field-tags id="categories_field" label="Category" field="categories" :values="$showcase->categories->pluck('translate.name')" :list="$categories" required disabled="{{ !$showcase->id || $showcase->type != 'categories' ? 'true' : 'false' }}" />
    </div>
    <div class="col-12" style="@if(!$showcase->id || $showcase->type != 'restaurants') display:none @endif" id="restaurants">
        <field-tags id="restaurants_field" label="Restaurant" field="restaurants" :values="$showcase->restaurants->pluck('name')" :list="$restaurants" required disabled="{{ !$showcase->id || $showcase->type != 'restaurants' ? 'true' : 'false' }}" />
    </div>
    <div class="col-12" style="@if(!$showcase->id || $showcase->type != 'mealtypes') display:none @endif"
         id="mealtypes">
        <field-tags id="mealtypes_field" label="Mealtype" field="mealtypes" :values="$showcase->mealtypes->pluck
        ('translate.name')" :list="$mealtypes" required disabled="{{ !$showcase->id || $showcase->type != 'mealtypes' ?
        'true' : 'false' }}" />
    </div>
</div>
<div class="d-flex flex-row row">
    <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">{{ ucfirst(trans('button.save')) }}</button>
        </div>
    </div>
</div>


@push('scripts')
    <script>
			$(document).ready(function(){

              @if (!$showcase->id || $showcase->type != 'categories')
                $('#categories_field').prop("required", false);
              @endif

              @if (!$showcase->id || $showcase->type != 'restaurants')
                $('#restaurants_field').prop("required", false);
              @endif

              @if (!$showcase->id || $showcase->type != 'mealtypes')
                $('#mealtypes_field').prop("required", false);
              @endif

              $(document).on('change', '#showcase_type', function(){
                if ($(this).val() == "categories") {
                  $('#categories').show();
                  $('#restaurants, #mealtypes').hide();
                  $('#categories_field').prop({"disabled": false, "required": true});
                  $('#restaurants_field, #mealtypes_field').prop({"disabled": true, "required": false});
                } else if ($(this).val() == "restaurants") {
                  $('#restaurants').show();
                  $('#categories, #mealtypes').hide();
                  $('#restaurants_field').prop({"disabled": false, "required": true});
                  $('#categories_field, #mealtypes_field').prop({"disabled": true, "required": false});
                } else {
                  $('#mealtypes').show();
                  $('#categories, #restaurants').hide();
                  $('#mealtypes_field').prop({"disabled": false, "required": true});
                  $('#categories_field, #restaurants_field').prop({"disabled": true, "required": false});
                }
              });

			});
    </script>
@endpush
