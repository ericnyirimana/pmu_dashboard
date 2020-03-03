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
          <field-text label="Name" field="name" :model="$pickup" required  />
    </div>
</div>

<div class="row">
  <brand-restaurant-select :model="$pickup" />
</div>


<div class="row">
    <div class="col-12 col-md-6">
          <field-date label="Offer duration" :model="$pickup" field="date" range="true" />
    </div>
    <div class="col-12 col-md-6">
          @if($pickup->id)
            <field-select label="Offer disposable" field="timeslot_id" foreignid="timeslot_id" :model="$pickup" type="relation" :values="$pickup->restaurant->timeslots" required  />
          @else
            <field-select label="Offer disposable" field="timeslot_id" foreignid="timeslot_id" :model="$pickup" type="relation" :values="[]" required  />
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
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">@if($pickup->id) Save @else Next @endif</button>
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
