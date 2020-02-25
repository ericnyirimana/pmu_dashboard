<div class="form-group">
  <div class="form-check-label">
    @if(isset($label))<label>{{ $label }}</label>@endif
  </div>
@foreach($items as $key=>$item)
  <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="{{ $field }}" id="{{ $field }}_{{ $item }}" value="{{ $key }}" @if(isset($model) && $model->$field == $key) checked @endif required>
      <label class="form-check-label" for="{{ $field }}_{{ $item }}">
        {{ $item }}
      </label>
  </div>
@endforeach
</div>
