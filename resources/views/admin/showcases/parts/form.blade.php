<div class="d-flex flex-row row mb-5">
    <div class="col-md-12 col-lg-6 mb-3">
        <field-text label="Titolo" field="title" :model="$showcase" required />
    </div>
    <div class="col-md-12 col-lg-6 mb-3">
        <field-select id="showcase_type" label="Tipo" field="type" :model="$showcase" type="simple" :values="['categories' => 'Categoria', 'timeslots' => 'Fasce orarie', 'restaurants' => 'Ristorante' ]"  required  />
    </div>
    <div class="col-12">
        <field-tags id="categories" label="Category" field="categories" :values="$categories->pluck('translate.name')" :list="$categories" required />

        {{--<field-tags id="restaurants" label="Category" field="restaurants" :values="$restaurants->pluck('name')" :list="$restaurants" required />--}}

        {{--<field-tags id="mealtypes" label="Category" field="mealtypes" :values="$mealtypes->pluck('translate.name')" :list="$mealtypes" required />--}}
    </div>
</div>
<div class="d-flex flex-row row">
    <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">Salva</button>
        </div>
    </div>
</div>


@push('scripts')
    <script>
			$(document).ready(function(){

              $(document).on('change', '#showcase_type', function(){

              });

			});
    </script>
@endpush
