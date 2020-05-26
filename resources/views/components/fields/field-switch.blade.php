<div class="form-group">
    <input type="checkbox" name="{{ $field }}" id="{{ $field }}" @if(isset($model->$field) && $model->$field) checked
           @endif data-plugin="switchery" data-color="{{ ($color) ?? '#2b3d51'}}" @if(isset($disabled)) disabled @endif
    /><label
        for="{{ $field
           }}">{{
           $label }}</label>
</div>
