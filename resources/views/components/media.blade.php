<div class="media-container">
    <div class="media-container-header p-3">
        <h3>Media</h3>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="form-group">
                    <input type="text" placeholder="Search" class="form-control search-file">
                </div>
            </div>
            <div class="offset-xl-6 col-xl-3 offset-lg-4 col-lg-4 offset-md-4 col-md-4 col-sm-6 col-12">
                <div class="form-group">

                    <!-- Our markup, the important part here! -->
                    <div id="drag-and-drop-zone" class="dm-uploader">

                        <div class="btn btn-primary btn-block">
                            <span>{{ ucfirst(trans('button.add_new_file')) }}</span>
                            <input name="file" type="file" title='Click to add Files'/>
                        </div>
                    </div><!-- /uploader -->

                </div>
            </div>
            <div class="col-xl-3">
                <div class="container-load">

                </div>
            </div>
        </div>
        <!-- Filtri -->
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="form-group">
                    <label for="">{{ __('labels.company') }}</label>
                    <select id="brand_id" class="form-control" name="company-filter">
                        @if(Auth::user()->is_super)
                            <option value="_all">{{ __('labels.all_company') }}</option>
                        @endif
                        @if($brands)
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="form-group">
                    <label for="">{{ __('labels.restaurant') }}</label>
                    <select id="restaurant_id" class="form-control" name="restaurant-filter">
                    </select>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="form-group">
                    <label for="">{{ __('labels.status_media') }}</label>
                    <select id="status_media" class="form-control" name="status-filter">
                        <option value="_all">{{ __('labels.all') }}</option>
                        <option value="APPROVE">{{ __('labels.approved') }}</option>
                        <option value="PENDING">{{ __('labels.pending') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="media-container-body p-4 border">
        <div class="row list-thumbnail">
            @foreach($media as $file)

                <div class="thumb-image" data-company-id="@if($file->company){{$file->company->id}}@endif"
                     data-restaurant-id="@if($file->restaurant){{$file->restaurant->id}}@endif"
                     data-status="{{$file->status_media}}">
                    <figure class="view-file">
                        <img src="{{ $file->getImageSize('thumbnail') }}" data-id="{{ $file->id }}">
                        <label>{{ $file->name }}</label>
                        @if($file->company)
                            <label>{{ $file->company_name }}</label>
                        @endif
                        @if($file->restaurant)
                            <label>{{ $file->restaurant->name }}</label>
                        @endif
                        @if($file->status_media == 'PENDING')
                            <button type="button" class="btn btn-primary mt-3 w-100 js-approve-media"
                                    data-id="{{ $file->id }}">
                                {{ ucfirst(trans('button.wait_approves')) }}
                            </button>
                        @else
                            <button type="button" class="btn btn-success mt-3 w-100 js-wait-media" data-id="{{
                                $file->id }}">
                                {{ ucfirst(trans('button.approved')) }}
                            </button>
                        @endif
                    </figure>
                </div>
            @endforeach
        </div>
    </div>
    <div class="media-container-side p-3">
        <div class="preview-image">
            <figure><img src="" class="preview-file"></figure>
            <p class="preview-name">Name</p>
            <div class="add-image-container">
                <input type="hidden" class="src-image" value=""/>
                <input type="hidden" class="id-image" value=""/>
                <button type="button" class="btn btn-primary btn-block add-image"
                        data-dismiss="modal">{{ ucfirst(trans('button.add_image')) }}</button>
            </div>

            <div class="edit-image-container">
                <a href="{{ route('media.edit', 1)}}"
                   class="btn btn-primary btn-block edit-image">{{ ucfirst(trans('button.edit_image')) }}</a>
            </div>

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

        // Search overwrite, case insensitive
        jQuery.expr[':'].contains = function (a, i, m) {
            return jQuery(a).text().toUpperCase()
                .indexOf(m[3].toUpperCase()) >= 0;
        };

        $(document).ready(function () {

            initFilters();

            //Filters
            $(document).on('change', '#brand_id', function () {
                filtersMediaByCompany();
            });

            $(document).on('change', '#restaurant_id', function () {
                filtersMediaByRestaurant();
            });

            $(document).on('change', '#status_media', function () {

                $.each($('.thumb-image'), function (i, el) {
                    if ($('#status_media').val() == '_all') {
                        $(el).show();
                    } else {
                        if ($('#status_media').val() == $(el).data('status')) {
                            $(el).show();
                        } else {
                            $(el).hide();
                        }
                    }

                });

            });


            //Approve media
            $(document).on('click', '.js-approve-media', function () {
                $.ajax({
                    url: '{{ route('media.approve') }}/' + $(this).data('id'),
                    type: 'GET',
                    success: function (data) {
                        var elem = $('button[data-id="' + data.id + '"]');
                        elem.toggleClass('js-approve-media');
                        elem.toggleClass('js-wait-media');
                        elem.toggleClass('btn-success');
                        elem.toggleClass('btn-primary');
                        elem.text('{{ ucfirst(trans('button.approved')) }}');

                    },
                    error: function (xhr, status, error) {
                        alert(xhr.status);
                        alert(xhr.responseText);
                    }
                });
            });

            //Pending media
            $(document).on('click', '.js-wait-media', function () {
                $.ajax({
                    url: '{{ route('media.pending') }}/' + $(this).data('id'),
                    type: 'GET',
                    success: function (data) {
                        var elem = $('button[data-id="' + data.id + '"]');
                        elem.toggleClass('js-approve-media');
                        elem.toggleClass('js-wait-media');
                        elem.toggleClass('btn-success');
                        elem.toggleClass('btn-primary');
                        elem.text('{{ ucfirst(trans('button.wait_approves')) }}');

                    },
                    error: function (xhr, status, error) {
                        alert(xhr.status);
                        alert(xhr.responseText);
                    }
                });
            });

            // Search //
            // hide all thumb images except searched name
            $(document).on('keyup', '.search-file', function () {

                var search = $(this).val();
                $('.thumb-image').hide();
                $('.thumb-image:contains("' + search + '")').show();

            });


            // Click outside thumb //
            // deselect image if click on body
            $(document).on('click', '.media-search-body', function (e) {

                if (!$(e.target).parent().hasClass('view-file')) {

                    $('.view-file img').removeClass('active');
                    $('.preview-image').hide();
                }

            });

            // Click thumb //
            // Select preview Image
            $(document).on('click', '.view-file img', function () {

                $(this).removeClass('active');

                var id = $(this).data('id');
                $(this).addClass('active');

                // get from parent JS, it is different if is modal or not
                loadImage(id);

            });


            $('#drag-and-drop-zone').dmUploader({ //
                url: '/admin/file/upload',
                maxFileSize: 3000000, // 3 Megs
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                onComplete: function () {

                },
                onUploadProgress: function (id, percent) {
                    progress_bar(percent);
                },
                onUploadSuccess: function (id, data) {
                    add_thumbnail(data);
                    $('.container-load').html('');

                },
                onUploadError: function (id, xhr, status, message) {
                    error_message(message);
                },
                onFallbackMode: function () {
                    console.log('fallback');
                },
                onFileSizeError: function (file) {
                    error_message('File max upload size');

                }
            });

        });

        function add_thumbnail(data) {

            html = '<div class="thumb-image">';
            html += '    <figure class="view-file">';
            html += '        <img src="' + data.url + '" data-id="' + data.id + '">';
            html += '        <label>' + data.name + '</label>';
            html += '        <button type="button" class="btn btn-primary mt-3 w-100 js-wait-media">' + '{{ ucfirst
            (trans("button.wait_approves")) }}' + '</button>';
            html += '    </figure>';
            html += '</div>';

            $('.list-thumbnail').prepend(html);

        }

        function progress_bar(percent) {
            percent = Math.round(percent / 1.1);
            html = 'Loading <div class="progress"><div class="progress-bar" role="progressbar" style="width: ' + percent + '%" aria-valuenow="' + percent + '" aria-valuemin="0" aria-valuemax="100">' + percent + '%</div></div>';

            $('.container-load').html(html);

        }

        function error_message(message) {
            html = '<div class="alert alert-danger" role="alert">' + message + '</div>';
            $('.container-load').html(html);
        }

        function initFilters() {
            @if(Auth::user()->is_owner)
            if ($('#brand_id').val() != '_all') {
                loadRestaurants($('#brand_id').val());
            }
            @elseif(Auth::user()->is_restaurant)
            $('#restaurant_id').append('<option value="{{ Auth::user()->restaurant->first()->id }}">{{
                Auth::user()->restaurant->first()->name }}</option>');
            @endif
        }

        function filtersMediaByCompany() {
            if ($('#brand_id').val() != '_all') {
                loadRestaurants($('#brand_id').val());
                $.each($('.thumb-image'), function (i, el) {
                    if ($(el).data('company-id') == $('#brand_id').val()) {
                        $(el).show();
                    } else {
                        $(el).hide();
                    }
                })
            } else {
                $('.thumb-image').show();
            }
        }

        function filtersMediaByRestaurant() {
            if ($('#restaurant_id').val() != '_all') {
                $.each($('.thumb-image'), function (i, el) {
                    if ($(el).data('restaurant-id') == $('#restaurant_id').val()) {
                        $(el).show();
                    } else {
                        $(el).hide();
                    }
                })
            } else {
                filtersMediaByCompany();
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

                            restaurantElem.append('<option value="' + restaurant.id + '">' + restaurant.name + '</option>')
                        });
                    }
                });
            }
        }


    </script>
@endpush
