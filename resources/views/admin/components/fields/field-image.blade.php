<div class="form-group">
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
                    <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                    <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                    <input type="file" class="btn-secondary" name="{{ $field }}"  accept=".jpg,.jpeg,.gif,.png"  />
                </button>
            </div>
        </div>
</div>
