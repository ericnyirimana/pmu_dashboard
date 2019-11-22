<div class="form-group">
    <label for="{{ $field }}">{{ $label }}</label>
    <input type="text" class="form-control" name="{{ $field }}" id="{{ $field }}" aria-describedby="{{ $field }}Help" placeholder="insert {{ $label }} here" value="{{ old($field, isset($model) ? $model->$field : '') }}" @if(isset($required)) parsley-trigger="change" required @endif>
    @if(isset($help))<small id="{{ $field }}Help" class="form-text text-muted">{{ $help }}</small>@endif
</div>
