<div class="row">
    <div class="col-12 col-md-6">
        @if(Auth::user()->is_manager)
            <field-text label="name" field="name" :model="$user" required disabled="true"/>
        @else
            <field-text label="name" field="name" :model="$user" required/>
        @endif
    </div>
    <div class="col-12 col-md-6">
        @if(Auth::user()->is_manager)
            <field-text label="email" field="email" :model="$user" required disabled="true"/>
        @else
            <field-text label="email" field="email" :model="$user" required />
        @endif
    </div>
    <div class="col-12 col-md-6">
        @if(Auth::user()->is_manager && Auth::user()->is_owner && empty($edit))
            <field-select label="role" field="role" foreignid="role" type="simple" :model="$user"
                          :values="config('cognito.ownerRolesToAdd')"
                          required readonly/>
        @elseif(Auth::user()->is_manager && Auth::user()->is_restaurant && empty($edit))
            <?php list('SALES_ASSISTANT' => $salesAssistant) = config('cognito.ownerRolesToAdd');
            ?>
            <field-custom-text label="role" field="role" :value="$salesAssistant" required readonly/>
        @elseif((Auth::user()->is_manager || Auth::user()->is_restaurant || Auth::user()->is_owner) && isset($edit))
            <field-custom-text label="role" field="role" :value="$user->role" required readonly/>
        @else
            <field-select label="role" field="role" foreignid="role" type="simple" :model="$user"
                          :values="config('cognito.roles')"
                          required />
        @endif

    </div>
    @if(Auth::user()->is_restaurant && isset($edit))
    @php $user=Auth::user(); @endphp
    @endif
    <div class="col-12 col-md-6 js-brand">
        @if(Auth::user()->is_manager)
            <field-select label="company" field="brand_id" foreignid="id" fieldname="brand_id" type="relation"
                          :model="$user->brand->first()"
                          :values="$user->brand"
                          readonly
            />
        @else
            <field-select label="company" field="brand_id" foreignid="id" fieldname="brand_id" type="relation"
                          :model="$user->brand->first()"
                          :values="$user->brand"
            />
        @endif
    </div>
    <div class="col-12 col-md-6 js-restaurant">
        @if(Auth::user()->is_manager)
            <field-select label="restaurant" field="restaurant_id" fieldname="restaurant_id" foreignid="id"
                          type="relation"
                          :model="$user->restaurant->first()"
                          :values="$user->restaurant"
                          readonly
            />
        @else
            <field-select label="restaurant" field="restaurant_id" fieldname="restaurant_id" foreignid="id"
                          type="relation"
                          :model="$user->restaurant->first()"
                          :values="$user->restaurant"
            />
        @endif
    </div>
    <div class="col-12 col-md-8">
        {{--<field-image label="Immagine profilo" field="profile_image" :model="$user" />--}}
    </div>
    <!--
    <div class="col-12 col-md-6 row d-flex align-items-center">
        <div class="col-8">
            <field-text label="password" field="password" {{--:model="$user"--}} />
        </div>
        <div class="col-4">
            <button type="button"
                    class="btn btn-md w-lg btn-success float-right">{{ ucfirst(trans('button.generate_pwd')) }}</button>
        </div>
    </div>
    -->
    {{--<div class="col-12">--}}
    {{--<field-checkbox-permissions label="Permessi" field="" :model="$user" :items="" />--}}
    {{--</div>--}}
    <div class="col-12">
        <div class="form-group mt-auto">

            <a href="{{ route('users.index') }}"
               class="btn btn-md w-lg btn-secondary float-left">{{ ucfirst(trans('button.back')) }}</a>
            @if(!empty($edit) && (Auth::user()->is_manager || Auth::user()->is_owner || Auth::user()->is_restaurant))
            <button type="submit"
                    class="btn btn-md w-lg btn-success float-right js-button-save" disabled=true>{{ ucfirst(trans('button.save'))
                    }}</button>
            @else
            <button type="submit"
                    class="btn btn-md w-lg btn-success float-right js-button-save">{{ ucfirst(trans('button.save'))
                    }}</button>
            @endif
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

            $('form').parsley();
            //init Drop down
            @if(!Auth::user()->is_manager && !isset($edit))
            disableDropDown();

            if ($('#role').val() === 'OWNER' ||
                $('#role').val() === 'RESTAURATEUR' ||
                $('#role').val() === 'SALES_ASSISTANT') {
                $('.js-brand').show();
                $('#brand_id').prop('readonly', false);
                loadCompany($('#role').val());
            }

            if ($('#role').val() === 'RESTAURATEUR' || $('#role').val() === 'SALES_ASSISTANT') {
                $('.js-restaurant').show();
                $('#restaurant_id').prop('readonly', false);
            }

            @endif
            if ($('#role').val() === 'OWNER') {
                $('.js-restaurant').hide();
                $('#restaurant_id').prop('readonly', true);
            }
            console.log($('#role').val());
            $(document).on('change', '#role', function () {
                if ($(this).val() === 'OWNER' ||
                    $(this).val() === 'RESTAURATEUR' ||
                    $(this).val() === 'SALES_ASSISTANT') {
                    $('.js-brand').show();
                    $('#brand_id').prop('readonly', false);
                    $('.js-restaurant').hide();
                    $('#restaurant_id').prop('readonly', true);
                    loadCompany($('#role').val());
                } else {
                    disableDropDown();
                }

            });

            $(document).on('change', '#brand_id', function () {
                $('#brand_id').parsley().removeError('company_owner');
                if ($('#role').val() === 'RESTAURATEUR' || $('#role').val() === 'SALES_ASSISTANT') {
                    $('.js-restaurant').show();
                    $('#restaurant_id').prop('readonly', false);
                }
                loadRestaurants($(this).val());

            });

        });

        function disableDropDown() {
            $('.js-brand').hide();
            $('#brand_id').prop('readonly', true);
            $('.js-restaurant').hide();
            $('#restaurant_id').prop('readonly', true);
        }

        function loadCompany(id) {
            var companyElem = $("#brand_id");
            if (id === 'OWNER' || id === 'RESTAURATEUR' || id === 'SALES_ASSISTANT') {
                @if(Auth::user()->is_manager || Auth::user()->is_owner || Auth::user()->is_restaurant)
                $.ajax({
                    success: function () {
                        companyElem.html('<option value="">Select Company</option>');
                        companyElem.append('<option value="{{Auth::user()->brand[0]->id}}">{{Auth::user()->brand[0]->name}}</option>');
                    }
                });
                @else
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
                @endif
            } else {
                companyElem.html('<option value="">Select Company</option>');
            }
        }

        function loadRestaurants(id) {
            var restaurantElem = $("#restaurant_id");
            if (id) {
                @if(Auth::user()->is_restaurant)
                $.ajax({
                    success: function () {
                        restaurantElem.html('<option value="">Select Restaurant</option>');
                        restaurantElem.append('<option value="{{Auth::user()->restaurant[0]->id}}">{{Auth::user()->restaurant[0]->name}}</option>');
                    }
                });
                @else
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
                @endif
            } else {
                restaurantElem.html('<option value="">Select Restaurant</option>');
            }
        }
    </script>
@endpush
