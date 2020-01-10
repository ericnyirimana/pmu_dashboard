<div class="media-container">
    <div class="media-container-header p-3">
        <h3>Media</h3>
        <div class="row">
          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
              <div class="form-group">
                <input type="text" placeholder="Search" class="form-control search-file">
              </div>
            </div>
        </div>
    </div>
    <div class="media-container-body p-4">
      <div class="row">
        @foreach($media as $file)
          <div class="thumb-image">
              <figure class="view-file">
                  <img src="{{ $file->getImageSize('thumbnail') }}" data-file="{{ $file->file }}">
                  <label>{{ $file->name }}</label>
              </figure>

          </div>
        @endforeach
      </div>
    </div>
    <div class="media-container-side p-3">
        <div class="preview-image">
              <figure><img src="" class="preview-file"></figure>
              <p class="preview-name">Name</p>
              <div class="add-image-container">
                    <input type="hidden" class="src-image" value="" />
                    <input type="hidden" class="id-image" value="" />
                    <button class="btn btn-primary btn-block add-image">Add Image</button>
              </div>
              <div class="edit-image-container">
                <a  href="{{ route('media.edit', 1)}}" class="btn btn-primary btn-block edit-image">Edit Image</a>
              </div>

        </div>
    </div>

    @if(isset($footer) && $footer == 'true')
    <div class="media-container-footer p-3">
        <button class="btn btn-secondary btn-lg close-modal float-right">Close</button>
    </div>
    @endif
</div>
@push('scripts')
<script>

jQuery.expr[':'].contains = function(a, i, m) {
  return jQuery(a).text().toUpperCase()
      .indexOf(m[3].toUpperCase()) >= 0;
};

$(document).ready(function(){

  // Search //
  // hide all thumb images except searched name
  $(document).on('keyup', '.search-file', function(){

        var search = $(this).val();
        $('.thumb-image').hide();
        $('.thumb-image:contains("' + search + '")').show();

  });

  // Click thumb //
  // Select preview Image
  $(document).on('click', '.view-file', function() {

        $('.view-file img').removeClass('active');

        var file = $(this).find('img').data('file');

        $(this).find('img').addClass('active');

        // get from parent JS, it is different if is modal or not
        loadImage(file);

  });

});

</script>
@endpush
