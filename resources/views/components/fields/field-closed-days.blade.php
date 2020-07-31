@php $closedDays = $model->list_closed_days ?? ''; @endphp
<div class="form-group">

    <div class="row">

        <div class="col-12">


            @php
                #Create default values if is empty
                if ( empty($closedDays) ) {

                    isset($closedDays);

                    $closedDays = [['name' => '', 'date_from' => '', 'date_to' => '', 'repeat' => false]];

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
                            <input type="text" style="width: 200px;" name="closings[0][dates]" class="closing_dates form-control datepicker"
                                   placeholder="dd-mm-yyyy" value="" />
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div><!-- input-group -->
                    </div>
                    <div class="form-group box-days remove_date">
                        <i class="fa fa-trash-o fa-2x"></i> <label>Delete</label>
                    </div>

                </div>
            </div>
            {{-- END STANDARD SECTION OF DAYS INPUT --}}


            <div class="list_dates">
                @foreach($closedDays as $i=>$day)
                    @php $dates_from_to = ''; @endphp
                    @if(!empty($day['date_from']) && !empty($day['date_to']))
                    @php $dates_from_to = $day['date_from']." - ".$day['date_to']; @endphp
                    @endif
                    <div class="row date_box @if($i==0) first_item @endif" data-seq="{{ $i }}">

                        <div class="form-group box-days">
                            <input type="text" name="closings[{{ $i }}][name]" class="closing_name form-control"
                                   placeholder="Name" value="{{ $day['name'] }}"/>
                        </div>
                        <div class="form-group box-days">
                            <div class="input-group">
                                <input type="text" style="width: 200px;" name="closings[{{ $i }}][dates]"
                                       class="closing_dates form-control datepicker" placeholder="dd-mm-yyyy"
                                       value="{{ $dates_from_to }}" id="dp_{{ $i }}" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
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
                    $(this).daterangepicker({ 
                        locale: {
                            format: 'DD-MM-YYYY'
                        }
                     });
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
                box.find('.closing_dates').attr('name', 'closings[' + seq + '][dates]');
                box.find('.closing_dates').attr('id', 'dp_' + seq);
                box.find('.closing_dates').val('');
                initDatePicker($('#dp_' + seq));
                // box.find('.closing_repeat').attr('name', 'closings[' + seq + '][repeat]');
                // box.find('.closing_repeat').attr('checked', false);
                // box.find('.closing_repeat').attr('id', 'checkbox' + seq);
                // box.find('.closing_repeat').parent().find('label').attr('for', 'checkbox' + seq);

                $('.list_dates').append(box);

            }

            function initDatePicker(selector) {
                selector.daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear'
                    }
                    });

                    selector.on('apply.daterangepicker', function(ev, picker) {
                        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
                    });

                    selector.on('cancel.daterangepicker', function(ev, picker) {
                        $(this).val('');
                    });
            }
        });
    </script>
@endpush
