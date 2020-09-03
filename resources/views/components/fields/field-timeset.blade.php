@php $openingDay = $model->restaurantTimeslots->timeslots[$day] ?? ''; @endphp
<div class="row setTime col-12 set_{{ $day }} @if (isset($open)) keep_open  @endif">
@if(!empty($openingDay))
      <div class="col-12">
        <div class="form-group">
            <input type="checkbox" data-name="{{ $day }}" id="close_{{ $day }}" class="switches_{{ $day }} closed_weekly_{{ $day }}" name="openings[{{ $day }}][closed]" @if(
                isset($openingDay['closed']) ) checked @endif data-plugin="switchery" data-color="#2b3d51" /><label for="closed_{{
              $day }}"> {{ ucfirst(trans('labels.weekly_close')) }}</label>
        </div>
        <div class="form-group">
            <p><i><b>
            <i class="fa fa-warning" style="font-size:19px"></i> {{ __('messages.client_can_place_order_30_min_before') }}</b></i></p>
        </div>
      </div>    
@endif        
      <div class="box-time_{{ $day }} col-12 @if( empty($openingDay) ) hideHours @endif">
          <div class="col-12 timeTable table_{{ $day }}">


            
            @if(!empty($openingDay) &&  isset($openingDay)) 
            @if(empty($openingDay['mealtypes']))
            <input type="text" id="null_day_{{ $day }}" name="openings[{{ $day }}][mealtypes][]" value="" placeholder="" style="border: none;"
                            readonly hidden>
            @else
            @php
                $openingDay = (object) $openingDay;

            @endphp
            
            @foreach($openingDay->mealtypes as $i=>$opening)
              <div class="row time_{{ $day }} @if($i==0) first_item @endif">
                        <div class="form-group col-md-7 col-lg-7  box-hours">
                            <label for="timeslot_{{ $opening['name'] }}"> {{ $opening['name'] }}</label>
                            <input type="text" id="range_clock_{{ $day }}_{{ $i }}" name="range_clock_{{ $day }}_{{ $i }}"
                                placeholder="{{ $opening['hours']['hour_ini'] }} - {{ $opening['hours']['hour_end'] }}" style="border: none;" readonly>
                            <input type="text" id="id_{{ $day }}_{{ $i }}" name="openings[{{ $day }}][mealtypes][{{ $i }}][id]" value="{{ $opening['id'] }}" placeholder="" style="border: none;"
                                readonly hidden>
                            <input type="text" id="name_{{ $day }}_{{ $i }}" name="openings[{{ $day }}][mealtypes][{{ $i }}][name]" value="{{ $opening['name'] }}" placeholder="" style="border: none;"
                                readonly hidden>
                            <input type="text" id="hour_ini_{{ $day }}_{{ $i }}" name="openings[{{ $day }}][mealtypes][{{ $i }}][hours][hour_ini]" value="{{ $opening['hours']['hour_ini'] }}" placeholder="" style="border: none;"
                                readonly hidden>
                            <input type="text" id="hour_end_{{ $day }}_{{ $i }}" name="openings[{{ $day }}][mealtypes][{{ $i }}][hours][hour_end]" value="{{ $opening['hours']['hour_end'] }}" placeholder="" style="border: none;"
                                readonly hidden>
                            <input type="text" id="range_hour_ini_{{ $day }}_{{ $i }}" name="range_hour_ini_{{ $day }}_{{ $i }}" value="{{ $items->where('id', $opening['id'])->first()->hour_ini }}" placeholder="" style="border: none;"
                                readonly hidden>
                            <input type="text" id="range_hour_end_{{ $day }}_{{ $i }}" name="range_hour_end_{{ $day }}_{{ $i }}" value="{{ $items->where('id', $opening['id'])->first()->hour_end }}" placeholder="" style="border: none;"
                                readonly hidden>
                            <div id="slider-range_{{ $day }}_{{ $i }}"></div>
                 </div>

                <div class="form-group col-md-3 col-lg-3 box-hours" style="margin-top: 20px !important;">
                    <input type="checkbox" data-name="closed_mealtype_{{ $day }}_{{ $i }}" class="switches_{{ $day }} closed_daily_{{ $day }}" name="openings[{{ $day }}][mealtypes][{{ $i }}][closed]" @if(
                    isset($opening['closed']) ) checked @endif data-plugin="switchery" data-color="#2b3d51" /><label for="closed_{{ $day }}_{{ $i }}"> {{ ucfirst(trans('labels.closed')) }}</label>
                </div>
              </div>

              @endforeach
               
              @endif
              @endif
          </div>
      </div>

</div>
@push('scripts')
<script>
$(function () {
    var model = @json($openingDay);
    if(model){
    var mealtypes = model.mealtypes;
    for (let index = 0; index < mealtypes.length; index++) {
        var elem = mealtypes[index];
        if (elem) {
            var start = elem.hours.hour_ini ? convertTime(elem.hours.hour_ini) : 660;
            var end = elem.hours.hour_end ? convertTime(elem.hours.hour_end) : 900;
            var minTime = $("#range_hour_ini_{{ $day }}_"+index).val();
            var maxTime = $("#range_hour_end_{{ $day }}_"+index).val();
            $("#slider-range_{{ $day }}_"+index).slider({
                range: true,
                min: minTime ? convertTime(minTime) : 0,
                max: maxTime ? convertTime(maxTime) : 1440,
                values: [start, end],
                step: 30,
                slide: function (e, ui) {
                    formatTime(ui, index);
                }
            });
        
        }
    }
}

var animating = false;
var masteranimate = false;

$(function() {

    $('input.closed_weekly_{{ $day }}').change( function(e){
        masteranimate = true;
        if (!animating){
            var masterStatus = $(this).prop('checked');
            $('input.closed_daily_{{ $day }}').each(function(index){
                var switchStatus = $('input.closed_daily_{{ $day }}')[index].checked;
                if(switchStatus != masterStatus){
                        $(this).trigger('click');
                }
            });
        }
        masteranimate = false;
    });
    $('input.closed_daily_{{ $day }}').change(function(e){
        animating = true;
        if ( !masteranimate ){
            if( $('input.closed_weekly_{{ $day }}').prop('checked') ){
                $('input.closed_weekly_{{ $day }}').trigger('click');
            }
            var goinoff = true;
            $('input.closed_daily_{{ $day }}').each(function(index){
                if( $('input.closed_daily_{{ $day }}')[index].checked ){
                    goinoff = true;
                }
            });
            if(!goinoff){
                $('input.closed_weekly_{{ $day }}').trigger('click');
            }
            if ($('input.closed_daily_{{ $day }}:checked').length == $('input.closed_daily_{{ $day }}').length ){
            $('input.closed_weekly_{{ $day }}').trigger('click');
            }
        }
        animating = false;

    });

});


function formatTime(ui, index) {
    var hoursStart = Math.floor(ui.values[0] / 60);
    var minutesStart = ui.values[0] - (hoursStart * 60);
    var hoursEnd = Math.floor(ui.values[1] / 60);
    var minutesEnd = ui.values[1] - (hoursEnd * 60);

    if (hoursStart.toString().length == 1) hoursStart = '0' + hoursStart;
    if (minutesStart.toString().length == 1) minutesStart = '0' + minutesStart;
    if (hoursEnd.toString().length == 1) hoursEnd = '0' + hoursEnd;
    if (minutesEnd.toString().length == 1) minutesEnd = '0' + minutesEnd;

    $("#range_clock_{{ $day }}_"+index).val(hoursStart + ":" + minutesStart + " - " + hoursEnd + ":" + minutesEnd);

    $("#hour_ini_{{ $day }}_"+index).val(hoursStart + ":" + minutesStart);
    $("#hour_end_{{ $day }}_"+index).val(hoursEnd + ":" + minutesEnd);
}

function convertTime(dateString) {

    var timeArray = dateString.split(":");
    var minutes = (+timeArray[0]) * 60 + (+timeArray[1]);

    return minutes;

}

});
</script>
@endpush
