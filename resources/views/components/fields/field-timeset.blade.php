@php $openingDay = $model->list_opening_hours[$day] ?? ''; @endphp
<div class="row setTime set_{{ $day }} @if (isset($open)) keep_open  @endif">
      <div class="col-12">
        <div class="form-group">
            <input type="checkbox" data-name="{{ $day }}" class="closed_day" name="openings[{{ $day }}][closed]" @if( empty($openingDay) ) checked @endif data-plugin="switchery" data-color="#2b3d51" /><label for="closed_{{ $day }}"> Closed</label>
        </div>

      </div>

      <div class="box-time_{{ $day }} @if( empty($openingDay) ) hideHours @endif">
          <div class="col-12 timeTable table_{{ $day }}">


            @php
              #Create default values if is empty
              if ( empty($openingDay) ) {

                  isset($openingDay);

                  $openingDay = [['from'=> '10:00', 'to'=> '15:00']];

              }

            @endphp

            @foreach($openingDay as $i=>$opening)
              <div class="row time_{{ $day }} @if($i==0) first_item @endif">

                  <div class="form-group box-hours">
                        <div class="input-group">
                            <label for="from_{{ $day }}{{ $i }}">From: </label>
                            <input type="time" id="from_{{ $day }}{{ $i }}" name="openings[{{ $day }}][times][{{ $i }}][from]" class="form-control timepicker" value="{{ $opening['from'] }}" />
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="mdi mdi-clock"></i></span>
                            </div>
                        </div><!-- input-group -->
                    </div>

                  <div class="form-group box-hours">
                      <div class="input-group">
                          <label for="to_{{ $day }}{{ $i }}">To: </label>
                          <input type="time" id="to_{{ $day }}{{ $i }}" name="openings[{{ $day }}][times][{{ $i }}][to]" class="form-control timepicker" value="{{ $opening['to'] }}" />
                          <div class="input-group-append">
                              <span class="input-group-text"><i class="mdi mdi-clock"></i></span>
                          </div>
                      </div><!-- input-group -->
                  </div>

                <div class="box-hours">
                      <button type="button" class="remove_time btn btn-danger waves-effect w-sm" name="remove_{{ $day }}"> - </button>
                </div>
              </div>
              @endforeach

          </div>
          <div class="col-12">
                <button type="button" class="add_time button_{{ $day }} btn btn-info waves-effect w-sm " name="add_{{ $day }}"> + </button>
          </div>
      </div>

</div>
@push('scripts')
<script>
$(document).ready(function(){

    var total = $('.box-time_{{ $day }}').find('.time_{{ $day }}').length;

    if (total == 2) {
        $('.button_{{ $day }}').hide();
    }
});
</script>
@endpush
