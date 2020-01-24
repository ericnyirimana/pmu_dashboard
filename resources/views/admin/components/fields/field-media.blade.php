<div class="form-group">
      <label for="{{ $field }}">{{ $label }}</label>

      <div class="fileupload">
          <div class="box-image thumbnail ">
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
@push('modal')

  @include('admin.media.parts.modal-media')

@endpush
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

            var html = "<img src='" + img + "' class='rounded' /><input type='hidden' name='media_id' value='" + id + "'>";
            console.log(html);
            $('.box-image').html(html);

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
