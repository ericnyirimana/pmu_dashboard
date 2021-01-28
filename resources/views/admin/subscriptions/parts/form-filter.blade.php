<div class="row">
@if((Auth::user()->is_owner || Auth::user()->is_restaurant))
    <company-restaurant-select :model="$subscriptions" disabled/>
@else
    <div class="col-12 col-md-6 js-brand">
        @if(isset($brand) || !empty($brand))
            <field-select label="company" field="brand_id" foreignid="id" fieldname="brand_id" type="relation"
                                :model="$brand->first()"
                                :values="$brand"
                    />
        @else
            <field-select label="company" field="brand_id" foreignid="id" fieldname="brand_id" type="relation"
            />
        @endif
    </div>
    <div class="col-12 col-md-6 js-restaurant">
            @if(isset($restaurant) || !empty($restaurant))
            <field-select label="restaurant" field="restaurant_id" fieldname="restaurant_id" foreignid="id"
                          type="relation"
                          :model="$restaurant->first()"
                          :values="$restaurant"
            />
            @else
            <field-select label="restaurant" field="restaurant_id" fieldname="restaurant_id" foreignid="id"
                          type="relation"
                          disabled
            />
            @endif
    </div>
    @endif
    <div class="col-12 col-md-2">
        <div class="form-group">
        <label>&nbsp;</label>
        <a href="{{ route('subscriptions.index') }}"
                    class="btn btn-md w-lg btn-info float-right form-control js-button-clear-filter">Clear Filter</i></a>
        </div>

    </div>
    <div class="col-12 col-md-2">
        <div class="form-group">
        <label>&nbsp;</label>
            <button type="click"
                    class="btn btn-md w-lg btn-success float-right form-control js-button-filter"><i class="fi-search"></i> Filter</button>
        </div>

    </div>
</div>
@push('scripts')
    <!-- Bootstrap fileupload js -->
    <script type="text/javascript" src="{{ asset("/plugins/bootstrap-fileupload/bootstrap-fileupload.js")}}"></script>

    <!-- Parsley js -->
    <script type="text/javascript" src="{{ asset("/plugins/parsleyjs/parsley.min.js")}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            @if(!isset($brand) && (Auth::user()->is_super))
            loadCompany();
            $(document).on('change', '#brand_id', function () {
                loadRestaurants($(this).val());
            });
            @endif
        });

        function loadCompany() {
            var companyElem = $("#brand_id");
                $.ajax({
                    url: "{{ route('company.data') }}",
                    type: 'GET',
                    success: function (data) {

                        companyElem.html('<option value="">Select Company</option>');

                        $.each(data, function (i, company) {

                            companyElem.append('<option value="' + company.id + '">' + company.name + '</option>')
                        });
                    }
                });
        }

        function loadRestaurants(id) {
            $("#restaurant_id").attr('disabled', false);
            var restaurantElem = $("#restaurant_id");
            if (id) {
                $.ajax({
                    url: "{{ route('company.restaurants.data') }}/" + id,
                    type: 'GET',
                    success: function (data) {

                        restaurantElem.html('<option value="">Select Restaurant</option>');

                        $.each(data, function (i, restaurant) {

                            restaurantElem.append('<option value="' + restaurant.id + '">' + restaurant.name + '</option>')
                        });
                    }
                });
            } else {
                restaurantElem.html('<option value="">Select Restaurant</option>');
            }
        }
    </script>
@endpush
