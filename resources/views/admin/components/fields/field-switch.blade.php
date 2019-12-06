<div class="form-group">
    <input type="checkbox" name="{{ $field }}" id="{{ $field }}" @if($model->$field) checked @endif data-plugin="switchery" data-color="{{ ($color) ?? '#2b3d51'}}"/><label for="{{ $field }}"> {{ $label }}
</div>
