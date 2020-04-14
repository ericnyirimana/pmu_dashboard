<div class="form-group">
    <label for="{{ $field }}">{{ $label }}</label>
    <input type="text" name="{{ $field }}" id="{{ $field }}" placeholder="11:00 - 15:00" style="border: none;" readonly>

    <div id="slider-range"></div>
</div>

@push('scripts')

    <script>
			$( function() {
				$( "#slider-range" ).slider({
					range: true,
					min: 0,
					max: 1440,
					values: [ 660, 900 ],
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
                    if (hoursEnd.toString().length == 1) hoursEnd = '0' + hoursEnd;
                    if (minutesEnd.toString().length == 1) minutesEnd = '0' + minutesEnd;

                    $("#{{ $field }}").val(hoursStart+":"+minutesStart+ " - " +hoursEnd+":"+minutesEnd);
                }
			} );
    </script>
@endpush
