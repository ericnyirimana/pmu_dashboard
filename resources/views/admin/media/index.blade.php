@extends('admin.layouts.master')

@section('content')

@include('admin.components.notification')

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>List media</b></h4>

            <media :media="$media" />

            {{--
              <datatable route='media' :collection='$media' :fields="[
                  'Thumbnail'   => 'image:thumbnail',
                  'ID'          => 'id',
                  'Name'        => 'name',
                  'Extension'   => 'extension',
                  'Brand'       => 'brand_name',
              ]" />
            --}}
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {



});

// Load Image
// Load imaged clicked from thumb
function loadImage(file) {

  $.ajax({
      url: '{{ env('APP_URL') }}/media/image/'+file,
      context: document.body
    }).done(function(media) {
      $('.edit-image-container').show();
      var link = $('.edit-image-container .edit-image').attr('href');

      if (media.canEdit) {
      newLink = link.replace(/\d+/, media.id);
        $('.edit-image-container').show();
        $('.edit-image-container .edit-image').attr('href', newLink);
      } else {
        $('.edit-image-container').hide();
      }

      $('.preview-image').show();
      $('.preview-file').attr('src', media.files.medium);
      $('.preview-name').text(media.name);

  });

}


</script>
@endpush
