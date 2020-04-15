<div class="form-group">
    <label for="{{ $field }}">{{ $label }}</label>
    <input type="text" id="{{ $field }}" name="{{ $field }}" placeholder="11:00 - 15:00" style="border: none;" readonly>
    <input type="text" id="hour_ini" name="hour_ini" value="{{ $model->hour_ini }}" placeholder="" style="border: none;" readonly hidden>
    <input type="text" id="hour_end" name="hour_end" value="{{ $model->hour_end }}" placeholder="" style="border: none;" readonly hidden>

    <div id="slider-range"></div>
</div>

@push('scripts')

    <script>
			$( function() {
                var model = @json($model);
                var start = model.hour_ini != '00:00:00' ? convertTime(model.hour_ini) : 660;
                var end = model.hour_end != '00:00:00' ? convertTime(model.hour_end) : 900;
				$( "#slider-range" ).slider({
					range: true,
					min: 0,
					max: 1440,
					values: [ start, end ],
                    step: 30,
                    slide: function(e, ui) {
                        formatTime(ui);
                    }
				});
				function formatTime(ui) {
                    var hoursStart = Math.floor(ui.values[0] / 60);
                    var minutesStart = ui.values[0] - (hoursStart * 60);
                    var hoursEnd = Math.floor(ui.values[1] / 60);
                    var minutesEnd = ui.values[1] - (hoursEnd * 60);

                    if(hoursStart.toString().length == 1) hoursStart = '0' + hoursStart;
                    if(minutesStart.toString().length == 1) minutesStart = '0' + minutesStart;
                    if(hoursEnd.toString().length == 1) hoursEnd = '0' + hoursEnd;
                    if(minutesEnd.toString().length == 1) minutesEnd = '0' + minutesEnd;

                    $("#{{ $field }}").val(hoursStart+":"+minutesStart+ " - " +hoursEnd+":"+minutesEnd);

                    $("#hour_ini").val(hoursStart+":"+minutesStart);
                    $("#hour_end").val(hoursEnd+":"+minutesEnd);
                }

              function convertTime(dateString) {

                var timeArray = dateString.split(":");
                var minutes = (+timeArray[0]) * 60 + (+timeArray[1]);

                return minutes;

              }

			} );
    </script>
@endpush
