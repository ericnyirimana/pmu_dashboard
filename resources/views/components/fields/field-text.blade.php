<div class="form-group">
    <label for="{{ $field }}">{{ $label }}</label>
    <input type="text" class="form-control @if(!empty($class)) {{ $class }} @endif" name="{{ $field }}" id="{{ isset($id) ? $id : $field }}" aria-describedby="{{ $field }}Help" placeholder="insert {{ $label }} here" value="{{ old($field, isset($model) ? $model->$field : '') }}" @if(isset($required)) parsley-trigger="change" required @endif @if(isset($disabled) && ($model->id)) disabled @endif>
    @if(isset($help))<small id="{{ $field }}Help" class="form-text text-muted">{{ $help }}</small>@endif
</div>
@push('scripts')
<script type="text/javascript">
@if(isset($mask))
$(document).ready(function(){

  $('#{{ isset($id) ? $id : $field }}').mask('{{ $mask }}', {
      @if(isset($maskreverse))
      reverse: true
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
