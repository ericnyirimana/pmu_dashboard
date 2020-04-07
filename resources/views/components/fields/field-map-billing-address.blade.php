<div class="form-group">
	<label for="{{ $field }}">{{ $label }}</label>
	<input  type="text" class="form-control" name="{{ $field }}" id="{{ $field }}" aria-describedby="{{ $field }}Help" placeholder="Inserisci {{ $label }} qui" value="{{ old($field, isset($model) ? $model->$field : '') }}" @if(isset($required)) parsley-trigger="change" required @endif>
	@if(isset($help))<small id="{{ $field }}Help" class="form-text text-muted">{{ $help }}</small>@endif
	<input type="hidden" id="billing_latitude" name="billing_latitude" value="{{ old('billing_latitude', isset($model) ? $model->billing_latitude : '') }}">
	<input type="hidden" id="billing_longitude" name="billing_longitude" value="{{ old('billing_longitude', isset($model) ? $model->billing_longitude : '') }}">
</div>
<!-- Modal -->
<div id="map-modal-billing-address" class="modal fade map-modal" tabindex="-1" role="dialog" aria-labelledby="mapModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mt-0">Scegli indirizzo</h5>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="input-group">
						<label for="{{ $field }}">{{ $label }}</label>
						<input id="searchMap{{ $field }}"  type="text" class="form-control save-location{{ $field }}"  placeholder="Inserisci {{ $label }} qui" value="{{ old($field, isset($model) ? $model->$field : '') }}">
						<span class="input-group-append">
                            <button type="button" id="search-map-billing-address" class="btn waves-effect waves-light btn-primary">Cerca</button>
                        </span>
					</div>
				</div>
				<div class="form-group">
					<div class="mapModal" id="map{{ $field }}"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal">Cancella</button> <button type="button" class="save-location{{ $field }} btn btn-success" data-dismiss="modal">Salva</button>
			</div>
		</div> <!-- /.modal-content -->
	</div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
@push('scripts')

	<script>
		var tmp_lat = {{ $model->billing_latitude ?? 0 }};
		var tmp_lng = {{ $model->billing_longitude ?? 0 }};
		var tmp_address = '{{ $model->location ?? '' }}';

		$(document).ready(function(){

			var location = {lat: tmp_lat, lng: tmp_lng };

			initMapBilling(location);

			initAutocompleteBilling();

			$(document).on('focus', '#{{ $field }}', function(){

				$('#map-modal-billing-address').modal();

			});

			$(document).on('click', '.save-location{{ $field }}', function(){

				$('.coordinates').val(tmp_lat + ', ' + tmp_lng);
				$('#{{ $field }}').val(tmp_address);

			});


		});


		var placeSearch, autocomplete;

		var componentForm = {
			route: 'long_name',
			street_number: 'short_name',
			locality: 'long_name'
		};

		function initAutocompleteBilling() {

			var defaultBounds = new google.maps.LatLngBounds(
					new google.maps.LatLng(-33.8902, 151.1759),
					new google.maps.LatLng(-33.8474, 151.2631));

			// Create the autocomplete object, restricting the search predictions to
			// geographical location types.
			autocomplete = new google.maps.places.Autocomplete(
					document.getElementById('searchMap{{ $field }}'));

			// Avoid paying for data that you don't need by restricting the set of
			// place fields that are returned to just the address components.
			autocomplete.setFields(['address_component', 'geometry']);

			// When the user selects an address from the drop-down, populate the
			// address fields in the form.
			autocomplete.addListener('place_changed', fillInAddressBilling);
		}

		function fillInAddressBilling() {
			// Get the place details from the autocomplete object.
			var place = autocomplete.getPlace();

			var lng = place.geometry.location.lng();
			var lat = place.geometry.location.lat();

			var location = {lat: lat, lng: lng};
			initMapBilling(location);


			var full_address = place.address_components[1].short_name + ', ' + place.address_components[0].short_name + ', ' + place.address_components[2].short_name + ' - ' + place.address_components[(place.address_components.length-1)].short_name;


			$('#billing_latitude').val(location.lat);
			$('#billing_longitude').val(location.lng);

			tmp_lat = lat;
			tmp_lng = lng;
			tmp_address = full_address;

		}

		// Initialize and add the map
		function initMapBilling(location) {

			// The map, centered at Uluru
			var map = new google.maps.Map(
					document.getElementById('map{{ $field }}'), {zoom: 16, center: location});
			// The marker, positioned at Uluru
			var marker = new google.maps.Marker({position: location, map: map});

		}
	</script>
@endpush
