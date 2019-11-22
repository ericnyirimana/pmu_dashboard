<div class="form-group">
    <label for="{{ $field }}">{{ $label }}</label>
    @if ($type=='relation')
      <select id="{{ $field }}" class="form-control" name="{{ $foreignid }}" aria-describedby="{{ $field }}Help" @if(isset($required)) parsley-trigger="change" required @endif>
          <option value="">Select {{ $label }}</option>
          @foreach($values as $value)
            <option value="{{ $value->id }}" @if (old( $foreignid, isset($model) && $model->$foreignid ) == $value->id) selected @endif>{{ $value->field_show }}</option>
          @endforeach
      </select>
      @if(isset($help))<small id="{{ $field }}Help" class="form-text text-muted">{{ $help }}</small>@endif
    @endif
</div>
