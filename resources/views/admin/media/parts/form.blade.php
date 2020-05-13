<div class="d-flex flex-row row">
    <div class="col-12 mb-3">
        <a href="{{ route('media.index') }}" class="btn btn-md w-lg btn-secondary float-left">{{ ucfirst(trans('button.back')) }}</a>
    </div>
    <div class="col-md-12 col-lg-6">

        <field-image label="File" field="file" :model="$media" required="new" />

    </div>
    <div class="col-md-12 col-lg-6 d-flex flex-column">

          <field-text label="name" field="name" :model="$media" required />

          <field-select label="Brand" field="brand" type="relation" :model="$media" :values="$companies" foreignid="brand_id" />

          <div class="form-group mt-auto">

              @if (isset($media))
              <button type="button" class="btn btn-md w-lg btn-danger rm-register" data-name="{{ $media->name }}" data-register="{{ $media->id }}"  data-toggle="modal" data-target=".remove-register">Remove permanently</button>
              @endif

              @if(Auth::user()->is_super)
                  @if($media->status_media == 'PENDING' || $media->status_media == '' )
                  <button type="submit" field="status_media" name="status_media" value="APPROVED" class="btn btn-md w-lg btn-success float-right mr-3">{{ ucfirst(trans('button.approves')) }}</button>
                  @elseif($media->status_media == 'APPROVED')
                  <button type="submit" field="status_media" name="status_media" value="DRAFT" class="btn btn-md w-lg btn-success float-right">{{ ucfirst(trans('button.save')) }}</button>
                  @endif
              @endif

              @if(Auth::user()->is_owner || Auth::user()->is_restaurateur)
                 <button type="submit" field="status_media" name="status_media" value="DRAFT" class="btn btn-md w-lg btn-success float-right">{{ ucfirst(trans('button.save')) }}</button>
              @endif

          </div>

    </div>
</div>
