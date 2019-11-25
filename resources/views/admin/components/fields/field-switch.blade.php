<div class="form-group">
    <input type="checkbox" name="{{ $field }}" id="{{ $field }}" @if($model->$field) checked @endif data-plugin="switchery" data-color="{{ ($color) ?? '#2b3d51'}}"/><label for="{{ $field }}"> {{ $label }}
</div>
@push('styles')
  <link rel="stylesheet" href="{{ asset("/plugins/switchery/switchery.min.css") }}">
@endpush
@push('scripts')
  <!-- Switchery -->
  <script src="{{ asset("/plugins/switchery/switchery.min.js") }}"></script>
@endpush
