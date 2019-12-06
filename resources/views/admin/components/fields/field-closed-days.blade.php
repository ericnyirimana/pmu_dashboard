<div class="form-group">

    <div class="row">

        <div class="col-12">
          @php $i = 1 @endphp
              <div class="row list_dates">

                  <div class="form-group box-days">
                          <input type="text" name="closings[{{ $i }}][name]" class="form-control" placeholder="Name" />
                    </div>

                  <div class="form-group box-days">
                      <div class="input-group">
                          <input type="text"  name="closings[{{ $i }}][date]" class="form-control datepicker" placeholder="mm/dd/yyyy" />
                          <div class="input-group-append">
                              <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                          </div>
                      </div><!-- input-group -->
                  </div>
                  <div class="form-group box-days">
                    <div class="checkbox checkbox-custom">
                          <input id="checkbox{{ $i }}" type="checkbox" name="closings[{{ $i }}][repeat]" checked="">
                          <label for="checkbox{{ $i }}">
                              Every year
                          </label>
                      </div>
                  </div>
                  <div class="form-group box-days">
                      <i class="fa fa-trash-o fa-2x close_date"></i> <label>Delete</label>
                  </div>

              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                  <button class="btn btn-success w-lg">+</button>
                </div>
                </div>
            </div>

        </div>
      </div>

</div>
@push('scripts')
<script>
$(document).ready(function(){

      jQuery('.timepicker').timepicker({
          defaultTIme: false,
          showMeridian: false,
          icons: {
              up: 'mdi mdi-chevron-up',
              down: 'mdi mdi-chevron-down'
          }
      });

      jQuery('.datepicker').datepicker({
          autoclose: true,
          todayHighlight: true
      });
});
</script>
@endpush
