<div class="form-group">
  <label for="{{ $field }}">{{ $label }}</label>
  <div class="input-group mb-3">
      @if( isset($preprend) )
      <div class="input-group-prepend">
          <span class="input-group-text">{{ $preprend }}</span>
      </div>
      @endif
      <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control" aria-label="{{ $label }}" value="{{ old($field, isset($model) ? $model->$field : '') }}" @if(isset($required)) parsley-trigger="change" required @endif>
      @if ( isset($append) )
      <div class="input-group-append">
          <span class="input-group-text">{{ $append }}</span>
      </div>
      @endif
  </div>
</div>
@push('scripts')
<script type="text/javascript">
@if(isset($mask))
$(document).ready(function(){

  $('#{{ $field }}').mask('{{ $mask }}');

});
@endif
</script>
@endpush
