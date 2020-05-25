<div class="row">
  <div class="col-12">
        @if($pickup->id)
        <h4 class="text-center">{{ ucfirst($pickup->type_pickup) }}</h4>
        @else
        <field-radio label="Type" field="type_pickup" :items="['offer'=>'Offer','subscription'=>'Subscription']" :model="$pickup" required />
        @endif
  </div>
</div>
<div class="row">
    <div class="col-12">
          <field-text label="name" field="name" :model="$pickup" required  />
    </div>
</div>

<div class="row">
  <company-restaurant-select :model="$pickup" />
</div>


<div class="row">
    <div class="col-12 col-md-6">
          <field-date label="Offer duration" :model="$pickup" field="date" range="true" />
    </div>
    <div class="col-12 col-md-6">
          @if($pickup->id)
            <field-select label="Offer disposable" field="timeslot_id" foreignid="timeslot_id" :model="$pickup" type="relation" :values="$pickup->restaurant->timeslots" required  />
          @else
              @if(Auth::user()->is_restaurant && Auth::user()->restaurant->first())
                <field-select label="Offer disposable" field="timeslot_id" foreignid="timeslot_id" :model="$pickup"
                              type="relation" :values="Auth::user()->restaurant->first()->timeslots" required  />
              @else
                <field-select label="Offer disposable" field="timeslot_id" foreignid="timeslot_id" :model="$pickup" type="relation" :values="[]" required  />
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
  <div class="col-12">
        <div class="form-group d-flex justify-content-between">
            @if(Auth::user()->is_super)
                @if($pickup->id)
                 <button type="submit" class="btn w-100 btn-success mr-3" field="status_pickup" name="status_pickup" value="PENDING">{{ ucfirst(trans('button.save')) }}</button>
                 <button type="submit" class="btn w-100 btn-primary" field="status_pickup" name="status_pickup" value="APPROVED">{{ ucfirst(trans('button.approves')) }}</button>
                @else
                <button type="submit" class="btn btn-block w-lg btn-success float-right">{{ ucfirst(trans('button.next')) }} </button>
                @endif
            @endif

            @if(Auth::user()->is_owner || Auth::user()->is_restaurant)
                @if($pickup->id)
                <button type="submit" class="btn btn-block w-lg btn-success float-right" value="PENDING">{{ ucfirst(trans('button.save')) }}</button>
                @else
                <button type="submit" class="btn btn-block w-lg btn-success float-right">{{ ucfirst(trans('button.next')) }}</button>
                @endif
            @endif

        </div>
  </div>
</div>

@push('scripts')
<script>
$(document).ready(function(){

    $(document).on('change', '#restaurant_id', function(){

        loadTimeslots( $(this).val() );

    });

});

function loadTimeslots(id) {

  if (id) {

    $.ajax({
        url: "{{ route('restaurant.timeslots.data') }}/"+id,
        type: 'GET',
        success: function(data) {

            $("#timeslot_id").html('');

            $.each(data, function(i, timeslot){

                $("#timeslot_id").append('<option value="' + timeslot.id + '">' + timeslot.name + '</option>')
            });
        }
    });

  } else {
    $("#restaurant_id").html('<option>Select Company first</option>');
  }

}
</script>
@endpush
