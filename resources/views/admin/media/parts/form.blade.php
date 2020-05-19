<div class="d-flex flex-row row">
    <div class="col-12 mb-3">
        <a href="{{ route('media.index') }}" class="btn btn-md w-lg btn-secondary float-left">{{ ucfirst(trans('button.back')) }}</a>
    </div>
    <div class="col-md-12 col-lg-6">

        <field-image label="File" field="file" :model="$media" required="new" />

    </div>
    <div class="col-md-12 col-lg-6 d-flex flex-column">

          <field-text label="name" field="name" :model="$media" required />

            <div class="form-group">
                <label for="">{{ __('labels.company') }}</label>
                <select id="brand_id" class="form-control" name="brand_id">
                    @if(Auth::user()->is_super)
                        <option value="_all">{{ __('labels.all_company') }}</option>
                    @endif
                    @if($brands)
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" @if($media->company == $brand) selected @endif>{{ $brand->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="">{{ __('labels.restaurant') }}</label>
                <select id="restaurant_id" class="form-control" name="restaurant_id">
                </select>
            </div>

          <div class="form-group mt-auto">

              @if (isset($media))
              <button type="button" class="btn btn-md w-lg btn-danger rm-register" data-name="{{ $media->name }}" data-register="{{ $media->id }}"  data-toggle="modal" data-target=".remove-register">Remove permanently</button>
              @endif

              @if(Auth::user()->is_super)
                  @if($media->status_media == 'PENDING')
                  <button type="submit" field="status_media" name="status_media" value="APPROVED" class="btn btn-md w-lg btn-primary float-right">{{ ucfirst(trans('button.approves')) }}</button>
                  <button type="submit" field="status_media" name="status_media" value="PENDING" class="btn btn-md w-lg btn-success float-right mr-3">{{ ucfirst(trans('button.save')) }}</button>
                  @elseif($media->status_media == 'APPROVED')
                  <button type="submit" field="status_media" name="status_media" value="APPROVED" class="btn btn-md w-lg btn-success float-right">{{ ucfirst(trans('button.save')) }}</button>
                  @endif
              @endif

              @if(Auth::user()->is_owner || Auth::user()->is_restaurateur)
                 @if($media->status_media == 'APPROVED')
                 <button type="submit" field="status_media" name="status_media" value="APPROVED" class="btn btn-md w-lg btn-success float-right">{{ ucfirst(trans('button.save')) }}</button>
                 @else
                 <button type="submit" field="status_media" name="status_media" value="PENDING" class="btn btn-md w-lg btn-success float-right">{{ ucfirst(trans('button.save')) }}</button>
                 @endif
              @endif

          </div>

    </div>
</div>


@push('styles')
    <!-- Jquery filer css -->
    <link href="{{ asset("/plugins/js-uploader-master/dist/css/jquery.dm-uploader.min.css")}}" rel="stylesheet"/>
@endpush
@push('scripts')
    <!-- Bootstrap fileupload js -->
    <script type="text/javascript"
            src="{{ asset("/plugins/js-uploader-master/dist/js/jquery.dm-uploader.min.js")}}"></script>
    <script>

			$(document).ready(function () {

              initSelectValue();

				$(document).on('change', '#brand_id', function () {
                  selectMediaByCompany();
				});

				$(document).on('change', '#restaurant_id', function () {
                  selectMediaByRestaurant();
				});

			});

			function initSelectValue() {
              if ($('#brand_id').val() != '_all') {
                loadRestaurants($('#brand_id').val());
              }

              @if(Auth::user()->is_restaurant)
                        $('#restaurant_id').append('<option value="{{ Auth::user()->restaurant->first()->id }}">{{
                    Auth::user()->restaurant->first()->name }}</option>');
              @endif
			}

			function selectMediaByCompany() {
				if ($('#brand_id').val() != '_all') {
					loadRestaurants($('#brand_id').val());
				}
			}

			function selectMediaByRestaurant() {
				if ($('#restaurant_id').val() != '_all') {
				} else {
					selectMediaByCompany();
				}
			}

			function loadRestaurants(id) {
				var restaurantElem = $("#restaurant_id");
				if (id) {
					$.ajax({
						url: "{{ route('company.restaurants.data') }}/" + id,
						type: 'GET',
						success: function (data) {

							restaurantElem.html('<option value="_all">{{ __("labels.all_restaurants") }}</option>');

							$.each(data, function (i, restaurant) {

								var selected = '';
                                if(restaurant.id == '{{ $media->restaurant_id }}') {
                                	selected = 'selected';
                                }
								restaurantElem.append('<option value="' + restaurant.id + '" '+ selected +'>' + restaurant.name + '</option>')
							});
						}
					});
				}
			}


    </script>
@endpush
