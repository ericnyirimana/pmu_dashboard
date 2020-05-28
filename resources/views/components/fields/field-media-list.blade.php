<div class="form-group">
    <label for="{{ @$field }}">{{ __('labels.'.$label) }}</label>
    <div class="list-images">
          @if (isset($model->media))
          @foreach ($model->media as $media)
              <figure><img src='{{ $media->getImageSize('small') }}'><input type='hidden' name='media[]' value='{{ $media->id }}'><i class='fa fa-trash delete-image'></i></figure>
          @endforeach
          @endif
          <div class="btn btn-dark btn-add-image"  data-toggle="modal" data-target="#mediaModal"><span class="fa fa-plus" aria-hidden="true"></span></div>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" hidden name="check_media" id="check_media" value=""
               @if(isset($required))parsley-trigger="change" required @endif>
    </div>
</div>

@push('modal')
@include('admin.media.parts.modal-media')
@endpush
@push('scripts')
<script>

$(document).ready(function(){
    if ($('.list-images figure').length > 0) {
        $('#check_media').val('true');
    }
    $(document).on('click', '.btn-add-image', function() {

        $('.modal-media').show();

    });

    $(document).on('click', '.delete-image', function() {

        $(this).parent().remove();
        if ($('.list-images figure').length <= 0) {
            $('#check_media').val('');
        }

    });

    $(document).on('click', '.close-modal', function(){
          closeModal();
    });

    $(document).on('click', '.add-image', function(){

          var id = $('.src-image').val();
          var file = $('.id-image').val();

          var html_file = "<figure><img src='" + file + "'><input type='hidden' name='media[]' value='" + id + "'><i class='fa fa-trash delete-image'></i></figure>";

          $('.list-images').prepend(html_file);

          $('#check_media').val('true');

          closeModal();

    });

});



// Load Image
// Load imaged clicked from thumb
function loadImage(media) {

  $.ajax({
      url: '{{ env('APP_URL') }}/admin/medias/image/'+media,
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
