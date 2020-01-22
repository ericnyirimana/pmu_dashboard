<div class="form-group">
    <label for="{{ $field }}">Add {{ $label }}</label>
    <select class="form-control {{ $field }}-select2" name="{{ $field }}[]" multiple="multiple">
      @foreach($values as $value)
        <option value="{{ $value }}">{{ $value }}</option>
      @endforeach
    </select>

</div>
@push('scripts')
<script>
$(document).ready(function(){

  $(document).ready(function() {
      $('.{{ $field }}-select2').select2();
  });

});
</script>
@endpush
