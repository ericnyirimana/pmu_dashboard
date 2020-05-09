@extends('admin.layouts.master')

@section('content')

@include('components.fields-require-alert')

<tag-form file :action="route('media.update', $media)" method="put" >
  @include('admin.media.parts.form')
</tag-form>

<modal-remove route='media' />

@endsection
