<div class="form-group h-100">
      <label for="{{ $field }}">{{ $label }}</label>

      <textarea class="form-control" name="{{ $field }}" id="{{ isset($id) ? $id : $field }}" aria-describedby="{{ $field }}Help" @if(isset($required)) parsley-trigger="change" required @endif>{{ old($field, isset($model) ? $model->$field : '') }}</textarea>
</div>
