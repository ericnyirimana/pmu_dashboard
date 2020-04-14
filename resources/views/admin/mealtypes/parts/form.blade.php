<div class="d-flex flex-row row mb-5">
    <div class="col-md-12 col-lg-6 mb-3">
        @if(Auth::user()->is_restaurant)
        <field-text label="Tipologia di pasto" field="name" :model="$mealtype" disabled  />
        @else
        <field-text label="Tipologia di pasto" field="name" :model="$mealtype" required  />
        @endif
    </div>
    <div class="col-md-12 col-lg-8">
        <field-range-clock label="Seleziona orario di ritiro" field="range_clock" :model="$mealtype"  />
    </div>
</div>
<div class="d-flex flex-row row">
    <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">Salva</button>
        </div>
    </div>
</div>
