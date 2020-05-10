<div class="form-group">
      <label for="{{ $field }}">{{ $label }}</label>

      <div class="fileupload fileupload-new" data-provides="fileupload">
          <div class="box-image fileupload-exists thumbnail fileupload-preview">
              @if ( empty($model->$field) )
                <i class="fa fa-file-image-o fa-2x"></i>
              @else
                  <img src="{{ $model->getImageSize('medium') }}" class="rounded" />
              @endif
          </div>

          <div>
              <button type="button" class="btn btn-secondary btn-file">
                  <span class="fileupload-new"><i class="fa fa-paper-clip"></i> {{ ucfirst(trans('button.select_image')) }}</span>
                  <span class="fileupload-exists"><i class="fa fa-undo"></i> {{ ucfirst(trans('button.change_image')) }}</span>
                  <input type="file" class="btn-secondary" id="{{ $field }}" name="{{ $field }}"  accept=".jpg,.jpeg,.gif,.png" @if (isset($required) && ($required != 'new' || ($required == 'new' && empty($model))) ) required @endif />
              </button>
          </div>
      </div>
</div>
@push('styles')
<!-- Jquery filer css -->
<link href="{{ asset("/plugins/bootstrap-fileupload/bootstrap-fileupload.css")}}" rel="stylesheet" />
@endpush
@push('scripts')
<!-- Bootstrap fileupload js -->
<script type="text/javascript" src="{{ asset("/plugins/bootstrap-fileupload/bootstrap-fileupload.js")}}"></script>
@endpush
