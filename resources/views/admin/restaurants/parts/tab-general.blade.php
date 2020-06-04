<h6 class="">{{ ucfirst(trans('labels.general_info')) }}</h6>
<div class="d-flex flex-row row card-body">
    @if(Auth::user()->is_manager)
    <div class="col-md-12 col-lg-6">
          <field-text label="name" field="name" :model="$restaurant"  disabled />
            <input type="hidden" name="name" value="{{$restaurant->name}}">
    </div>
    <div class="col-md-12 col-lg-6">
          <field-map label="address" field="address" :model="$restaurant"  disabled />
    </div>
    <div class="col-md-12 col-lg-6">
        <field-text label="merchant_id" field="merchant_stripe" :model="$restaurant" disabled />
    </div>
    @else
        <div class="col-md-12 col-lg-6">
            <field-text label="name" field="name" :model="$restaurant" required />
        </div>
        <div class="col-md-12 col-lg-6">
            <field-map label="address" field="address" :model="$restaurant" required  />
        </div>
        <div class="col-md-12 col-lg-6">
            <field-text label="merchant_id" field="merchant_stripe" :model="$restaurant" />
        </div>
    @endif
</div>

<hr />

<h6 class="">{{ ucfirst(trans('labels.banking_data')) }}</h6>
<div class="d-flex flex-row row card-body">
    <div class="col-md-12 col-lg-6">
        @if(Auth::user()->is_manager)
            <field-map-billing-address label="billing_address" field="billing_address" :model="$restaurant" disabled />

        @else
        <field-map-billing-address label="billing_address" field="billing_address" :model="$restaurant" required  />
        @endif
    </div>
    <div class="col-md-12 col-lg-6">
        @if(Auth::user()->is_super)
        <field-text label="piva_fiscal_code" field="iva" :model="$restaurant" required />
        @else
        <field-text label="piva_fiscal_code" field="iva" :model="$restaurant" disabled />
        @endif
    </div>

    <div class="col-md-12 col-lg-10">
        @if(Auth::user()->is_super)
        <field-text label="iban" field="iban" :model="$restaurant" required />
        @else
        <field-text label="iban" field="iban" :model="$restaurant" disabled />
        @endif
    </div>
    <div class="col-md-12 col-lg-2">
        @if(Auth::user()->is_super)
            <field-text label="fee_pmu" field="fee" :model="$restaurant" required />
        @else
            <field-text label="fee_pmu" field="fee" :model="$restaurant" disabled />
        @endif

    </div>

    <div class="col-md-12 col-lg-6">
        @if(Auth::user()->is_super)
            <field-text label="pec" field="pec" :model="$restaurant" required />
        @else
            <field-text label="pec" field="pec" :model="$restaurant" disabled />
        @endif

    </div>
    <div class="col-md-12 col-lg-6">
        @if(Auth::user()->is_super)
            <field-text label="identifier_code" field="id_code" :model="$restaurant" required />
        @else
            <field-text label="identifier_code" field="id_code" :model="$restaurant" disabled />
        @endif

    </div>
</div>

<hr />

<h6 class="">{{ ucfirst(trans('labels.opening_hours')) }}</h6>
<div class="card-body">
    <div class="row">
      <div class="col-12">
          <div class="button-list">
              <div class="form-group">
                  <field-button group="true" type="simple" label="Monday" name="monday" class="btn btn-primary waves-effect w-lg" />
                  <field-button group="true" type="simple" label="Tuesday" name="tuesday" class="btn btn-secondary btn-bordered waves-effect w-lg" />
                  <field-button group="true" type="simple" label="Wednesday" name="wednesday" class="btn btn-secondary btn-bordered waves-effect w-lg" />
                  <field-button group="true" type="simple" label="Thursday" name="thursday" class="btn btn-secondary btn-bordered waves-effect w-lg" />
                  <field-button group="true" type="simple" label="Friday" name="friday" class="btn btn-secondary btn-bordered waves-effect w-lg" />
                  <field-button group="true" type="simple" label="Saturday" name="saturday" class="btn btn-secondary btn-bordered waves-effect w-lg" />
                  <field-button group="true" type="simple" label="Sunday" name="sunday" class="btn btn-secondary btn-bordered waves-effect w-lg" />
              </div>
          </div>
      </div>
    </div>

    <field-timeset day="monday" :model="$restaurant" open="true" />
    <field-timeset day="tuesday" :model="$restaurant" />
    <field-timeset day="wednesday" :model="$restaurant" />
    <field-timeset day="thursday" :model="$restaurant" />
    <field-timeset day="friday" :model="$restaurant" />
    <field-timeset day="saturday" :model="$restaurant" />
    <field-timeset day="sunday" :model="$restaurant" />

</div>

<hr />
<h6 class="">{{ ucfirst(trans('labels.extraordinary_close')) }}</h6>
<div class="card-body">
    <div class="col-12">
        <field-closed-days :model="$restaurant" />
    </div>
</div>

<hr />

@if(Auth::user()->is_super)
<h6 class="">{{ ucfirst(trans('labels.meal_type')) }}</h6>

<div class="card-body">
    <div class="col-12">
        <field-checkbox field="mealtype_id" :model="$restaurant->timeslots" :items="$mealtype" required />
    </div>
</div>

<hr />
@endif

<h6 class="">{{ ucfirst(trans('labels.gallery_restaurant')) }}</h6>
<div class="card-body">
    <div class="col-12">
        <field-media-list label="images" :model="$restaurant" />
    </div>
</div>

<modal-media :media="$media" />

@push('scripts')
<script>
$(document).ready(function(){

      // add new time
      $(document).on('click', '.add_time', function(){

          var name = $(this).attr('name');
          name = name.replace('add', '');
            console.log(name);
          var newTime =$('.time'+name).clone();

          //remove references class to use to copy (otherwise it will double copy every time)
          newTime.removeClass("time"+name);
          newTime.removeClass("first_item");

          newTime.find('#from'+name+'0').attr({'id': 'from'+name+'1', 'name': 'openings['+ name.replace('_', '')
                  +'][times][1][from]'});
          newTime.find('#to'+name+'0').attr({'id': 'to'+name+'1', 'name': 'openings['+ name.replace('_', '')
                  +'][times][1][to]'});

          newTime.appendTo('.table'+name);

          $(".button"+name).hide();


      });

      // remove especific time
      $(document).on('click', '.remove_time', function(){

          var removeTime = $(this).parent().parent();
          var name = $(this).attr('name');
          name = name.replace('remove', '');

          if (removeTime.hasClass('first_item')) {
              alert("You can`t remove the line");
          } else {
              removeTime.remove();
              $(".button"+name).show();
          }



      });


      // Change the day to set time
      $(document).on('click', '.button-list button', function(){

          // reset all buttons first
          $('.button-list button').removeClass('btn-primary');
          $('.button-list button').addClass('btn-secondary');
          $('.button-list button').addClass('btn-bordered');

          $(this).addClass('btn-primary');
          $(this).removeClass('btn-secondary');
          $(this).removeClass('btn-bordered');


          openTimeTable($(this).attr('name'));

      });

      $(document).on('change', '.closed_day', function(){

        var name = $(this).data('name');

          if ($(this).is(':checked')) {

            $('.box-time_'+name).addClass("hideHours");

          } else {
              $('.box-time_'+name).removeClass("hideHours");
          }

      });


});

function openTimeTable(name) {

  $('.setTime').hide();
  $('.set_'+name).show();
}


</script>
@endpush
