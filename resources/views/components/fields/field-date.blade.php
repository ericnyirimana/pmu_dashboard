<div class="form-group">
    <label for="{{ $field }}">{{ __('labels.'.$label) }}</label>
    <div class="input-group">
        <input type="text" class="form-control" name="{{ $field }}" id="{{ isset($id) ? $id : $field }}" aria-describedby="{{ $field }}Help" placeholder="insert {{ $label }} here" value="{{ old($field, isset($model) ? $model->$field : '') }}" @if(isset($required)) parsley-trigger="change" required @endif @if(isset($disabled) && ($model->id)) disabled @endif>
        <div class="input-group-append">
          <span class="input-group-text" id="{{ isset($id) ? $id : $field }}_date"><i class="mdi mdi-calendar"></i></span>
        </div>
      </div>


</div>
@push('scripts')
<script type="text/javascript">

$(document).ready(function(){

    $(document).on('click', '#{{ isset($id) ? $id : $field }}_date', function() {

        $('#{{ isset($id) ? $id : $field }}').click();
    });

    $('#{{ isset($id) ? $id : $field }}').daterangepicker({
        autoUpdateInput: false,
        minDate: '{{ date("d-m-Y") }}',
        @if(!isset($range)) singleDatePicker: true, @endif
        locale: {
          format: 'DD-MM-YYYY'
        }
      }, function(start, end, label) {
        $('#{{ isset($id) ? $id : $field }}').val(start.format('DD-MM-YYYY') + ' | ' + end.format('DD-MM-YYYY'));
      });

});

</script>
@endpush
