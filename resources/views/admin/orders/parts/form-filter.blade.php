<div class="row">

    <div class="col-12 col-md-3 js-brand">
            <field-select label="company" field="brand_id" foreignid="id" fieldname="brand_id" type="relation"
            />
    </div>
    <div class="col-12 col-md-3 js-restaurant">
            <field-select label="restaurant" field="restaurant_id" fieldname="restaurant_id" foreignid="id"
                          type="relation"
                          disabled
            />
    </div>
    <field-date label="from_to" field="date" range="true" minDate="none"/>
    <div class="col-12 col-md-2">
        <div class="form-group">
        <label>&nbsp;</label>
            <button type="submit"
                    class="btn btn-md w-lg btn-success float-right form-control js-button-save"><i class="fi-search"> Filter</i></button>
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
            loadCompany();
            $(document).on('change', '#brand_id', function () {
                $('#brand_id').parsley().removeError('company_owner');
                loadRestaurants($(this).val());
            });

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
                        if ($('#role').val() === 'OWNER') {
                            $('.js-button-save').prop('disabled', true);
                            $.ajax({
                                url: "{{ route('company.data') }}/" + id,
                                type: 'GET',
                                success: function (data) {
                                    if (data.owner_id != null) {
                                        $('.js-button-save').prop('disabled', true);
                                        $('#brand_id').parsley().addError('company_owner', {
                                            'message': 'Company ' + data
                                                .name + ' already has an owner'
                                        });
                                    } else {
                                        $('.js-button-save').prop('disabled', false);
                                    }

                                }
                            });
                        }
                    }
                });
            } else {
                restaurantElem.html('<option value="">Select Restaurant</option>');
            }
        }
    </script>
@endpush
