<section class="modal-media">

  <div class=" media-search">
    <div class="media-search-header p-3">
        <h3>Media</h3>
        <div class="row">
          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
              <div class="form-group">
                <input type="text" placeholder="Search" class="form-control search-file">
              </div>
            </div>
        </div>
    </div>
    <div class="media-search-body p-4">
          <div class="row">
            @foreach($media as $file)
              <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 thumb-image">
                  <figure class="view-file">
                      <img src="{{ $file->getImageSize('thumbnail') }}" data-file="{{ $file->file }}">
                      <label>{{ $file->name }}</label>
                  </figure>

              </div>
            @endforeach
          </div>
    </div>
    <div class="media-search-side p-3">
        <div class="preview-image">
              <figure><img src="{{ $file->getImageSize('medium') }}" class="preview-file"></figure>
              <p class="preview-name">Name</p>
              <input type="hidden" class="src-image" value="" />
              <input type="hidden" class="id-image" value="" />
              <button class="btn btn-primary btn-block add-image">Add Image</button>
        </div>
    </div>

    <div class="media-search-footer p-3">

        <button class="btn btn-secondary btn-lg close-modal float-right">Close</button>

    </div>
  </div>


</section>
@push('scripts')
<script>

jQuery.expr[':'].contains = function(a, i, m) {
  return jQuery(a).text().toUpperCase()
      .indexOf(m[3].toUpperCase()) >= 0;
};

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

  // Search //
  // hide all thumb images except searched name
  $(document).on('keyup', '.search-file', function(){

        var search = $(this).val();
        $('.thumb-image').hide();
        $('.thumb-image:contains("' + search + '")').show();

  });


  // Click outside thumb //
  // deselect image if click on body
  $(document).on('click', '.media-search-body', function(e) {

      if(!$(e.target).parent().hasClass('view-file')) {

          $('.view-file img').removeClass('active');
          $('.preview-image').hide();
      }



  });

  // Click thumb //
  // Select preview Image
  $(document).on('click', '.view-file', function() {

        $('.view-file img').removeClass('active');

        var file = $(this).find('img').data('file');

        $(this).find('img').addClass('active');

        loadImage(file);

  });


});

// Load Image
// Load imaged clicked from thumb
function loadImage(file) {

  $.ajax({
      url: '{{ env('APP_URL') }}/media/image/'+file,
      context: document.body
    }).done(function(media) {

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
