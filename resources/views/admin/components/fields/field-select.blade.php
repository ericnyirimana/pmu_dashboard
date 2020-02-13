<div class="form-group">
    <label for="{{ $field }}">{{ $label }}</label>
    @if ($type=='relation')

      <select id="{{ isset($id) ? $id : $field }}" class="form-control" name="{{ $foreignid }}" aria-describedby="{{ $field }}Help" @if(isset($required)) parsley-trigger="change" required @endif @if(isset($disabled) && ($model)) disabled @endif>
          @if (isset($values))

            @if( is_array($values) ||  is_a($values, 'Illuminate\Database\Eloquent\Collection') )
                <option value="">Select {{ $label }}</option>
                @foreach($values as $value)
                  <option value="{{ $value->id }}" @if (old( $foreignid, $model->$foreignid ) == $value->id) selected @endif>{{ $value->field_show }}</option>
                @endforeach
            @else
                <option value="{{ $values->id }}" @if (old( $foreignid, $model->$foreignid ) == $values->id) selected @endif>{{ $values->field_show }}</option>
            @endif
          @endif
      </select>
    @endif

    @if ($type=='simple')
      <select id="{{ isset($id) ? $id : $field }}" class="form-control" name="{{ $field }}" aria-describedby="{{ $field }}Help" @if(isset($required)) parsley-trigger="change" required @endif @if(isset($disabled) && ($model)) disabled @endif>
          <option value="">Select {{ $label }}</option>

          @foreach($values as $k=>$value)
            <option value="{{ $value }}" @if (old( $foreignid, $model->$foreignid ) == $value) selected @endif>{{ $k }}</option>
          @endforeach
      </select>
    @endif

    @if(isset($help))<small id="{{ $field }}Help" class="form-text text-muted">{{ $help }}</small>@endif
</div>
