<div class="d-flex flex-row">
<div class="col-md-12 col-lg-6">
    <div class="form-group">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="box-image fileupload-exists thumbnail fileupload-preview">
                    @if ( empty($media->file) )
                      <i class="fa fa-file-image-o fa-2x"></i>
                    @else
                        <img src="{{ $media->getImageSize('medium') }}" />
                    @endif
                </div>

                <div>
                    <button type="button" class="btn btn-secondary btn-file">
                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" class="btn-secondary" name="file" />
                    </button>
                    <a href="#" class="btn btn-danger fileupload-exists btn-remove" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                </div>
            </div>

    </div>
</div>
<div class="col-md-12 col-lg-6 d-flex flex-column">

      <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Name file" value="{{ old('name', isset($media) ? $media->name : '') }}">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
          <label for="brand">Brand</label>
          <select id="brand" class="form-control" name="brand_id">
              <option>Select Brand</option>
              @foreach($brands as $brand)
                <option value="{{ $brand->id }}" @if (isset($media) && $media->brand_id == $brand->id) selected @endif>{{ $brand->name }}</option>
              @endforeach
          </select>
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>

      <div class="form-group mt-auto">

          @if (isset($media))
          <button type="button" class="btn btn-md w-lg btn-danger rm-register" data-name="{{ $media->name }}" data-register="{{ $media->id }}"  data-toggle="modal" data-target=".remove-register">Remove permanently</button>
          @endif
          <button type="submit" class="btn btn-md w-lg btn-success float-right">Save</button>
      </div>

</div>

@push('styles')
<!-- Jquery filer css -->
<link href="{{ asset("/plugins/bootstrap-fileupload/bootstrap-fileupload.css")}}" rel="stylesheet" />
@endpush
@push('scripts')
<!-- Bootstrap fileupload js -->
<script src="{{ asset("/plugins/bootstrap-fileupload/bootstrap-fileupload.js")}}"></script>
@endpush
