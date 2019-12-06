@if(!isset($group))<div class="form-group">@endif
@if ($type == 'simple')
      <button type="button" class="{{ $class }}" name="{{ $name }}">{{ $label }}</button>
@endif
@if(!isset($group))</div>@endif
