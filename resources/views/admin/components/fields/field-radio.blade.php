<div class="form-group">
@foreach($items as $item)
<div class="form-check">
    <input class="form-check-input" type="radio" name="{{ $field }}" id="{{ $field }}_{{ $item }}" value="{{ $item }}" required>
    <label class="form-check-label" for="{{ $field }}_{{ $item }}">
      {{ $item }}
    </label>
</div>
@endforeach
</div>
