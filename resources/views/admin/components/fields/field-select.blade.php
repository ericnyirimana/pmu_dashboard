<div class="form-group">
    <label for="{{ $field }}">{{ $label }}</label>
    @if ($type=='relation')
      <select id="{{ $field }}" class="form-control" name="{{ $foreignid }}" aria-describedby="{{ $field }}Help" @if(isset($required)) parsley-trigger="change" required @endif>
          <option value="">Select {{ $label }}</option>
          @foreach($values as $value)
            <option value="{{ $value->id }}" @if (old( $foreignid, isset($model) && $model->$foreignid ) == $value->id) selected @endif>{{ $value->field_show }}</option>
          @endforeach
      </select>
    @endif
    @if ($type=='simple')
    
      <select id="{{ $field }}" class="form-control" name="{{ $field }}" aria-describedby="{{ $field }}Help" @if(isset($required)) parsley-trigger="change" required @endif>
          <option value="">Select {{ $label }}</option>
          @foreach($values as $value)
            <option value="{{ $value }}" @if (old( $field, $model->$field ) == $value) selected @endif>{{ $value }}</option>
          @endforeach
      </select>
    @endif

    @if(isset($help))<small id="{{ $field }}Help" class="form-text text-muted">{{ $help }}</small>@endif
</div>
