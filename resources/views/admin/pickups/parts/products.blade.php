<div class="row">
    <div class="col-12">
        <h5>BUILD YOUR OFFER</h5>
    </div>
</div>

<div class="row clearfix">
    <field-hide :model="$pickup" field="type_offer"/>
    <div class="col-6">
        <span
            class="text-center btn @if(empty($pickup->type_offer) || $pickup->type_offer == 'single') btn-primary @else btn-secondary @endif btn-block text-uppercase btn-type_offer type-single">Single</span>
    </div>
    <div class="col-6 text-center">
        <span
            class="text-center btn @if($pickup->type_offer == 'combo') btn-primary @else btn-secondary @endif btn-block text-uppercase btn-type_offer type-combo">Combo</span>
    </div>
</div>
<div class="row mt-4">
    <div class="col-4">
        <div class="card-box bg-light">
            <div class="visible-always-scroll" style="max-height: 800px;">
                <h4 class="text-dark header-title m-t-0 m-b-30">Menu</h4>
                @if(isset($menu))
               <ul class="list-menu">
                    @foreach(['Dish','Drink'] as $type)
                        @php $class = 'sections'.$type; @endphp
                        <li><h5>{{ $type }}</h5>
                            @if(isset($menu->{$class}))
                            <ul>
                                @foreach($menu->{$class} as $section)
                                    <li data-name="{{ $section->name }}" data-clean-name="{{ preg_replace('/[^A-Za-z0-9]/', '', $section->name) }}"><h6 @if(empty
                              ($pickup->sections) ||
                              !in_array($section->name, array_keys($pickup->sections))) class="add-all" @endif>{{ $section->name }}</h6>
                                        <ul>
                                            @foreach($section->products as $product)
                                                @if($product->is_approved)
                                                <li @if(!in_array($product->id, $pickup->products->pluck('id')->toArray() ) )
                                                    class="add" @endif data-id="{{ $product->id }}"
                                                    data-name="{{ $product->name }}"
                                                    data-clean-name="{{ preg_replace('/[^A-Za-z0-9]/', '', $product->name) }}"
                                                    data-section="{{ $section->name }}">
                                                    {{ $product->name }}
                                                </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach

                            </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-8">
        <div class="card-box">
            <div class="visible-always-scroll list-section">
                @if($pickup->sections)
                    @php $lastKey = array_key_last($pickup->sections); @endphp
                    @foreach($pickup->sections as $name=>$section)
                        <div class="card " id="{{ $name }}">
                            <div class="card-header">
                                <h6 class="float-left">{{ $name }}</h6>
                                <i class="fi-trash float-right font-18 remove-section"></i>
                            </div>
                            <div class="card-body">
                                <p class="card-title text-right">Disponibilità
                                    <small>(x giorno)</small>
                                </p>

                                <ul class="list-group list-group-flush group-products">
                                    @if($section)
                                        @foreach($section as $product)
                                            <li class="list-group-item" data-id="{{ $product->id }}">
                                                <i class="fa fa-minus-square remove"></i>
                                                <div class="name">{{ $product->name }}</div>
                                                <div class="quantity"><input type="text" name="quantity[]"
                                                                             value="{{ $product->pivot->quantity_offer }}"
                                                                             maxlength="3"/></div>
                                                <input type="hidden" name="products[]" value="{{ $product->id }}"/>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                        @if($name != $lastKey)
                            <div class="text-center mt-4 mb-4"><i class="fi-plus"></i></div>
                        @endif

                    @endforeach
                @endif
            </div>
        </div>
    </div><!-- end col -->
</div>


@push('styles')
    <style>


        .list-menu ul ul li, .list-menu ul li, .remove-section {
            cursor: pointer;
            padding: 5px;
            list-style: none;
            color: #AAAAAA;
        }


        .list-menu ul ul li.add {
            color: #555555;
        }

        .list-menu ul ul li.add:before, .list-menu ul li h6.add-all::before {
            content: "\f0fe"; /* FontAwesome Unicode*/
            font-family: FontAwesome;
            display: inline-block;
            margin-left: -1.3em; /* same as padding-left set on li */
            width: 1.3em; /* same as padding-left set on li */

        }


        .group-products input {
            text-align: right;
            padding: 3px 10px;
            width: 50px;
            border-radius: 5px;
            border: 1px solid #CCCCCC;
        }

        .group-products li .name {
            padding-top: 5px;
            float: left;
        }

        .group-products li .quantity {
            float: right;
        }

        .group-products li .remove {
            margin-left: -1.3em;
            font-size: 1.2rem;
            padding-top: 5px;
            float: left;
            cursor: pointer;

        }

    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {

            /* TYPE OFFER */
            $(document).on('click', '.btn-type_offer', function () {

                $('.btn-type_offer').toggleClass('btn-primary');
                $('.btn-type_offer').toggleClass('btn-secondary');

                if ($(this).hasClass('type-single')) {
                    $('#type_offer').val('single');
                } else {
                    $('#type_offer').val('combo');
                }
            });

            /* END TYPE */


            @if(isset($pickup->id))
            /* MENU LEFT ACTIONS */
            $(document).on('click', '.list-menu ul li .add', function () {
                addItem(this);
            });

            $(document).on('click', '.list-menu .add-all', function () {

                var section = $(this).text();

                /*if (!$('#'+section).length) {
                    addSection(section);
                }*/

                $(this).parent().children('ul').children('li').each(function (i, item) {
                    addItem(item);
                });

                $(this).removeClass('add-all');


            });
            /* MENU END */

            /* LIST PRODUCTS ACTIONS */
            $(document).on('click', '.remove-section', function () {

                $(this).parent().parent().find('.group-products li').each(function (i, el) {
                    removeItem(el);
                });

                removeSection($(this).parent().parent());

            });
            $(document).on('click', '.list-group-item .remove', function () {
                removeItem($(this).parent());
            });
            /* PRODUCTS END */
            @endif
            $('.fa-spin').hide();
            function validateForm(action_type){
                var url = $('.submit-offert').attr('action');
                var name = $('#name').val();
                var brand_id = $('#brand_id').val();
                var restaurant_id = $('#restaurant_id').val();
                var offer_date = $('#date').val();
                var price = $('#price').val();
                var type_offer = $('#type_offer').val();
                var quantities = [];
                var products = [];
                var medias = [];
                var timeslot_id = [];
                $('.quantity input[name="quantity[]"]').each(function(element){
                    quantities.push($(this).val());
                });
                $('input[name="products[]"]').each(function(element){
                    products.push($(this).val());
                });
                $('input[name="media[]"]').each(function(element){
                    medias.push($(this).val());
                });

                $('input[name="timeslot_id[]"]:checked').each(function(index, element){
                    timeslot_id.push($(this).val());
                });
                var quantity_offer = $('#quantity_offer').val();
                var check_media = $('#check_media').val();
                var suspended = $('#suspended').val();
                if(restaurant_id === null) {
                    $('#error_response').empty();
                    $('#error_response .error_msg ul').append(`<li id="alert-error">Restaurant Required</li>`);
                    return false;
                }
                else{
                $.ajax({
                    type: 'POST',
                    url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": name,
                        "brand_id": brand_id,
                        "restaurant_id": restaurant_id,
                        "date": offer_date,
                        "timeslot_id": timeslot_id,
                        "price": price,
                        "type_offer": type_offer,
                        "quantity": quantities,
                        "products": products,
                        "quantity_offer": quantity_offer,
                        "media": medias,
                        "check_media": check_media,
                        "suspended": suspended,
                        "_method": 'put'
                    },
                    success: function (data) {
                        $(`.${action_type}`).attr('disabled', true);
                        $(`.${action_type} .fa-spin`).show();
                        window.location.href= $('.save-offer').data('href');
                    },
                    error: function (reject) {
                        $(`.${action_type}`).attr('disabled', false);
                        $(`.${action_type} .fa-spin`).hide();
                        $('#error_response').empty();
                        var list_error = `<div class="d-flex">
                        <div class="col-12"><div class="alert alert-danger error_msg">
                        <ul></ul>
                        </div></div></div>`;
                        var errors = JSON.parse(reject.responseText).errors;
                        $('#error_response').append(list_error);
                        if(errors.name){
                            $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.name[0]}</li>`)
                        }
                        if(errors.price){
                            $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.price[0]}</li>`)
                        }
                        if(errors.products){
                            $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.products[0]}</li>`)
                        }
                        if(errors.quantity_offer){
                            $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.quantity_offer[0]}</li>`)
                        }
                        if(errors.media){
                            $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.media[0]}</li>`)
                        }
                        if(errors.quantity){
                            $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.quantity[0]}</li>`)
                        }
                        if(errors.type_pickup){
                            $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.type_pickup[0]}</li>`)
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
                }
            }
            $(document).on('click', '.save-offer', function(e) {
                e.preventDefault();
                $('.save-offer .fa-spin').show();
                $('.save-offer').attr('disabled', true);
                validateForm('save-offer');
                
            });
            $(document).on('click', '.suspend-offer', function(e) {
                e.preventDefault();
                $('.suspend-offer .fa-spin').show();
                $('.suspend-offer').attr('disabled', true);
                validateForm('suspend-offer');
                
            });
        });
        function addItem(el) {

            var id = $(el).data('id');
            var name = $(el).data('name');
            var section = $(el).data('section');
            if (!$('#' + section.replace(/\W/g, '')).length) {
                addSection(section);
            }
            $(el).removeClass('add');
            $(el).addClass('removed');
            var html = '<li class="list-group-item" data-id="' + id + '">';
            html += '<i class="fa fa-minus-square remove"></i>';
            html += '<div class="name">' + name + '</div>';
            html += '<div class="quantity"><input type="text" name="quantity[]" value="10" maxlength="3"/></div>';
            html += '<input type="hidden" name="products[]" value="' + id + '" />';
            html += '</li>';
            $('#' + section.replace(/\W/g, '') + ' .group-products').append(html);

        }

        function removeItem(el) {

            var name = $(el).find('.name').text();

            $(el).remove();

            $(".list-menu ul").find("[data-name='" + name + "']").removeClass('removed');
            $(".list-menu ul").find("[data-name='" + name + "']").addClass('add');


        }

        function addSection(name) {

            var html = '<div class="card " id="' + name.replace(/\W/g, '') + '">';
            html += '<div class="card-header">';
            html += '<h6 class="float-left">' + name + '</h6>';
            html += '<i class="fi-trash float-right font-18 remove-section"></i>';
            html += '</div>';
            html += '<div class="card-body">';
            html += '<p class="card-title text-right">Disponibilità <small>(x giorno)</small></p>';
            html += '<ul class="list-group list-group-flush group-products">';
            html += '</ul>';
            html += '</div>';
            html += '</div>';

            if ($('.list-section div').length) {
                $('.list-section').append('<div class="text-center mt-4 mb-4"><i class="fi-plus"></i></div>');
            }
            $('.list-section').append(html);

            checkRightTypeOffer();

        }

        function removeSection(el) {

            var name = $(el).attr('id');
            console.log("Remove " + name);
            $(el).remove();

            $(".list-menu").find("[data-clean-name='" + name + "'] h6").addClass('add-all');

            checkRightTypeOffer();

        }

        function checkRightTypeOffer() {
            $('.btn-type_offer').removeClass('btn-primary');
            $('.btn-type_offer').removeClass('btn-secondary');

            if ($(".card").length <= 1) {
                $('#type_offer').val('single');
                $('.btn-type_offer.type-single').addClass('btn-primary');
                $('.btn-type_offer.type-combo').addClass('btn-secondary');
            } else {
                $('#type_offer').val('combo');
                $('.btn-type_offer.type-combo').addClass('btn-primary');
                $('.btn-type_offer.type-single').addClass('btn-secondary');
            }
        }

    </script>
@endpush
