@extends('admin.layouts.master')

@section('content')

@include('admin.components.fields-require-alert')

<tag-form file :action="route('media.update', $media)" method="put" >
  @include('admin.media.parts.form')
</tag-form>

<modal-remove route='media' />

@endsection
