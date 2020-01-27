<div class="form-group">
    <label for="{{ $field }}">Add {{ $label }}</label>
    <select class="form-control {{ $field }}-select2" name="{{ $field }}[]" multiple="multiple">
      @foreach($list as $item)
        <option value="{{ $item }}">{{ $item }}</option>
      @endforeach
    </select>

</div>
@push('scripts')
<script>
$(document).ready(function(){

    $('.{{ $field }}-select2').val([@foreach($model->$values as $value) "{{ trim($value) }}", @endforeach]);

    $('.{{ $field }}-select2').select2();

});
</script>
@endpush
