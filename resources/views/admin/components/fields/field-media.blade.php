<div class="list-images">
      @foreach ($model->media as $media)
          <figure><img src='{{ $media->getImageSize('small') }}'><input type='hidden' name='media[]' value='{{ $media->id }}'><i class='fa fa-trash delete-image'></i></figure>
      @endforeach
      <div class="btn btn-dark btn-add-image"><span>+</span></div>
</div>
@push('scripts')
<script>

$(document).ready(function(){

    $(document).on('click', '.btn-add-image', function() {

        $('.modal-media').fadeIn(1);

    });

    $(document).on('click', '.delete-image', function() {

        console.log('delete');
        $(this).parent().remove();

    });

});
</script>
@endpush
