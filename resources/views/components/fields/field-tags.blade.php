<div class="form-group">
    <label for="{{ $field }}">Add {{ $label }}</label>
    <select class="form-control {{ $field }}-select2" id="{{ $id }}" name="{{ $field }}[]" multiple="multiple" @if(isset($required)) parsley-trigger="change" required @endif @if($disabled == 'true') disabled @endif>
      @if($list)
      @foreach($list as $item)
        <option value="{{ $item }}">{{ $item }}</option>
      @endforeach
      @endif
    </select>

</div>
@push('scripts')
<script>

$(document).ready(function(){

    @if( isset($values) )
    $('.{{ $field }}-select2').val([@foreach($values as $value) "{{ trim($value) }}", @endforeach]);
    @endif
    $('.{{ $field }}-select2').select2();

});
</script>
@endpush
