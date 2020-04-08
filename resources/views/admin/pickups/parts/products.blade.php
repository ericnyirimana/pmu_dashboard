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

                <ul class="list-menu">
                    @foreach(['Dish','Drink'] as $type)
                        @php $class = 'sections'.$type; @endphp
                        <li><h5>{{ $type }}</h5>
                            <ul>

                                @foreach($menu->{$class} as $section)
                                    <li data-name="{{ str_replace(' ', '_', $section->name) }}"><h6 @if(empty
                              ($pickup->sections) ||
                              !in_array($section->name, array_keys($pickup->sections))) class="add-all" @endif>{{ $section->name }}</h6>
                                        <ul>
                                            @foreach($section->products as $product)

                                                <li @if(!in_array($product->id, $pickup->products->pluck('id')->toArray() ) )
                                                    class="add" @endif data-id="{{ $product->id }}"
                                                    data-name="{{ $product->name }}"
                                                    data-section="{{ str_replace(' ', '_', $section->name) }}">
                                                    {{ $product->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    @endforeach
                </ul>

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
                                <h6 class="float-left">{{ str_replace('_', ' ', $name) }}</h6>
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
            content: "\f0fe"; /* FontAwesome Unicode */
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

        });

        function addItem(el) {

            var id = $(el).data('id');
            var name = $(el).data('name');
            var section = $(el).data('section');

            if (!$('#' + section).length) {
                addSection(section);
            }

            $(el).removeClass('add');
            $(el).addClass('removed');

            var html = '<li class="list-group-item" data-id="' + id + '">';
            html += '<i class="fa fa-minus-square remove"></i>';
            html += '<div class="name">' + name + '</div>';
            html += '<div class="quantity"><input type="text" name="quantity[]" value="1" maxlength="3" /></div>';
            html += '<input type="hidden" name="products[]" value="' + id + '" />';
            html += '</li>';

            $('#' + section + ' .group-products').append(html);

        }

        function removeItem(el) {

            var name = $(el).find('.name').text();

            $(el).remove();

            $(".list-menu ul").find("[data-name='" + name + "']").removeClass('removed');
            $(".list-menu ul").find("[data-name='" + name + "']").addClass('add');


        }

        function addSection(name) {

            var html = '<div class="card " id="' + name + '">';
            html += '<div class="card-header">';
            html += '<h6 class="float-left">' + name.replace(/_/g, ' ',) + '</h6>';
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

            $(".list-menu").find("[data-name='" + name + "'] h6").addClass('add-all');

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
