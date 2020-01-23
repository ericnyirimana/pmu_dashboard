<h6 class="">General information</h6>
<div class="d-flex flex-row row card-body">
    <div class="col-md-12 col-lg-6">
          <field-text label="Name" field="name" :model="$restaurant" required  />
    </div>
    <div class="col-md-12 col-lg-6">
          <field-map label="Address" field="location" :model="$restaurant" required  />
    </div>

</div>
<hr />
<h6 class="">Opening hours</h6>

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
  <h6 class="">Extraordinary close</h6>
  <div class="card-body">
      <div class="col-12">
              <field-closed-days :model="$restaurant" />
      </div>
  </div>

  <hr />
  <h6 class="">Gallery Restaurant</h6>
  <div class="card-body">
      <div class="col-12">
            <field-media-list label="Images" :model="$restaurant"  />
      </div>
  </div>


<div class="d-flex flex-row row card-body">
    <div class="col-12">
          <div class="form-group">
              <button type="submit" class="btn btn-block w-lg btn-success float-right">Save</button>
          </div>
    </div>
</div>
<modal-media :media="$media" />

@push('scripts')
<script>
$(document).ready(function(){


      $(document).on('click', '.close-modal', function(){
            closeModal();
      });

      $(document).on('click', '.add-image', function(){

            var id = $('.src-image').val();
            var file = $('.id-image').val();

            var html_file = "<figure><img src='" + file + "'><input type='hidden' name='media[]' value='" + id + "'><i class='fa fa-trash delete-image'></i></figure>";

            $('.list-images').prepend(html_file);

            closeModal();

      });

      // add new time
      $(document).on('click', '.add_time', function(){

          var name = $(this).attr('name');
          name = name.replace('add', '');

          var newTime =$('.time'+name).clone();

          //remove references class to use to copy (otherwise it will copy duplicate every time)
          newTime.removeClass("time"+name);
          newTime.removeClass("first_item");

          newTime.appendTo('.table'+name);


      });

      // remove especific time
      $(document).on('click', '.remove_time', function(){

          var removeTime = $(this).parent().parent();

          if (removeTime.hasClass('first_item')) {
              alert("You can`t remove the line");
          } else {
              removeTime.remove();
          }



      });


      // Click outside thumb //
      // deselect image if click on body
      $(document).on('click', '.media-search-body', function(e) {

          if(!$(e.target).parent().hasClass('view-file')) {

              $('.view-file img').removeClass('active');
              $('.preview-image').hide();
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


// Load Image
// Load imaged clicked from thumb
function loadImage(file) {

  $.ajax({
      url: '{{ env('APP_URL') }}/media/image/'+file,
      context: document.body
    }).done(function(media) {
      $('.add-image-container').show();
      $('.preview-image').show();
      $('.preview-file').attr('src', media.files.medium);
      $('.preview-name').text(media.name);
      $('.src-image').val(media.id);
      $('.id-image').val(media.files.small);

  });

}

function closeModal() {

  $('.modal-media').hide(1);
  $('.preview-image').hide(1);

}

</script>
@endpush
