<div class="form-group">
    <div class="form-check-label">
        <label for="{{ $field }}">{{ __('labels.'.$label) }}</label>
    </div>
    <div class="row form-check form-check-inline" id="{{ $field }}">
        @if( is_array($values) ||  is_a($values, 'Illuminate\Database\Eloquent\Collection') )
            @foreach($values as $value)
                @php $value_id = $value->mealtype_id @endphp
                <input class="form-check-input" type="checkbox" name="timeslot_id[]" id="{{ $field }}_{{ $value->name }}"
                    value="{{ $value_id }}"
                    @if(isset($model) && $model->filter(function($elem) use ($value_id) {
                            return $elem->mealtype_id == $value_id;
                    })->first())
                    checked
                    @endif
                    @if(isset($required)) required @endif
                    @if(isset($disabled)) disabled @endif />
                <label class="form-check-label" for="{{ $field }}_{{ $value->name }}" style="margin-right: 20px;">
                    {{ ucfirst($value->name) }}
                </label>
            @endforeach
        @endif
    </div>
</div>