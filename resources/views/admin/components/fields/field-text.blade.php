<div class="form-group">
    <label for="{{ $field }}">{{ $label }}</label>
    <input type="text" class="form-control" name="{{ $field }}" id="{{ isset($id) ? $id : $field }}" aria-describedby="{{ $field }}Help" placeholder="insert {{ $label }} here" value="{{ old($field, isset($model) ? $model->$field : '') }}" @if(isset($required)) parsley-trigger="change" required @endif  @if(isset($disabled) && ($model)) disabled @endif>
    @if(isset($help))<small id="{{ $field }}Help" class="form-text text-muted">{{ $help }}</small>@endif
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
