<div class="row">
    <div class="col-12">
        @if($pickup->id)
            <h4 class="text-center">{{ ucfirst($pickup->type_pickup) }}</h4>
        @else
            <!-- <field-radio label="Type" field="type_pickup" :items="['offer'=>'Offer','subscription'=>'Subscription']"
                         :model="$pickup" required/> -->
        <div class="form-group">
            <div class="form-check-label">
                <label>Type</label>  </div>
            <div class="form-check form-check-inline parsley-error">
                <input class="form-check-input" type="radio" name="type_pickup" id="type_pickup_Offer" value="offer" required=""
                       data-parsley-multiple="type_pickup" data-parsley-id="12" checked>
                <label class="form-check-label" for="type_pickup_Offer">
                    Offer
                </label>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12">
        <field-text label="name" field="name" :model="$pickup" required/>
    </div>
</div>

<div class="row">
    <company-restaurant-select :model="$pickup" disabled/>
</div>


<div class="row">
    <div class="col-12 col-md-6">
        @if($pickup->is_not_editable)
            <field-date label="offer_duration" :model="$pickup" field="date" range="true" disabled/>
        @else
            <field-date label="offer_duration" :model="$pickup" field="date" range="true"/>
        @endif
    </div>
    <div class="col-12 col-md-6">
        @if($pickup->id)
            @if($pickup->is_not_editable)
                <field-select label="offer_disposable" field="timeslot_id" foreignid="timeslot_id" :model="$pickup"
                              type="relation" :values="$pickup->restaurant->timeslots" required disabled/>
            @else
                <field-select label="offer_disposable" field="timeslot_id" foreignid="timeslot_id" :model="$pickup"
                              type="relation" :values="$pickup->restaurant->timeslots" required/>
            @endif
        @else
            @if(Auth::user()->is_restaurant && Auth::user()->restaurant->first())

                <field-select label="offer_disposable" field="timeslot_id" foreignid="timeslot_id" :model="$pickup"
                              type="relation" :values="Auth::user()->restaurant->first()->timeslots" required/>
            @else
                <field-select label="offer_disposable" field="timeslot_id" foreignid="timeslot_id" :model="$pickup"
                              type="relation" :values="[]" required/>
            @endif
        @endif
    </div>
</div>

@if($pickup->type_pickup == 'offer')
    @include('admin.pickups.parts.form-offer')
@elseif($pickup->type_pickup == 'subscription')
    @include('admin.pickups.parts.form-subscription')
@endif

<div class="row mt-5">
    <div class="col-md-3 col-lg-6">
        <div class="form-group d-flex justify-content-between">
            @if(Route::currentRouteName() == 'pickups.create')
            <button type="submit" class="btn btn-block w-lg btn-success float-right">
            {{ ucfirst(trans('button.next')) }}  
            </button>
            @else
            <button type="button" class="btn btn-block w-lg btn-success float-right save-offer" data-href="{{ route('pickups.index') }}">
            {{ ucfirst(trans('button.save')) }}
            <i class="fa fa-circle-o-notch fa-spin" style="font-size:19px"></i>
            </button>
            @endif
        </div>
    </div>
    <div class="col-md-3 col-lg-6">
        @if(Route::currentRouteName() == 'pickups.edit')
            @if(!$pickup->suspended)
                @if($pickup->is_not_editable)
                    <div class="form-group d-flex justify-content-between">
                        <button type="button" name="suspended" id="suspended" value="1" class="btn btn-block w-lg btn-primary
                float-right susp-register" data-name="{{ $pickup->name }}" data-register="{{ $pickup->id }}"
                                data-toggle="modal" data-target=".suspend-register">{{
            ucfirst(trans('button.suspend')) }}</button>
                @else
                    <div class="form-group d-flex justify-content-between">
                        <button type="button" name="suspended" id="suspended" value="1" class="btn btn-block w-lg btn-primary
    float-right suspend-offer">{{ ucfirst(trans('button.suspend')) }}
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:19px"></i>
    </button>
                    </div>
                @endif
            @else
                <div class="form-group d-flex justify-content-between">
                    <button type="button" name="suspended" id="suspended" value="0" class="btn btn-block w-lg btn-primary
float-right suspend-offer">{{ucfirst(trans('button.enable')) }}
<i class="fa fa-circle-o-notch fa-spin" style="font-size:19px"></i>
</button>
                </div>
            @endif
        @endif
        </div>
    </div>
    @if($pickup->is_not_editable && !$pickup->suspended)
        <modal-suspend route="pickup"/>
    @endif
    @push('scripts')
        <script>
            $(document).ready(function () {


                $(document).on('change', '#restaurant_id', function () {

                    loadTimeslots($(this).val());

                });

            });

            function loadTimeslots(id) {

                if (id) {

                    $.ajax({
                        url: "{{ route('restaurant.timeslots.data') }}/" + id,
                        type: 'GET',
                        success: function (data) {

                            $("#timeslot_id").html('');

                            $.each(data, function (i, timeslot) {

                                $("#timeslot_id").append('<option value="' + timeslot.id + '">' + timeslot.name + '</option>')
                            });
                        }
                    });

                } else {
                    $("#restaurant_id").html('<option value="">Select Company first</option>');
                }

            }
        </script>
@endpush
