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
                                    <li data-name="{{ $section->name }}" data-clean-name="{{ preg_replace('/[^A-Za-z0-9]/', '', $section->name) }}" data-id="{{ $section->id }}">
                                        <div class="section-header" id="header-{{ $section->id }}">
                                            <span @if(empty
                                            ($pickup->sections) ||
                                            !in_array($section->name, array_keys($pickup->sections))) class="add-all" style="margin: 10px 0 !important;" @endif></span>
                                            @if(isset($section->products[0]))
                                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{ $section->id }}">
                                                {{ $section->name }}
                                                &nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                                                </button>
                                            @else
                                            <h6>{{ $section->name }}</h6>
                                            @endif
                                        </div>
                                        <ul id="collapse-{{ $section->id }}" class="collapse" aria-labelledby="header-{{ $section->id }}">
                                            @foreach($section->products as $product)
                                                @if($product->is_approved)
                                                <li>
                                                    <span @if(!in_array($product->id, $pickup->products->pluck('id')->toArray() ) )
                                                    class="add" @endif data-id="{{ $product->id }}"
                                                    data-name="{{ $product->name }}"
                                                    data-clean-name="{{ preg_replace('/[^A-Za-z0-9]/', '', $product->name) }}"
                                                    data-section="{{ $section->name }}"
                                                    data-section-id="{{ $section->position }}"
                                                    data-menu="{{ $section->id }}">
                                                    {{ $product->name }}
                                                    </span>
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
                    @php $lastKey = array_key_last($pickup->sections); @endphp @endif
                        @foreach($menu->sections as $section_key => $div_section)
                            @if(isset($pickup->sections[$div_section->name]))
                                @php $section = $pickup->sections[$div_section->name]; @endphp
                                <div id="menu_{{$section_key}}" class="section_list"> 
                                    <div class="card" id="{{ $div_section->name }}" data-id="{{ $section[0]->section->position }}" data-menu="{{ $section[0]->menu_section_id }}">
                                        <div class="card-header">
                                            <h6 class="float-left">{{ $div_section->name }}</h6>
                                            <i class="fi-trash float-right font-18 remove-section"></i>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-title text-right">Disponibilità
                                                <small>(x giorno)</small>
                                            </p>

                                            <ul class="list-group list-group-flush group-products">
                                                @if($section)
                                                    @foreach($section as $product)
                                                        <li class="list-group-item" data-id="{{ $product->id }}" >
                                                            <i class="fa fa-minus-square remove"></i>
                                                            <div class="name">{{ $product->name }}</div>
                                                            @if($pickup->type_pickup == 'offer')
                                                            <div class="quantity"><input type="text" name="quantity[]"
                                                                                        value="{{ $product->pivot->quantity_offer }}"
                                                                                        maxlength="3"/></div>
                                                            @endif
                                                            <input type="hidden" name="products[]" value="{{ $product->id }}"/>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4 mb-4" id="plus_{{$div_section->name}}"><i class="fi-plus"></i></div>
                                </div>
                            @else
                            <div id="menu_{{$section_key}}" class="section_list"></div>
                            @endif
                    @endforeach
            </div>
        </div>
    </div><!-- end col -->
</div>
@include('admin.pickups.parts.modal-error')

@push('styles')
    <style>


        .list-menu ul ul li, .list-menu ul li, .remove-section {
            cursor: pointer;
            padding: 5px;
            list-style: none;
            color: #AAAAAA;
        }


        .list-menu ul ul li span.add {
            color: #555555;
        }
        .section-header span {
            margin: 10px 0 !important;
        }
        .section-header button {
            color: #666f7b !important; 
            font-size:1rem !important; 
            text-decoration: none !important; 
            padding-left: 0px !important
        }
        .list-menu ul ul li span.add:before, .list-menu ul li span.add-all::before {
            content: "\f0fe"; /* FontAwesome Unicode*/
            font-family: FontAwesome;
            margin-left: -1.3em; /* same as padding-left set on li */
            padding-right: 10px;
            color: #666f7b;
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
            margin-top: 5px;
            float: left;
            cursor: pointer;

        }

        .section-header{
            display: inline-flex !important;
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

                $(this).parent().parent().children('ul').children('li').children('span').each(function (i, item) {
                    addItem(item);
                });

                $(this).removeClass('add-all');


            });
            /* MENU END */

            /* LIST PRODUCTS ACTIONS */
            $(document).on('click', '.remove-section', function () {
                $(this).removeClass('fi-trash');
                $(this).addClass('fa fa-circle-o-notch fa-spin');
                var section_id = $(this).parent().parent().attr("data-menu");
                var row = $(this);
                var pickup_id = {{ $pickup->id }};
                $.ajax({
                    type: 'GET',
                    url: "{{ route('today.ordered.menu') }}/"+pickup_id+"/"+section_id,
                    success: function (data) {
                        row.parent().parent().find('.group-products li').each(function (i, el) {
                            removeItem(el);
                        });
                        
                        removeSection(row.parent().parent());
                    },
                    error: function (reject) {
                        row.removeClass('fa fa-circle-o-notch fa-spin');
                        row.addClass('fi-trash');
                        $('#modal-error-body').empty();
                        var list_error = `<div class="modal-content" style="border: none; text-align: center;"></div>`;
                        var errors = JSON.parse(reject.responseText);
                        $('#info-modal').modal('show');
                        $('#modal-error-body').append(list_error);
                        if(errors){
                            $('#modal-error-body .modal-content').append(`<p class="text-danger" style="font-size: 20px"><i class="fa fa-exclamation-circle"></i> ${errors.error}</p>`)
                        }
                    }
                });

            });
            $(document).on('click', '.list-group-item .remove', function () {
                $(this).removeClass('fa-minus-square');
                $(this).addClass('fa-circle-o-notch fa-spin');
                var product_id = $(this).parent().attr('data-id');
                var pickup_id = {{ $pickup->id }};
                var row = $(this);
                $.ajax({
                    type: 'GET',
                    url: "{{ route('today.ordered.product') }}/"+pickup_id+"/"+product_id,
                    success: function (data) {
                        removeItem(row.parent());
                    },
                    error: function (reject) {
                        $(row).removeClass('fa-circle-o-notch fa-spin');
                        $(row).addClass('fa-minus-square');
                        $('#modal-error-body').empty();
                        var list_error = `<div class="modal-content" style="border: none; text-align: center;"></div>`;
                        var errors = JSON.parse(reject.responseText);
                        $('#info-modal').modal('show');
                        $('#modal-error-body').append(list_error);
                        if(errors){
                            $('#modal-error-body .modal-content').append(`<p class="text-danger" style="font-size: 20px"><i class="fa fa-exclamation-circle"></i> ${errors.error}</p>`)
                        }
                    }
                });
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
                var validate_months = $('#validate_months').val();
                var quantity_per_subscription = $('#quantity_per_subscription').val();
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
                    var ajaxData = {
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
                        "type_pickup": "{{ $pickup->type_pickup }}",
                        "validate_months": validate_months,
                        "quantity_per_subscription": quantity_per_subscription,
                        "_method": 'put'
                    }
                    if(action_type === 'suspend-offer') {
                        ajaxData.suspended = $('#suspended').val();
                    }
                    @if(session('first_edit'))
                        if(action_type !== 'suspend-offer') {
                            ajaxData.suspended = 0;
                        }
                    @endif
                $.ajax({
                    type: 'POST',
                    url,
                    data: ajaxData,
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
                        if(errors.validate_months){
                            $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.validate_months[0]}</li>`)
                        }
                        if(errors.quantity_per_subscription){
                            $('#error_response .error_msg ul').append(`<li id="alert-error">${errors.quantity_per_subscription[0]}</li>`)
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

            // Add minus icon for collapse element which is open by default
            $(".collapse.show").each(function(){
                    $(this).prev(".section-header").find(".fa-angle-down").addClass("fa-angle-up").removeClass("fa-angle-down");
                });

            // Toggle plus minus icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function(){
            $(this).prev(".section-header").find(".fa-angle-down").removeClass("fa-angle-down").addClass("fa-angle-up");
            }).on('hide.bs.collapse', function(){
            $(this).prev(".section-header").find(".fa-angle-up").removeClass("fa-angle-up").addClass("fa-angle-down");
            });
        });
        function addItem(el) {

            var id = $(el).data('id');
            var name = $(el).data('name');
            var section = $(el).data('section');
            var section_menu = $(el).data('menu');
            var section_id = $(el).data('section-id');
            if (!$('#' + section.replace(/\W/g, '')).length) {
                addSection(section, section_id, section_menu);
            }
            $('#header-'+section_menu+' span.add-all').removeClass('add-all');
            $(el).removeClass('add');
            $(el).addClass('removed');
            var html = '<li class="list-group-item" data-id="' + id + '">';
            html += '<i class="fa fa-minus-square remove"></i>';
            html += '<div class="name">' + name + '</div>';
            @if($pickup->type_pickup == 'offer')
            html += '<div class="quantity"><input type="text" name="quantity[]" value="10" maxlength="3"/></div>';
            @endif
            html += '<input type="hidden" name="products[]" value="' + id + '" />';
            html += '</li>';
            $('#' + section.replace(/\W/g, '') + ' .group-products').append(html);

        }

        function removeItem(el) {

            var name = $(el).find('.name').text();
            var menu_id = $(el).parent().parent().parent().attr('data-menu');
            $(el).remove();

            $(".list-menu ul").find("[data-name='" + name + "']").removeClass('removed');
            $(".list-menu ul").find("[data-name='" + name + "']").addClass('add');
            if($("#collapse-"+menu_id).find(".removed").length === 0){
                $("#header-"+menu_id+" span").addClass('add-all');
            }

        }

        function addSection(name, id, menu_id) {

            var html = '<div class="card" id="' + name.replace(/\W/g, '') + '" data-id="' + id + '" data-menu="' + menu_id + '">';
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

            $('#menu_'+id).append(html);
                $('#menu_'+id).append('<div class="text-center mt-4 mb-4" id="plus_'+name+'"><i class="fi-plus"></i></div>');

            checkRightTypeOffer();

        }

        function removeSection(el) {

            var name = $(el).attr('id');
            $(el).remove();
            $('#plus_'+name).remove();

            $(".list-menu").find("[data-clean-name='" + name + "'] .section-header span").addClass('add-all');

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
