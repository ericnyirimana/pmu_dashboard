<div class="form-group">
    <label for="{{ $field }}">{{ $label }}</label>
    @if ($type=='relation')

      <select id="{{ isset($id) ? $id : $field }}" class="form-control" name="{{ $foreignid }}" aria-describedby="{{ $field }}Help" @if(isset($required)) parsley-trigger="change" required @endif @if(isset($disabled) && ($model->id)) disabled @endif>
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
      @if(empty($foreignid)) @php $foreignid = $field; @endphp @endif
      <select id="{{ isset($id) ? $id : $field }}" class="form-control" name="{{ $field }}" aria-describedby="{{ $field }}Help" @if(isset($required)) parsley-trigger="change" required @endif @if(isset($disabled) && ($model->id)) disabled @endif>
          <option value="">Select {{ $label }}</option>

          @foreach($values as $k=>$value)
            <option value="{{ $k }}" @if (old( $foreignid, $model->$foreignid ) == $k) selected @endif>{{ $value }}</option>
          @endforeach
      </select>
    @endif

    @if(isset($help))<small id="{{ $field }}Help" class="form-text text-muted">{{ $help }}</small>@endif
</div>
@push('scripts')
<script>
$(document).ready(function(){

    $(document).on('change', '#brand_id', function(){

        if ($(this).val()) {

          $.ajax({
              url: "{{ route('company.restaurants.data') }}/"+$(this).val(),

              type: 'GET',
              success: function(data) {

                  $("#restaurant_id").html('');

                  $.each(data, function(i, restaurant){

                      $("#restaurant_id").append('<option value="' + restaurant.id + '">' + restaurant.name + '</option>')
                  });
              }
          });

        } else {
          $("#restaurant_id").html('<option>Select Company first</option>');
        }

    });

});
</script>
@endpush
