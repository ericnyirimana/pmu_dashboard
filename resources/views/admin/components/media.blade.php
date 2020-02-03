<div class="media-container">
    <div class="media-container-header p-3">
        <h3>Media</h3>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
              <div class="form-group">
                <input type="text" placeholder="Search" class="form-control search-file">
              </div>
            </div>
            <div class="offset-xl-6 col-xl-3 offset-lg-4 col-lg-4 offset-md-4 col-md-4 col-sm-6 col-12">
              <div class="form-group">

                <!-- Our markup, the important part here! -->
                <div id="drag-and-drop-zone" class="dm-uploader">

                  <div class="btn btn-primary btn-block">
                      <span>Browser new file</span>
                      <input name="file" type="file" title='Click to add Files' />
                  </div>
                </div><!-- /uploader -->

              </div>
            </div>
            <div class="col-xl-3">
              <div class="container-load">

              </div>
          </div>
        </div>
    </div>
    <div class="media-container-body p-4 border">
      <div class="row list-thumbnail">
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
                  <button type="button" class="btn btn-primary btn-block add-image" data-dismiss="modal">Add Image</button>
            </div>

            <div class="edit-image-container">
              <a  href="{{ route('media.edit', 1)}}" class="btn btn-primary btn-block edit-image">Edit Image</a>
            </div>

      </div>
    </div>
</div>
@push('styles')
<!-- Jquery filer css -->
<link href="{{ asset("/plugins/js-uploader-master/dist/css/jquery.dm-uploader.min.css")}}" rel="stylesheet" />
@endpush
@push('scripts')
<!-- Bootstrap fileupload js -->
<script type="text/javascript" src="{{ asset("/plugins/js-uploader-master/dist/js/jquery.dm-uploader.min.js")}}"></script>
<script>

// Search overwrite, case insensitive
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

        // get from parent JS, it is different if is modal or not
        loadImage(file);

  });


  $('#drag-and-drop-zone').dmUploader({ //
    url: '/admin/file/upload',
    maxFileSize: 3000000, // 3 Megs
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

    onComplete: function(){

    },
    onUploadProgress: function(id, percent){
        progress_bar(percent);
    },
    onUploadSuccess: function(id, data){
        add_thumbnail(data);
        $('.container-load').html('');

    },
    onUploadError: function(id, xhr, status, message){
        error_message(message);
    },
    onFallbackMode: function(){
        console.log('fallback');
    },
    onFileSizeError: function(file){
          error_message('File max upload size');

    }
  });

});

function add_thumbnail(data) {

  html = '<div class="thumb-image">';
  html += '    <figure class="view-file">';
  html += '        <img src="' + data.url + '" data-file="' + data.file + '">';
  html += '        <label>' + data.name + '</label>';
  html += '    </figure>';
  html += '</div>';

  $('.list-thumbnail').prepend(html);

}

function progress_bar(percent) {
  percent = Math.round(percent/1.1);
  html = 'Loading <div class="progress"><div class="progress-bar" role="progressbar" style="width: ' + percent + '%" aria-valuenow="' + percent + '" aria-valuemin="0" aria-valuemax="100">' + percent + '%</div></div>';

  $('.container-load').html(html);

}

function error_message(message) {
    html = '<div class="alert alert-danger" role="alert">'+ message +'</div>';
    $('.container-load').html(html);
}

</script>
@endpush
