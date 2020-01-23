<div class="list-images">
      @if (isset($model->media))
      @foreach ($model->media as $media)
          <figure><img src='{{ $media->getImageSize('small') }}'><input type='hidden' name='media[]' value='{{ $media->id }}'><i class='fa fa-trash delete-image'></i></figure>
      @endforeach
      @endif
      <div class="btn btn-dark btn-add-image"  data-toggle="modal" data-target="#mediaModal"><span class="fa fa-plus" aria-hidden="true"></span></div>
</div>
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

});
</script>
@endpush
