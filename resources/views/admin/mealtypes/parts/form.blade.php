<div class="d-flex flex-row row mb-5">
    <div class="col-md-8 col-lg-6 mb-3">
        <field-text label="meal_type" field="name" :model="$mealtype" required/>
    </div>
    <div class="col-md-4 col-lg-6 mb-3">
        <div class="form-group">
            <div class="form-check-label">
                <label>{{ __('labels.all_day') }}</label>
            </div>
            <div class="form-check form-check-inline col-md-12 col-lg-2">
                <input class="form-check-input" id="checkbox" type="checkbox" value="true" name="all_day" @if($mealtype->all_day) checked="checked" @endif>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-8">
        <field-range-clock label="select_pickup_hour" field="range_clock" :model="$mealtype"/>
    </div>
</div>
<div class="d-flex flex-row row">
    <div class="col-12">
        <div class="form-group">
            <button type="submit"
                    class="btn btn-block w-lg btn-success float-right">{{ ucfirst(trans('button.save')) }}</button>
        </div>
    </div>
</div>
