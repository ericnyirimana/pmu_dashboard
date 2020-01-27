<div class="form-group">
    <label for="{{ @$field }}">{{ $label }}</label>
    <div class="list-images">
          @if (isset($model->media))
          @foreach ($model->media as $media)
              <figure><img src='{{ $media->getImageSize('small') }}'><input type='hidden' name='media[]' value='{{ $media->id }}'><i class='fa fa-trash delete-image'></i></figure>
          @endforeach
          @endif
          <div class="btn btn-dark btn-add-image"  data-toggle="modal" data-target="#mediaModal"><span class="fa fa-plus" aria-hidden="true"></span></div>
    </div>
</div>
@push('modal')
@include('admin.media.parts.modal-media')
@endpush
@push('scripts')
<script>

$(document).ready(function(){

    $(document).on('click', '.btn-add-image', function() {

        $('.modal-media').show();

    });

    $(document).on('click', '.delete-image', function() {

        console.log('delete');
        $(this).parent().remove();

    });

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
