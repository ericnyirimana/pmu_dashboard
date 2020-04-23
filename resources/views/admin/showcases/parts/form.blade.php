<div class="d-flex flex-row row mb-5">
    <div class="col-md-12 col-lg-6 mb-3">
        <field-text label="Titolo" field="title" :model="$showcases" required  />
    </div>
    <div class="col-md-12 col-lg-6 mb-3">
        <field-select label="Tipo" field="type" :model="$showcases" type="simple" :values="['categories' => 'Categoria', 'timeslots' => 'Fasce orarie', 'restaurants' => 'Ristorante' ]"  required  />
    </div>
    <div class="col-12">
        <field-tags label="Category" field="items" :values="$showcases->categories->pluck('translate.name')" :list="$categories" required  />
    </div>
</div>
<div class="d-flex flex-row row">
    <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">Salva</button>
        </div>
    </div>
</div>
