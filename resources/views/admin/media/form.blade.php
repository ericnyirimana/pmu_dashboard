@extends('admin.layouts.master')

@section('content')

@include('admin.components.fields-require-alert')

@if (isset($media))
<tag-form file :action="route('media.update', $media)" method="put" >
@else
<tag-form file :action="route('media.store')">
@endif
      <div class="d-flex flex-row row">
          <div class="col-md-12 col-lg-6">

              <field-image label="File" field="file" :model="$media" required="new" />

          </div>
          <div class="col-md-12 col-lg-6 d-flex flex-column">

                <field-text label="Name" field="name" :model="$media" required  />

                <field-select label="Brand" field="brand" type="relation" :model="$media" :values="$brands" foreignid="brand_id" required />

                <div class="form-group mt-auto">

                    @if (isset($media))
                    <button type="button" class="btn btn-md w-lg btn-danger rm-register" data-name="{{ $media->name }}" data-register="{{ $media->id }}"  data-toggle="modal" data-target=".remove-register">Remove permanently</button>
                    @endif
                    <button type="submit" class="btn btn-md w-lg btn-success float-right">Save</button>

                </div>

          </div>
      </div>

</tag-form>

@include('admin.components.modal-remove', ['route' => 'media'])

@endsection
