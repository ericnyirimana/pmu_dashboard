<div class="d-flex flex-row row mb-5">
    <div class="col-md-12 col-lg-6 mb-3">
        <field-text label="meal_type" field="name" :model="$mealtype" required  />
    </div>
    <div class="col-md-12 col-lg-8">
        <field-range-clock label="select_pickup_hour" field="range_clock" :model="$mealtype"  />
    </div>
</div>
<div class="d-flex flex-row row">
    <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">{{ ucfirst(trans('button.save')) }}</button>
        </div>
    </div>
</div>
