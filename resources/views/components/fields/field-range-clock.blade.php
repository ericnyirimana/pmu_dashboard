<div class="form-group">
    <label for="{{ $field }}">{{ $label }}</label>
    <input type="text" name="{{ $field }}" id="{{ $field }}" placeholder="Inserisci {{ $label }} qui" style="border: none;" readonly>

    <div id="slider-range"></div>
</div>

@push('scripts')

    <script>
			$( function() {
				$( "#slider-range" ).slider({
					range: true,
					min: 0,
					max: 24,
					values: [ 11, 15 ],
					slide: function( event, ui ) {
						$( "#{{ $field }}" ).val( ui.values[ 0 ] + ":00" + " - " + ui.values[ 1 ] + ":00" );
					}
				});
				$( "#{{ $field }}" ).val( $( "#slider-range" ).slider( "values", 0 ) + ":00" + " - " +
                    $( "#slider-range" ).slider( "values", 1 ) + ":00");
			} );
    </script>
@endpush
