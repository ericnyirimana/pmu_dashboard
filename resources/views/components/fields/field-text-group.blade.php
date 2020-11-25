<div class="form-group">
  <label for="{{ $field }}">{{ __('labels.'.$label) }}</label>
  <div class="input-group mb-3">
      @if( isset($prepend) )
      <div class="input-group-prepend">
          <span class="input-group-text">{{ $prepend }}</span>
      </div>
      @endif
      <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control" aria-label="{{ $label }}" @if(isset($maxlength)) maxlength="{{ $maxlength }}" @endif value="{{ old($field, isset($model) ? $model->$field : '') }}" @if(isset($required)) parsley-trigger="change" required @endif @if(isset($disabled)) disabled @endif>
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

  $('#{{ $field }}').mask('{{ $mask }}', {
      @if(isset($maskreverse))
      reverse: true,
      @endif
      @if(isset($maskpattern))
      'translation': {
        {{ $maskpattern }}
      }
      @endif
  });

});
@endif
</script>
@endpush
