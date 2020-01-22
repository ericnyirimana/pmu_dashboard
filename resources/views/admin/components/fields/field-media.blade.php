<div class="form-group">
      <label for="{{ $field }}">{{ $label }}</label>

      <div class="fileupload fileupload-new">
          <div class="box-image fileupload-exists thumbnail fileupload-preview">
              @if ( empty($model->$field) )
                <i class="fa fa-file-image-o fa-2x"></i>
              @else
                  <img src="{{ $model->media->getImageSize('medium') }}" class="rounded" />
                  <input type='hidden' name='media_id' value='{{ $model->media_id }}'>
              @endif
          </div>
          <div>
              <button type="button" class="btn btn-secondary btn-file btn-add-image" data-toggle="modal" data-target="#mediaModal">
                  <span class=""><i class="fa fa-paper-clip"></i> Select image</span>
              </button>
          </div>
      </div>
</div>
<!-- Modal -->
<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModal" aria-hidden="true">
  <div class="modal-dialog modal-media" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Media</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

              <media :media="$media" />

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@push('styles')
<!-- Jquery filer css -->
<link href="{{ asset("/plugins/bootstrap-fileupload/bootstrap-fileupload.css")}}" rel="stylesheet" />
@endpush
@push('scripts')
<script>
$(document).ready(function(){

      $('#mediaModal').modal('handleUpdate');

      $(document).on('click', '.delete-image', function() {

          console.log('delete');
          $(this).parent().remove();

      });

      $(document).on('click', '.add-image', function(){

            var id = $('.src-image').val();
            var img = $('.id-image').val();
            img = img.replace('small', 'medium');

            var html_file = "<img src='" + img + "' class='rounded' /><input type='hidden' name='media_id' value='" + id + "'>";

            $('.box-image').html(html_file);

      });

      // Click outside thumb //
      // deselect image if click on body
      $(document).on('click', '.media-search-body', function(e) {

          if(!$(e.target).parent().hasClass('view-file')) {

              $('.view-file img').removeClass('active');
              $('.preview-image').hide();
          }

      });

});


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
