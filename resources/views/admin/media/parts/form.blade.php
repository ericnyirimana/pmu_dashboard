<div class="d-flex flex-row row">
    <div class="col-12 mb-3">
        <a href="{{ route('media.index') }}" class="btn btn-md w-lg btn-secondary float-left">Back</a>
    </div>
    <div class="col-md-12 col-lg-6">

        <field-image label="File" field="file" :model="$media" required="new" />

    </div>
    <div class="col-md-12 col-lg-6 d-flex flex-column">

          <field-text label="Name" field="name" :model="$media" required  />

          <field-select label="Brand" field="brand" type="relation" :model="$media" :values="$companies" foreignid="brand_id" />

          <div class="form-group mt-auto">

              @if (isset($media))
              <button type="button" class="btn btn-md w-lg btn-danger rm-register" data-name="{{ $media->name }}" data-register="{{ $media->id }}"  data-toggle="modal" data-target=".remove-register">Remove permanently</button>
              @endif
              <button type="submit" class="btn btn-md w-lg btn-success float-right">Save</button>

          </div>

    </div>
</div>
