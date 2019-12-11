<div class="form-group">

    <div class="row">

        <div class="col-12">

              <div class="list_dates">
                  <div class="row date_box first_item" data-seq="1">

                      <div class="form-group box-days">
                              <input type="text" name="closings[0][name]" class="closing_name form-control" placeholder="Name" />
                        </div>

                      <div class="form-group box-days">
                          <div class="input-group">
                              <input type="text"  name="closings[0][date]" class="closing_date form-control datepicker" placeholder="dd-mm-yyyy" />
                              <div class="input-group-append">
                                  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                              </div>
                          </div><!-- input-group -->
                      </div>
                      <div class="form-group box-days">
                        <div class="checkbox checkbox-custom">
                              <input id="checkbox" type="checkbox" name="closings[0][repeat]" checked="" class="closing_repeat">
                              <label for="checkbox">
                                  Every year
                              </label>
                          </div>
                      </div>
                      <div class="form-group box-days remove_date">
                          <i class="fa fa-trash-o fa-2x"></i> <label>Delete</label>
                      </div>

                  </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                  <button type="button" class="btn btn-success w-lg add_date">+</button>
                </div>
                </div>
            </div>

        </div>
      </div>

</div>
@push('scripts')
<script>
$(document).ready(function(){


      jQuery('.datepicker').datepicker({
          format: 'dd-mm-yyyy',
          autoclose: true,
          todayHighlight: true
      });
});
</script>
@endpush
