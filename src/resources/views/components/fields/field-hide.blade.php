<input type="hidden" class="form-control" name="{{ $field }}" id="{{ isset($id) ? $id : $field }}"  value="{{ old($field, isset($model) ? $model->$field : '') }}">
