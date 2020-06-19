<div class="form-group">
    <label for="{{ $field }}">{{ __('labels.'.$label) }}</label>
    @if ($type=='relation')

      <select id="{{ isset($id) ? $id : $field }}" class="form-control" name="{{ isset($fieldname) ? $fieldname :
      $foreignid
      }}" aria-describedby="{{ $field }}Help" @if(isset($required)) parsley-trigger="change" required @endif @if(isset($disabled)) disabled @endif @if(isset($readonly)) readonly @endif>
          @if (isset($values))

            @if( is_array($values) ||  is_a($values, 'Illuminate\Database\Eloquent\Collection') )
                <option value="">Select {{ __('labels.'.$label) }}</option>
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
      @if(empty($foreignid)) @php $foreignid = $field; @endphp @endif
      <select id="{{ isset($id) ? $id : $field }}" class="form-control" name="{{ isset($fieldname) ? $fieldname : $field }}"
              aria-describedby="{{ $field }}Help" @if(isset($required)) parsley-trigger="change" required @endif @if(isset($disabled) && ($model->id)) disabled @endif>
          <option value="">Select {{ __('labels.'.$label) }}</option>

          @foreach($values as $k=>$value)
            <option value="{{ $k }}" @if (old( $foreignid, $model->$foreignid ) == $k) selected @endif>{{ $value }}</option>
          @endforeach
      </select>
    @endif

    @if(isset($help))<small id="{{ $field }}Help" class="form-text text-muted">{{ $help }}</small>@endif
</div>
