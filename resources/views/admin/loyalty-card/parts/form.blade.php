<div class="row">
    <company-restaurant-select :model="$pickup" disabled/>
</div>


<div class="row">
    <div class="col-12 col-md-6">
        <field-date label="offer_duration" :model="$pickup" field="date" range="true"/>
    </div>
    @if($pickup->id)
    <div class="col-12 col-md-6">
        @if($pickup->is_not_editable)
            <field-checkbox-mealtype label="offer_disposable" field="timeslot_id" foreignid="timeslot_id" :model="$pickup_mealtype"
                            type="relation" :values="$pickup->restaurant->timeslots" />
        @else
            <field-checkbox-mealtype label="offer_disposable" field="timeslot_id" foreignid="timeslot_id" :model="$pickup_mealtype"
                            type="relation" :values="$pickup->restaurant->timeslots" />
        @endif
    </div>
    @endif
    @if(Route::currentRouteName() == 'loyalty-card.create')
    <div class="col-12 col-md-6">
        @if(Auth::user()->is_restaurant && Auth::user()->restaurant->first())
            <field-checkbox-mealtype label="offer_disposable" field="timeslot_id" foreignid="timeslot_id"
                            type="relation" :values="Auth::user()->restaurant->first()->timeslots" />
        @else
            <field-checkbox-mealtype label="offer_disposable" field="timeslot_id" foreignid="timeslot_id"
                            type="relation" :values="[]" />
        @endif
    </div>
    @endif
</div>
<div class="row">
    <h6 class="col-12 pb-3 pt-3">CONFIGURA LA TUA CARTA FEDELTA</h6>
    <div class="col-12 col-md-6">
        <field-select label="loyalty_card_type" field="product" foreignid="id" fieldname="product" type="relation"
                                :model="$loyaltyCardProduct->first()"
                                :values="$loyaltyCardProduct"/>
    </div>
    <div class="col-12 col-md-6">
        &nbsp;
    </div>
    <div class="col-12 col-md-6">
        <field-text-group label="loyalty_card_single_offer" field="price" :model="$pickup" maxlength="6" mask="#,##" maskreverse="true" prepend="€"
                            required/>
    </div>

    <div class="col-12 col-md-6 pt-4">
        <h5>({{ __('labels.price_example_loyalty_card') }})</h5>
    </div>
    <div class="col-12 col-md-6">
        <field-select label="loyalty_card_offer_consist" field="quantity_per_subscription" :model="$pickup" type="simple" :values="$loyalty_card_items"  required />
    </div>
    <div class="col-12 col-md-6">
        <field-select label="loyalty_card_discount" field="discount" :model="$pickup" type="simple" :values="$discount"  required />
    </div>
    <div class="col-12 col-md-6">
        <field-select label="loyalty_card_validity" field="validate_months" :model="$pickup" type="simple" :values="$validity"  required />
    </div>
    <div class="col-12 col-md-6">
        <field-select label="loyalty_card_availability" field="quantity_offer" :model="$pickup" type="simple" :values="$loyalty_card_availability"  required />
    </div>
    @if(Auth::user()->is_owner)
    <div class="col-12 col-md-6">
    @if($pickup->id)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="usable_company" id="usable_company"
                   value="1" @if($pickup->usable_company == 1) checked @endif/>
            <label class="form-check-label" for="enable_all_restaurants">
                {{ __('labels.enable_for_restaurant') }}
            </label>
        </div>
    @else
    <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="usable_company" id="usable_company"
                   value="1"/>
            <label class="form-check-label" for="enable_all_restaurants">
                {{ __('labels.enable_for_restaurant') }}
            </label>
        </div>
    @endif
    </div>
    @endif
    @if(!Auth::user()->is_owner && $pickup->id)
        <input type="hidden" name="usable_company" id="usable_company" value="{{ $pickup->usable_company }}"/>
    @endif
    <div class="col-12">
        <field-media-list label="image" field="media_id" :model="$pickup" required />
    </div>
    <div class="col-12">
    <p id="loyalty_card_cost" class="d-none">La tua Carta Fedeltà ha un valore di 
        <span class="total_price"></span> e sarà venduta a:  
        <span class="total_discount"></span>&nbsp;&nbsp;
        <span class="calculation"></span>
    </p>
    </div>
</div>
<div class="row mt-5">
    <div class="col-md-3 col-lg-6">
        <div class="form-group d-flex justify-content-between">
            <button type="button" class="btn btn-block w-lg btn-success float-right save-loyalty-card">
            {{ ucfirst(trans('button.save')) }}
            <i class="fa fa-circle-o-notch fa-spin" style="font-size:19px"></i>
            </button>
        </div>
    </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {

                appendProductNameOnPrice();

                @if($pickup->id)
                    $('#product').val('{{ $selected_product_id->loyalty_card_product_id }}');
                    appendProductNameOnPrice();
                    loadCardAmount();
                @endif

                $(document).on('change', '#restaurant_id', function () {

                    loadTimeslots($(this).val());

                });
                @if(Route::currentRouteName() == 'loyalty-card.create')
                    const selectedRestaurant = $('#restaurant_id').children("option:selected").val();
                    let loadCurrentTimeslot = selectedRestaurant !== '' ?  loadTimeslots($('#restaurant_id').val()) : '';
                    loadCurrentTimeslot;
                @endif

                $(document).on('change', '#price, #discount, #quantity_per_subscription', function () {

                    loadCardAmount();

                });

                $(document).on('keyup', '#price', function () {

                    loadCardAmount();

                });
                @if(Route::currentRouteName() == 'loyalty-card.create')
                    $("label[for='timeslot_id']").addClass('d-none');
                @endif
                $(document).on('change', '#product', function () {
                    appendProductNameOnPrice();
                });

                $('.fa-spin').hide();
                $(document).on('click', '.save-loyalty-card', function(e) {
                    e.preventDefault();
                    $('.save-loyalty-card .fa-spin').show();
                    $('.save-loyalty-card').attr('disabled', true);
                    var url = $('.submit-offert').attr('action');
                    var brand_id = $('#brand_id').val();
                    var restaurant_id = $('#restaurant_id').val();
                    var offer_date = $('#date').val();
                    var price = $('#price').val();
                    var quantity_per_subscription = $('#quantity_per_subscription').val();
                    var discount = $('#discount').val();
                    var validate_months = $('#validate_months').val();
                    var quantity_offer = $('#quantity_offer').val();
                    var product = $('#product').val();
                    var medias = [];
                    var timeslot_id = [];
                    @if(Auth::user()->is_owner)
                    var usable_company = $('input[name="usable_company"]:checked').val();
                    @else
                    var usable_company = $('#usable_company').val();
                    @endif
                    $('input[name="media[]"]').each(function(element){
                        medias.push($(this).val());
                    });

                    $('input[name="timeslot_id[]"]:checked').each(function(index, element){
                        timeslot_id.push($(this).val());
                    });
                    var check_media = $('#check_media').val();
                    @if($pickup->id)
                    var ajaxData = {
                        "_token": "{{ csrf_token() }}",
                        "product": product,
                        "brand_id": brand_id,
                        "restaurant_id": restaurant_id,
                        "date": offer_date,
                        "timeslot_id": timeslot_id,
                        "price": price,
                        "discount": discount,
                        "validate_months": validate_months,
                        "quantity_offer": quantity_offer,
                        "quantity_per_subscription": quantity_per_subscription,
                        "usable_company": usable_company,
                        "media": medias,
                        "check_media": check_media,
                        "pickup_id": '{{ $pickup->id }}',
                        "_method": 'put',
                    };
                    @else
                        var ajaxData = {
                            "_token": "{{ csrf_token() }}",
                            "product": product,
                            "brand_id": brand_id,
                            "restaurant_id": restaurant_id,
                            "date": offer_date,
                            "timeslot_id": timeslot_id,
                            "price": price,
                            "discount": discount,
                            "validate_months": validate_months,
                            "quantity_offer": quantity_offer,
                            "quantity_per_subscription": quantity_per_subscription,
                            "usable_company": usable_company,
                            "media": medias,
                            "check_media": check_media,
                        };
                    @endif
                    $.ajax({
                        type: 'POST',
                        url,
                        data: ajaxData,
                        success: function (data) {
                            $('.save-loyalty-card').attr('disabled', true);
                            $('.save-loyalty-card .fa-spin').show();
                            window.location.href= '{{ route("loyalty-card.index") }}';
                        },
                        error: function (reject) {
                            $('.save-loyalty-card').attr('disabled', false);
                            $('.save-loyalty-card .fa-spin').hide();
                            $('#error_response').empty();
                            var list_error = `<div class="d-flex">
                            <div class="col-12"><div class="alert alert-danger error_msg">
                            <ul></ul>
                            </div></div></div>`;
                            var errors = JSON.parse(reject.responseText).errors;
                            $('#error_response').append(list_error);
                            if(errors.product){
                                $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.product[0]}</li>`)
                            }
                            if(errors.price){
                                $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.price[0]}</li>`)
                            }
                            if(errors.discount){
                                $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.discount[0]}</li>`)
                            }
                            if(errors.quantity_per_subscription){
                                $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.quantity_per_subscription[0]}</li>`)
                            }
                            if(errors.media){
                                $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.media[0]}</li>`)
                            }
                            if(errors.validate_months){
                                $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.validate_months[0]}</li>`)
                            }
                            if(errors.quantity_offer){
                                $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.quantity_offer[0]}</li>`)
                            }
                            if(errors.brand_id){
                                $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.brand_id[0]}</li>`)
                            }
                            if(errors.restaurant_id){
                                $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.restaurant_id[0]}</li>`)
                            }
                            if(errors.date){
                                $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.date[0]}</li>`)
                            }
                            if(errors.timeslot_id){
                                $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.timeslot_id[0]}</li>`)
                            }
                            $('html, body').animate({scrollTop: '0px'}, 0);
                        }
                        });
                    });

            });

            function appendProductNameOnPrice(){
                if($('#product').val()){
                        var product = $('#product option:selected').text();
                        $("label[for='price']").empty();
                        $("label[for='quantity_per_subscription']").empty();
                        $("label[for='price']").append(`{{ __("labels.loyalty_card_single_offer") }} "${product}"`);
                        $("label[for='quantity_per_subscription']").append(`{{ __("labels.how_many") }} "${product}" {{__("labels.add_to_card") }} `);
                    }
                else{
                    $("label[for='price']").empty();
                    $("label[for='quantity_per_subscription']").empty();
                    $("label[for='price']").append(`{{ __("labels.loyalty_card_single_offer")}}`);
                    $("label[for='quantity_per_subscription']").append(`{{ __("labels.how_many") }} " " {{__("labels.add_to_card") }} `);
                }
            }

            function loadCardAmount(){
                var price = $('#price').val();
                var discount_percentage = parseInt($('#discount').val());
                var quantity_per_subscription = parseInt($('#quantity_per_subscription').val());
                if(price && discount_percentage && quantity_per_subscription){
                    var converted_amount = price;
                    if(price.includes(',')){
                        converted_amount = price.replace(/[,.]/g, function (x) { return x == "," ? "." : ","; });
                    }
                    var total_amount = converted_amount * quantity_per_subscription;
                    var discount = parseFloat((total_amount*discount_percentage)/100).toFixed(2);
                    var discount_amount = discount.toString().replace(/[,.]/g, function (x) { return x == "." ? "," : "."; });
                    var payable_amount = parseFloat(total_amount - discount).toFixed(2);
                    var amount_to_pay = payable_amount.toString().replace(/[,.]/g, function (x) { return x == "." ? "," : "."; });
                    $('#loyalty_card_cost').removeClass('d-none');
                    $(".total_price").text(`${total_amount}€`);
                    $(".total_discount").html(`<b>${amount_to_pay}€</b>`);
                    $(".calculation").html(`(${total_amount}€ - ${discount_percentage}%) = <b>${amount_to_pay}€</b>`);
                }
                else {
                    $('#loyalty_card_cost').removeClass('d-none');
                    $('#loyalty_card_cost').addClass('d-none');
                }
            }

            function loadTimeslots(id) {

                if (id) {

                    $.ajax({
                        url: "{{ route('restaurant.timeslots.data') }}/" + id,
                        type: 'GET',
                        success: function (data) {

                            $("#timeslot_id").html('');
                            $("label[for='timeslot_id']").removeClass('d-none');

                            $.each(data, function (i, timeslot) {
                                let allday = (timeslot.mealtype.all_day === null) ? "0" : "1";
                                $("#timeslot_id").append(`
                                <input class="form-check-input mealtypes checks-${allday}" type="checkbox" name="timeslot_id[]" 
                                id="timeslot_id_${timeslot.name}" value="${timeslot.mealtype_id}" all_day ="${allday}">
                                <label class="form-check-label" for="timeslot_id_${timeslot.name}"  style="margin-right: 20px;">
                                ${timeslot.name}
                                </label>`)
                            });
                        },
                        error: function (reject) {
                            $("#timeslot_id").html('');
                            $("label[for='timeslot_id']").addClass('d-none');
                        }
                    });

                } else {
                    $("#restaurant_id").html('<option value="">Select Company first</option>');
                    $("#timeslot_id").html('');
                    $("label[for='timeslot_id']").addClass('d-none');
                }

            }
        </script>
@endpush
