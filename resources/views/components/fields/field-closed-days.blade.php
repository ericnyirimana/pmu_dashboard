@php $closedDays = $model->list_closed_days ?? ''; @endphp
<div class="form-group">

    <div class="row">

        <div class="col-12">


            @php
                #Create default values if is empty
                if ( empty($closedDays) ) {

                    isset($closedDays);

                    $closedDays = [['name' => '', 'date' => '', 'repeat' => false]];

                }

            @endphp

            {{-- STANDARD SECTION OF DAYS INPUT --}}
            <div class="d-none">
                <div class="row date_box standard_closed_day_item" data-seq="0">
                    <div class="form-group box-days">
                        <input type="text" name="closings[0][name]" class="closing_name form-control" placeholder="Name"
                               value=""/>
                    </div>
                    <div class="form-group box-days">
                        <div class="input-group">
                            <input type="text" name="closings[0][date]" class="closing_date form-control datepicker"
                                   placeholder="dd-mm-yyyy" value="" />
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div><!-- input-group -->
                    </div>
                    <div class="form-group box-days">
                        <div class="checkbox">
                            <input id="checkbox" type="checkbox" name="closings[0][repeat]" checked=""
                                   class="closing_repeat">
                            <label for="checkbox">
                                Every year
                            </label>
                        </div>
                    </div>
                    <div class="form-group box-days remove_date">
                        <i class="fa fa-trash-o fa-2x"></i> <label>Delete</label>
                    </div>

                </div>
            </div>
            {{-- END STANDARD SECTION OF DAYS INPUT --}}


            <div class="list_dates">
                @foreach($closedDays as $i=>$day)
                    <div class="row date_box @if($i==0) first_item @endif" data-seq="{{ $i }}">

                        <div class="form-group box-days">
                            <input type="text" name="closings[{{ $i }}][name]" class="closing_name form-control"
                                   placeholder="Name" value="{{ $day['name'] }}"/>
                        </div>

                        <div class="form-group box-days">
                            <div class="input-group">
                                <input type="text" name="closings[{{ $i }}][date]"
                                       class="closing_date form-control datepicker" placeholder="dd-mm-yyyy"
                                       value="{{ $day['date'] }}" id="dp_{{ $i }}" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                        </div>
                        <div class="form-group box-days">
                            <div class="checkbox">
                                <input id="checkbox{{ $i }}" type="checkbox" name="closings[{{ $i }}][repeat]"
                                       {{ $day['repeat'] ? 'checked' : '' }} class="closing_repeat">
                                <label for="checkbox{{ $i }}">
                                    Every year
                                </label>
                            </div>
                        </div>
                        <div class="form-group box-days remove_date">
                            <i class="fa fa-trash-o fa-2x"></i> <label>Delete</label>
                        </div>

                    </div>

                @endforeach
            </div>
            <div class="row no-gutters mt-2">
                <div class="col-3">
                    <div class="form-group">
                        <button type="button" class="btn btn-success btn-block add_date"><i class="fa fa-plus"
                                                                                            aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@push('scripts')
    <script>
        $(document).ready(function () {

            initDatePicker($('#dp_0'));


            $(document).on('focus', '.datepicker', function () {

                if ($(this).hasClass('hasDatepicker') === false) {
                    $(this).datepicker({ dateFormat: 'dd-mm-yy' });
                }

            });

            $(document).on('click', '.add_date', function () {

                var box = $('.standard_closed_day_item').clone(true);

                seq = $('.list_dates .date_box').length;

                createClosedDayFields(box, seq);

            });

            $(document).on('click', '.remove_date', function () {

                var removeDate = $(this).parent();

                removeDate.remove();

            });

            function createClosedDayFields(box, seq) {

                box.removeClass('standard_closed_day_item');
                box.find('.closing_name').attr('name', 'closings[' + seq + '][name]');
                box.find('.closing_name').val('');
                box.find('.closing_date').attr('name', 'closings[' + seq + '][date]');
                box.find('.closing_date').attr('id', 'dp_' + seq);
                box.find('.closing_date').val('');
                initDatePicker($('#dp_' + seq));
                box.find('.closing_repeat').attr('name', 'closings[' + seq + '][repeat]');
                box.find('.closing_repeat').attr('checked', false);
                box.find('.closing_repeat').attr('id', 'checkbox' + seq);
                box.find('.closing_repeat').parent().find('label').attr('for', 'checkbox' + seq);

                $('.list_dates').append(box);

            }

            function initDatePicker(selector) {
                selector.datepicker({
                    dateFormat: 'dd-mm-yy',
                    autoclose: true,
                    todayHighlight: true
                });
            }
        });
    </script>
@endpush
