<div class="form-group">
    <label for="{{ $field }}">{{ $label }}</label>
    <input type="text" name="{{ $field }}" id="{{ $field }}" placeholder="11:00 - 15:00" style="border: none;" readonly>

    <div id="slider-range"></div>
</div>

@push('scripts')

    <script>
			$( function() {
                var model = @json($model);
                var start = model.hour_ini != '00:00:00' ? model.hour_ini : 660;
                var end = model.hour_end != '00:00:00' ? model.hour_end : 900;
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
                    var hoursStart = Math.floor(ui.values[start] / 60);
                    var minutesStart = ui.values[start] - (hoursStart * 60);
                    var hoursEnd = Math.floor(ui.values[end] / 60);
                    var minutesEnd = ui.values[end] - (hoursEnd * 60);

                    if(hoursStart.toString().length == 1) hoursStart = '0' + hoursStart;
                    if(minutesStart.toString().length == 1) minutesStart = '0' + minutesStart;
                    if (hoursEnd.toString().length == 1) hoursEnd = '0' + hoursEnd;
                    if (minutesEnd.toString().length == 1) minutesEnd = '0' + minutesEnd;

                    $("#{{ $field }}").val(hoursStart+":"+minutesStart+ " - " +hoursEnd+":"+minutesEnd);
                }
			} );
    </script>
@endpush
