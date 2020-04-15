<div class="form-group">
    <div class="form-check-label">
        @if(isset($label))<label>{{ $label }}</label>@endif
    </div>
    @foreach($items as $key=>$item)
        <div class="form-check form-check-inline col-md-12 col-lg-2">
            <input class="form-check-input" type="checkbox" name="{{ $field }}" id="{{ $field }}_{{ $item }}" value="{{ $key }}" @if(isset($model) && $model->$field == $key) checked @endif @if(isset($required)) required @endif @if(isset($disabled)) disabled @endif>
            <label class="form-check-label" for="{{ $field }}_{{ $item }}">
                {{ $item }}
            </label>
        </div>
    @endforeach
</div>
