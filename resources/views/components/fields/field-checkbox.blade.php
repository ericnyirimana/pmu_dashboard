<div class="form-group">
    <div class="form-check-label">
        @if(isset($label))<label>{{ __('labels.'.$label) }}</label>@endif
    </div>

    @foreach($items as $key=>$item)
        <div class="form-check form-check-inline col-md-12 col-lg-2">
            <input class="form-check-input" type="checkbox" onclick="check('{{ $key }}', '{{ $item }}')" name="all_timeslots[]" id="{{ $field }}_{{ $item }}"
                   value="{{ $key }}"
                   @if(isset($model) && $model->filter(function($elem) use ($field, $key) {
                        return $elem->$field == $key;
                   })->first())
                   checked
                   @endif
                   @if(isset($required)) required @endif
                   @if(isset($disabled)) disabled @endif />
            <input id='hidden_{{ $field }}_{{ $item }}' type='hidden'
            @if(isset($model) && $model->filter(function($elem) use ($field, $key) {
                        return $elem->$field == $key;
                   })->first())
                   value='{{ $key }}| true'
                   @else
                   value='{{ $key }}| false'
                   @endif name='timeslots[]'>
            <label class="form-check-label" for="{{ $field }}_{{ $item }}">
                {{ ucfirst($item) }}
            </label>
        </div>
    @endforeach
</div>
@push('scripts')
<script>
function check(key, valueItem) {
    console.log('mealtype_id_'+valueItem);
    if(document.getElementById('mealtype_id_'+valueItem).checked) {
        document.getElementById('hidden_mealtype_id_'+valueItem).value = key +'| true';
    }
    else
    {
        document.getElementById('hidden_mealtype_id_'+valueItem).value = key +'| false';
    }
}
</script>
@endpush
